<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('config.php');
class Read extends Database{
    function readTache(){
        $sql="SELECT 
        Taches.Id, 
        Taches.Titre, 
        Taches.Description, 
        Taches.Priorite, 
        Taches.DateCreation, 
        Taches.DateLimite, 
        Taches.Statut, 
        Utilisateurs.Prenom AS PrenomAssignee, 
        Utilisateurs.Nom AS NomAssignee, 
        Utilisateurs.Email AS EmailAssignee, 
        Utilisateurs.Role AS RoleAssignee, 
        Taches.Createur,
        Taches.Assignee, 
        Taches.Etiquettes
    FROM 
        Taches
    INNER JOIN 
        Utilisateurs ON Taches.Assignee = Utilisateurs.Id;
    ";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function readUtilis(){
        $sql="SELECT * FROM Utilisateurs";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $utilis=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $utilis;
    }
    
    
}
$db=new Read();
$result=$db->readTache();
$utilis=$db->readUtilis();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="liste.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>liste des tâches </title>
</head>
<body>
<header>
        <h1>LISTE DE TÂCHES DES EMPLOYÉS</h1>
    </header>
    <nav>
        <ul>
            <li><a href="#section1" class="nav-link">Liste de tâche</a></li>
            <li><a href="#section2" class="nav-link">ÉQUIPE</a></li>
            <li><a href="createtache.php" class="nav-link">Ajouter une tâche</a></li>
        </ul>
    </nav>
    <main>
        <section id="section1" class="section-content">
           <table id="customers">
            <thead>
           
                <tr>
                    <th>Details</th>
                    <th>Tâche</th>
                    <th>Assigné à</th>
                    <th>Statut</th>
                    <th>Priorite</th>
                    <th>Date de cration</th>
                    <th>Date de Limite</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
    foreach($result as $valeur):?>
                <tr>
                   <td class="view"><a href="detail.php?Id=<?=$valeur['Id'] ?>"class="nav-link" id="voire"> voire<i class="fa-solid fa-eye" style="color: #74C0FC;"></i>  </a></td>
                    <td><?= $valeur['Titre']?></td>
                    <td><?= $valeur['PrenomAssignee']?> <?=$valeur['NomAssignee']?></td>
                    <td><?= $valeur['Statut']?></td>
                    <td><?= $valeur['Priorite']?></td>
                    <td><?= $valeur['DateCreation']?></td>
                    <td><?= $valeur['DateLimite']?></td>
                    <td><a href="delete.php?Id=<?=$valeur['Id'] ?>"class="nav-link"><i class="fa-solid fa-trash fa-lg" style="color: #b81414;"></i></a>
                   <a href="update.php?Id=<?=$valeur['Id'] ?>"class="nav-link" id="upt"><i class="fa-solid fa-pen-to-square fa-lg" style="color: #1E5389;"></i></a></td>
                </tr>
                <?php endforeach;?>
            </tbody>
           </table>
        </section>
        <section id="section2" class="section-content">

           <table id="customer">
            <thead>
           
                <tr>
                    <th>PRENOM</th>
                    <th>NOM</th>
                    <th>EMAIL</th>
                    <th>RÔLE</th>
                </tr>
            </thead>
            <tbody>
            <?php
    foreach($utilis as $row):?>
                <tr>
                    <td><?=$row['Prenom']?></td>
                    <td><?= $row['Nom']?></td>
                    <td><?=$row['Email']?></td>
                    <td><?=$row['Role']?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
           </table>
        </section>
        <section id="section3" class="section-content">
        <?php
        require_once('delete.php');
         ?>
        </section>
    </main>
    </body>
</html>

<script>
   document.addEventListener("DOMContentLoaded", function() {
    var links = document.querySelectorAll('.nav-link');

    links.forEach(function(link) {
        link.addEventListener('click', function(event) {
            var targetId = this.getAttribute('href').substr(1);
            var targetSection = document.getElementById(targetId);
            var sections = document.querySelectorAll('.section-content');

            sections.forEach(function(section) {
                section.classList.remove('active');
            });

            targetSection.classList.add('active');
        });
    });
});
 
</script>