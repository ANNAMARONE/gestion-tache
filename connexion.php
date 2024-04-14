<?php
require_once('config.php');

class Connexion extends Database {
    function connecter($username, $password) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['Email'];
            $password = $_POST['MotDePasse'];

            // Connectez-vous à la base de données
            $this->conn;

            $sql = "SELECT * FROM Utilisateurs WHERE Email = :Email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['Email' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['MotDePasse'])) {
                session_start();
                $_SESSION['Id'] = $user['Id'];
                header('Location: read.php');
                exit();
            } else {
                $message = 'Identifiants invalides';
            }
        }

        return $message ?? '';
    }
}

// Créez une instance de la classe Connexion
$db = new Connexion();

// Exécutez la méthode connecter pour tenter une connexion
$message = $db->connecter($_POST['Email'] ?? '', $_POST['MotDePasse'] ?? '');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        /* Votre CSS ici */
    </style>
</head>
<body>

<div class="login-container">
    <h2>Connexion</h2>

    <?php if (!empty($message)): ?>
        <p style="color:red"><?= $message ?></p>
    <?php endif; ?>

    <form action="connexion.php" method="post">
        <div>
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="Email" required>
        </div>

        <div>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="MotDePasse" required>
        </div>

        <div>
            <input type="submit" value="Se connecter">
        </div>
    </form>
</div>

</body>
</html>
