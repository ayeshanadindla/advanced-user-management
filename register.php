<?php
require_once 'db_connect.php';

$message = "";
$messageClass = "";

if(isset($_POST['register'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $check = $conn->prepare("SELECT id FROM users WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if($result->num_rows > 0){

        $message = "Email already exists!";
        $messageClass = "error";

    }else{

        $stmt = $conn->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss", $name, $email, $password, $role);

        if($stmt->execute()){

            $message = "Registration Successful!";
            $messageClass = "success";

        }else{

            $message = "Registration Failed!";
            $messageClass = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>User Registration</h2>

    <?php if(!empty($message)){ ?>
        <p class="<?php echo $messageClass; ?>">
            <?php echo $message; ?>
        </p>
    <?php } ?>

    <form method="POST">

        <input type="text"
               name="name"
               placeholder="Enter your name"
               required>

        <input type="email"
               name="email"
               placeholder="Enter your email"
               required>

        <input type="password"
               name="password"
               placeholder="Enter your password"
               required>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit" name="register">
            Register
        </button>

    </form>

    <br>

    <p>
        Already have an account?
        <a href="login.php">Login</a>
    </p>

</div>

</body>
</html>