<?php
require_once('config.php');
class Createtache extends Database{
    function create($Titre,$Description,$Priorite, $DateCreation, $DateLimite, $Statut, $Assignee, $Createur, $Etiquettes){
   
    $sql="INSERT INTO `Taches`(`Titre`, `Description`, `Priorite`, `DateCreation`, `DateLimite`, `Statut`, `Assignee`, `Createur`, `Etiquettes`) VALUES 
    (:Titre, :Description,:Priorite,:DateCreation,:DateLimite,:Statut,:Assignee,:Createur,:Etiquettes)";
    $stmt=$this->conn->prepare($sql);
    $stmt->bindvalue(':Titre',$Titre);
    $stmt->bindvalue(':Description',$Description);
    $stmt->bindvalue(':Priorite',$Priorite);
    $stmt->bindvalue(':DateCreation',$DateCreation);
    $stmt->bindvalue(':DateLimite',$DateLimite);
    $stmt->bindvalue(':Statut',$Statut);
    $stmt->bindvalue(':Assignee',$Assignee);
    $stmt->bindvalue(':Createur',$Createur);
    $stmt->bindvalue(':Etiquettes',$Etiquettes);
    $stmt->execute();
     }
     function readUtilis() {
        try{
           $sql="SELECT * FROM Utilisateurs" ;
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            return $result;
        } catch(PDOException $e){
            echo"une erreur est survenu".$e->getMessage();
        }
        
    }
}
if(isset($_POST["submit"])){
    extract($_POST);
   
    if(empty($Titre)|| empty($Description) || empty($Priorite)|| empty($DateCreation) || empty($DateLimite) || empty($Statut) || empty($Assignee) || empty($Createur) || empty($Etiquettes) ){
        echo "<p>** tout les champs sont obligatoire</p>";
    }else{
        $db=new Createtache();
        $db->create($Titre,$Description,$Priorite, $DateCreation, $DateLimite, $Statut, $Assignee, $Createur, $Etiquettes);
        header('location:read.php');
        exit();
      
    }
}

?>;









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tache.css">
    <title>ajoute une tâche</title>
</head>
<body>
    <div class="container">
        <div class="top">
            <h1>AJOUTER UNE TÂCHE</h1>
            <p> créer de nouvelles tâches et voir les détails de chaque tâche créée</p>
            <div class="traite"></div>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <fieldset class="tache">
              <h1> Details de la tâche</h1> 
                <div class="from1">
                <div>
                <label for="Titre">Titre:</label>
                <input type="text" value="" name="Titre">
                </div>
                <div>
                <label for="Titre">Description:</label>
                <input type="text" value="" name="Description" class="descrip">
                </div>
                <div>
                <label for="Titre">Etiquettes:</label>
                <input type="text" value="" name="Etiquettes" >
                </div>
                
                </div>
                <div class="form2">
                        <div class="membre">
                            <h1>Membres</h1>
                <div>
                <label for="Titre">Createur:</label>
                <select class="form-control" id="Createur" name="Createur" required>
            <?php
            require_once('config.php');
            $result=new Createtache();
            $utilisateurs=$result->readUtilis ();
            ?>
            <?php 
              foreach($utilisateurs as $utilisateur){?>
                <option value="<?= $utilisateur['Id']?>"><?= $utilisateur['Prenom']?> <?= $utilisateur['Nom']?></option>
                <?php
              
            }

            ?>   <!-- Ajoutez d'autres options ici si nécessaire -->
            </select>
                </div>
                <div>
                <label for="Titre">Assignee:</label>
                <select class="form-control" id="Assignee" name="Assignee" required>
            <?php
            require_once('config.php');
            $result=new Createtache ();
            $utilisateurs=$result->readUtilis();
            ?>
            <?php 
              foreach($utilisateurs as $utilisateur){?>
                <option value="<?= $utilisateur['Id']?>"><?= $utilisateur['Prenom']?> <?= $utilisateur['Nom']?></option>
                <?php
              
            }

            ?>
              
              
                <!-- Ajoutez d'autres options ici si nécessaire -->
            </select>
                </div>
               
                        </div>
                        <div class="date">
                            <h1>Date et autre</h1>
                        <div>
                <label for="Statut">Statut :</label>
    <select name="Statut" id="statut">
        <option value="a faire">A faire</option>
        <option value="en cours">En cours</option>
        <option value="terminee">Treminer</option>
    </select>
                </div>
                <div>
                <label for="Priorite">Priorite:</label>
    <select name="Priorite" id="Priorite">
        <option value="faible">Faible</option>
        <option value="moyenne">Moyenne</option>
        <option value="elevee">Elever</option>
    </select>
                </div>
                <div>
                <label for="DateCreation">Date de creation:</label>
                <input type="date" value="" name="DateCreation" class="datecreation" >
                </div>
                <div>
                <label for="DateLimite">Date de limite:</label>
                <input type="date" value="" name="DateLimite" class="datelimite" >
                </div>

                        </div>
                </div>
                <input type="submit" name="submit" value="Submit">
            </fieldset>
        </form>
    </div>

</body>
</html>