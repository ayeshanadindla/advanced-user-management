<?php
$joke = @file_get_contents("https://official-joke-api.appspot.com/random_joke");

if ($joke !== false) {
    $data = json_decode($joke, true);
} else {
    $data = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Random Joke</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>😂 Random Joke</h2>

    <?php if($data){ ?>

        <h3><?php echo $data['setup']; ?></h3>

        <p><?php echo $data['punchline']; ?></p>

    <?php } else { ?>

        <p>Unable to fetch joke. Please check your internet connection.</p>

    <?php } ?>

    <br>

    <a href="joke.php">
        <button>Get Another Joke</button>
    </a>

    <br><br>

    <a href="dashboard.php">
        <button>Back to Dashboard</button>
    </a>

</div>

</body>
</html>