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
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>My Profile</h2>

<p><strong>Name:</strong> <?php echo $user['name']; ?></p>

<p><strong>Email:</strong> <?php echo $user['email']; ?></p>

<p><strong>Role:</strong> <?php echo ucfirst($user['role']); ?></p>

<br>

<a href="edit_profile.php">
<button>Edit Profile</button>
</a>

<br><br>

<a href="dashboard.php">
<button>Back to Dashboard</button>
</a>

</div>

</body>
</html>