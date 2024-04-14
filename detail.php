<?php
require_once('config.php');
class Delete extends Database{
function readTacheDetail($id){
   
    $sql="SELECT * FROM Taches INNER JOIN Utilisateurs ON Taches.Assignee = Utilisateurs.Id WHERE Utilisateurs.Id=:Id";
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
    <title>liste des tâches </title>
</head>
<body>
    <div class="description">
    <h1>Description</h1> 
    <p><?=$détail['DescriptionT'] ?></p>
    </div>
    <div class="description">
    <h1>Etiquettes</h1> 
    <p><?=$détail['Etiquettes'] ?></p>
    </div>
           
              
                    <th>Tâche</th>
                    <th>Assigné à</th>
                    <th>Statut</th>
                    <th>Priorite</th>
                    <th>Date de cration</th>
                    <th>Date de Limite</th>
                </tr>
            
            
                  
                    <td><?= $détail['Etiquettes']?></td>
                    <td><?= $détail['Prenom']?><?= $détail['Nom']?></td>
                    <td><?=$détail['Statut']?></td>
                    <td><?= $détail['Priorite']?></td>
                    <td><?=$détail['DateCreation']?></td>
           </table>              
         </body>
</html>
    
   