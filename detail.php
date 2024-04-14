<?php
require_once('config.php');
class Delete extends Database{
function readTacheDetail($id){
   
    $sql="SELECT * FROM Taches
    JOIN Utilisateurs ON Utilisateurs.Id = Taches.Createur
    WHERE Taches.Id = :Id";
    $stmt=$this->conn->prepare($sql);
    $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $détail=$stmt->fetch();
    return $détail;
}  

}
$id = $_GET['Id'];
$db = new Delete();
$détail = $db->readTacheDetail($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="liste.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>liste des tâches </title>
    <title>liste des tâches </title>
</head>
<body class="liste">
<nav>
  <a href="create.php" class="nav-item is-active" data-active-color="orange" data-target="Home">Accueil</a>
  <a href="read.php" class="nav-item" data-active-color="green" data-target="About">Tâche</a>
  <a href="createtache.php" class="nav-item" data-active-color="blue" data-target="Testimonials">Ajouter une Tâche</a>
  <span class="nav-indicator"></span>
  
</nav>
    
    <section class="section1">
    <div class="detail2">
    <div class="description">
    <h1>Description</h1> 
    <p><?=$détail['Description'] ?></p>
    </div>
    <div class="Etique">
    <h1>Etiquettes</h1> 
    <p><?=$détail['Etiquettes'] ?></p>
    </div>
    <div class="createur">
    <h1><i class="fa-solid fa-user fa-lg" style="color: #74C0FC;"></i>Auteur</h1> 
    <p><?=$détail['Prenom'] ?> <?=$détail['Nom'] ?></p>
    </div>
    </div>
    <div class="detail1">
    <div class='statut'>
        <h1>Statut</h1>
        <p><?=$détail['Statut'] ?></p>
        <h1>Priorité</h1>
        <p><?=$détail['Priorite'] ?></p>
    </div>
    <div class='date'>
        <h1>Date de creation</h1>
        <p><?=$détail['DateCreation'] ?></p>
        <h1>Date de limite</h1>
        <p><?=$détail['DateLimite'] ?></p>
    </div>
    </div> 
    </section>
</body>    
</html>
    
   