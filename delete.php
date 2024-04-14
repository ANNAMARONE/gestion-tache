<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('config.php');
class Delete extends Database {
    public function delete($id) {
        try {
            $sql = "DELETE FROM Taches WHERE Id = :Id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':Id', $id, PDO::PARAM_INT);
            $stmt->execute();
            // Suppression réussie, redirigez vers une autre page
            header('location: read.php');
            exit(); // Assurez-vous de terminer l'exécution du script après la redirection
        } catch(PDOException $e) {
            echo 'Une erreur est survenue : ' . $e->getMessage();
        }
        
    }
}

// Vérifiez si l'ID est fourni dans l'URL
if(isset($_GET['Id'])) {
    $id = $_GET['Id'];
    $db = new Delete();
    $db->delete($id);
} else {
    echo "Erreur : l'ID est manquant.";
}