  SQLi-Lab - Laboratoire d'injection SQL

 Objectif
Ce projet a pour objectif de créer un site web volontairement vulnérable afin de comprendre l'injection SQL, son exploitation, et la manière de s'en protéger.

 Technologies utilisées
- HTML/CSS
- PHP
- WAMP (Apache + MySQL)
- MySQL

 Étapes de réalisation

 1. Création de la base de données
Le script `setup.php` initialise la base de données et crée une table `users` avec des utilisateurs par défaut pour tester la vulnérabilité.
- Utilisateur : admin/adminpass
- Utilisateur : user/1234

 2. Développement du site vulnérable
La page `login.php` contient un formulaire de connexion qui est vulnérable à une injection SQL, car les données sont insérées directement dans la requête SQL sans filtrage.

 Exemple d'injection
- Accéder à l'URL suivante pour initialiser la base de données : `http://localhost/SQLi-Lab/setup.php`
- Se connecter à `login.php` avec les identifiants suivants :
  - Utilisateur : (Peu importe)
  - Mot de passe : `' OR '1'='1`

Résultat : La connexion réussit, même avec un mot de passe invalide, en raison de l'injection SQL.

 Sécurisation du code
 
- Utiliser des requêtes préparées pour prévenir les injections SQL :
  ```php
  $stmt = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
  $stmt->bindParam(':username', $u);
  $stmt->bindParam(':password', $p);
  $stmt->execute();

