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
        <form action="" method="POST">
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
                <div>
                <label for="Titre">Fichiers Attaches:</label>
                <input type="text" value="" name="FichiersAttaches">
                </div>
                </div>
                <div class="form2">
                        <div class="membre">
                            <h1>Membres</h1>
                <div>
                <label for="Titre">Createur:</label>
                <input type="text" value="" name="Createur" class="membre1">
                </div>
                <div>
                <label for="Titre">Assignee:</label>
                <input type="text" value="" name="Assignee" class="membre1">
                </div>
               
                        </div>
                        <div class="date">
                            <h1>Date et autre</h1>
                        <div>
                <label for="Statut">Statut :</label>
    <select name="Statut" id="statut">
        <option value="a faire">A faire</option>
        <option value="en cours">En cours</option>
        <option value="terminnee">Treminer</option>
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
                <input type="submit" value="Submit">
            </fieldset>
        </form>
    </div>

</body>
</html>