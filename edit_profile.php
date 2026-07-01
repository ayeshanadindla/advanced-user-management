<?php
session_start();
include 'db_connect.php';

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

$message = "";

if(isset($_POST['update'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    $update = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
    $update->bind_param("ssi",$name,$email,$id);

    if($update->execute()){
        $_SESSION['name'] = $name;
        $message = "Profile Updated Successfully!";
    }else{
        $message = "Update Failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Profile</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Edit Profile</h2>

<p style="color:green;"><?php echo $message; ?></p>

<form method="POST">

<input type="text" name="name"
value="<?php echo $user['name']; ?>" required>

<input type="email" name="email"
value="<?php echo $user['email']; ?>" required>

<button type="submit" name="update">
Update Profile
</button>

</form>

<br>

<a href="profile.php">
<button>Back</button>
</a>

</div>

</body>
</html>