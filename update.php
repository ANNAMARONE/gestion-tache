<?php
require_once("config.php");
class updateTache extends Database{
function getElementbyid($id){
    $sql="SELECT * FROM Taches Where Id = :Id";
    $stmt=$this->conn->prepare($sql);
    $stmt->execute(['Id'=>$id]);
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  
}
public function update($id, $Titre, $Description, $Priorite, $DateCreation, $DateLimite, $Statut, $Etiquettes) {
    $sql = "UPDATE Taches SET Titre = :Titre, Description = :Description, Priorite = :Priorite, DateCreation = :DateCreation, DateLimite = :DateLimite, Statut = :Statut, Etiquettes = :Etiquettes WHERE Id = :Id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':Id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':Titre', $Titre);
    $stmt->bindValue(':Description', $Description);
    $stmt->bindValue(':Priorite', $Priorite);
    $stmt->bindValue(':DateCreation', $DateCreation);
    $stmt->bindValue(':DateLimite', $DateLimite);
    $stmt->bindValue(':Statut', $Statut);
    $stmt->bindValue(':Etiquettes', $Etiquettes);

    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

 }
if(isset($_GET['Id']) && !empty($_GET['Id'])){
    $id=$_GET['Id'];
    $db=new updateTache();
    $result=$db->getElementbyid($id);
}
if(isset($_POST['modifier'])){
    $db=new updateTache();
    extract($_POST);
    try{
        $inserted=$db->update($id,$Titre,$Description,$Priorite, $DateCreation, $DateLimite, $Statut, $Etiquettes);
        if ($inserted) {
            header('location:read.php');
            echo "<p>Modification enregistrée avec succès.</p>";
            // You might redirect the user or perform additional actions here
            exit();
        } else {
            echo "<p>Une erreur est survenue lors de votre modification.</p>";
        }
    } catch (Exception $e) {
        // Handle any exceptions that occur during the update operation
        echo "An error occurred: " . $e->getMessage();
    }
    
}

?>
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
                <input type="text" value="<?php echo $result['Titre']?>" name="Titre">
                </div>
                <div>
                <label for="Titre">Description:</label>
                <input type="text" value="<?php echo $result['Description']?>" name="Description" class="descrip">
                </div>
                <div>
                <label for="Titre">Etiquettes:</label>
                <input type="text" value="<?php echo $result['Etiquettes']?>" name="Etiquettes" >
                </div>
                
                </div>
                <div class="form2">
                        <div class="membre">
                            <h1>Membres</h1>
                
               
                        </div>
                        <div class="date">
                            <h1>Date et autre</h1>
                        <div>
                <label for="Statut">Statut :</label>
                <select name="Statut" id="statut">
    <option value="a faire" <?php echo ($result['Statut'] == 'a faire') ? 'selected' : ''; ?>>A faire</option>
    <option value="en cours" <?php echo ($result['Statut'] == 'en cours') ? 'selected' : ''; ?>>En cours</option>
    <option value="terminee" <?php echo ($result['Statut'] == 'terminee') ? 'selected' : ''; ?>>Terminée</option>
</select>

                </div>
                <div>
                <label for="Priorite">Priorite:</label>
                <select name="Priorite" id="Priorite">
    <option value="faible" <?php echo ($result['Priorite'] == 'faible') ? 'selected' : ''; ?>>Faible</option>
    <option value="moyenne" <?php echo ($result['Priorite'] == 'moyenne') ? 'selected' : ''; ?>>Moyenne</option>
    <option value="elevee" <?php echo ($result['Priorite'] == 'elevee') ? 'selected' : ''; ?>>Élevée</option>
</select>

                </div>
                <div>
                <label for="DateCreation">Date de creation:</label>
                <input type="date"  name="DateCreation" class="datecreation" value="<?php echo $result['DateCreation']?>">
                </div>
                <div>
                <label for="DateLimite">Date de limite:</label>
                <input type="date"  name="DateLimite" class="datelimite" value="<?php echo $result['DateLimite']?>">
                </div>

                        </div>
                </div>
                <input type="submit" name="modifier" value="Submit">
            </fieldset>
        </form>
    </div>

</body>
</html>
