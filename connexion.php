<?php
require_once('config.php');

class Connexion extends Database {
    function authentification() {
        // Démarrer la session
        session_start();

        // Vérifier si l'utilisateur est déjà connecté, le rediriger vers la page d'accueil si c'est le cas
        if(isset($_SESSION['utilisateur_id'])) {
            header("Location: accueil.php");
            exit;
        }

        // Vérifier si le formulaire de connexion a été soumis
        if(isset($_POST["connecter"])) {
            // Récupérer les données du formulaire
            $email = $_POST["Email"];
            $motDePasse = $_POST["MotDePasse"];
            
            // Validation des données
            if(empty($email) || empty($motDePasse)) {
                $erreur = "Veuillez saisir votre adresse e-mail et votre mot de passe.";
            } else {
                // Vérifier les informations d'identification dans la base de données
                $stmt = $this->conn->prepare("SELECT id, MotDePasse FROM Utilisateurs WHERE Email = :Email");
                $stmt->execute(array(':Email' => $email));
                $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Vérifier si l'utilisateur existe et si le mot de passe est correct
                if($utilisateur && password_verify($motDePasse, $utilisateur['MotDePasse'])) {
                    // Authentification réussie, créer une session pour l'utilisateur
                    $_SESSION['utilisateur_id'] = $utilisateur['id'];
                    // Rediriger vers la page d'accueil
                    header("Location: accueil.php");
                    exit;
                } else {
                    // Informer l'utilisateur que les informations d'identification sont incorrectes
                    $erreur = "Adresse e-mail ou mot de passe incorrect.";
                }
            }
        }
    }
}

// Utilisation de la classe Connexion
$connexion = new Connexion();
$connexion->authentification();

