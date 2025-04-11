<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'test_db'; 

try {
    $db = new PDO("mysql:host=$host", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    echo "Base de données '$dbname' créée avec succès.<br>";

    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(255) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";
    $db->exec($sql);
    echo "Table 'users' créée avec succès.<br>";

    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");

    $stmt->execute([':username' => 'admin', ':password' => 'adminpass']);
    $stmt->execute([':username' => 'user', ':password' => '1234']);
    echo "Utilisateurs par défaut insérés avec succès.<br>";
    header('Location: login.php');
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
