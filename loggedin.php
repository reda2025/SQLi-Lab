<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
?>

<html>
<head>
    <title>Bienvenue</title>
</head>
<body>
    <h1>Bienvenue, <?=$username?> !</h1>
    <p>Tu es connecté(e).</p>

    <a href="logout.php">Se déconnecter</a>
</body>
</html>
