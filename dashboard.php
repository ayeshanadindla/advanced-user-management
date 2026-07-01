<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Welcome <?php echo $_SESSION['name']; ?></h2>

<h3>
Role:
<?php echo strtoupper($_SESSION['role']); ?>
</h3>

<?php

if($_SESSION['role']=="admin"){

    echo "<p style='color:green;'><b>Admin Panel</b></p>";
    echo "<p>You can manage all users.</p>";

}else{

    echo "<p style='color:blue;'><b>User Panel</b></p>";
    echo "<p>You can view and edit your own profile.</p>";

}

?>

<br>

<a href="profile.php">
<button>My Profile</button>
</a>

<br><br>
<a href="joke.php">
    <button>😂 Random Joke</button>
</a>

<br><br>

<a href="logout.php">
<button>Logout</button>
</a>

<br><br>

</div>

</body>
</html>