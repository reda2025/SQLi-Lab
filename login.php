<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'test_db';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $u = $_POST["username"];
    $p = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$u' AND password = '$p'";
    $stmt = $db->query($sql);

    if ($stmt && $stmt->fetch()) {
        $_SESSION['username'] = $u;
        header("Location: loggedin.php");
        exit();
    } else {
        $msg = "Identifiants incorrects.";
    }
}
?>

<form method="POST">
    <input name="username" placeholder="Nom d'utilisateur"><br><br>
    <input name="password" type="password" placeholder="Mot de passe"><br><br>
    <button type="submit">Connexion</button>
</form>
<p><?= $msg ?></p>
