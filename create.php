<?php
require_once('config.php');

class insertUtilisateur extends Database {
    function insert($Nom, $Prenom, $Email, $MotDePasse, $Role) {
        $sql = "INSERT INTO Utilisateurs(`Prenom`, `Nom`, `Email`, `MotDePasse`, `Role`) VALUES (:Prenom, :Nom, :Email, :MotDePasse, :Role)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':Prenom', $Prenom);
        $stmt->bindValue(':Nom', $Nom);
        $stmt->bindValue(':Email', $Email);
        $stmt->bindValue(':MotDePasse', $MotDePasse);
        $stmt->bindValue(':Role', $Role);
        $stmt->execute();   
    }
    function validerMotDePasse($MotDePasse) {
        // Longueur minimale
        if (strlen($MotDePasse) < 8) {
            return false;
        }
    
        // Caractères spéciaux
        if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $MotDePasse)) {
            return false;
        }
    
        // Au moins une lettre majuscule
        if (!preg_match('/[A-Z]/', $MotDePasse)) {
            return false;
        }
    
        // Au moins une lettre minuscule
        if (!preg_match('/[a-z]/', $MotDePasse)) {
            return false;
        }
    
        // Au moins un chiffre
        if (!preg_match('/[0-9]/', $MotDePasse)) {
            return false;
        }
    
        return true;
    }
    
    // gestion de l'authentification
}

$db = new insertUtilisateur();

$errs = array();
if(isset($_POST["submit"])) {
    $Nom = stripcslashes($_POST["Nom"]);
    $Prenom = stripcslashes($_POST["Prenom"]);
    $Email = stripcslashes($_POST["Email"]);
    $MotDePasse = stripcslashes($_POST["MotDePasse"]);
    $Role = stripcslashes($_POST["Role"]);

   
    // Vous pouvez ajouter ici une validation supplémentaire si nécessaire
    if(empty($Nom)){
        $errs["Nom"][] = "Le champ Nom est requis";
    }
    if(empty($Prenom)){
        $errs["Prenom"][] = "Le champ Prenom est requis";
    }
   if(empty($Email)){
        $errs["Email"][] = "Le champ Email est requis";
    }
  if(empty($MotDePasse)){
        $errs["MotDePasse"][] = "Le champ Mot de passe est requis";
    }
    if(empty($Role)){
        $errs["Role"][] = "Le champ Role est requis";
    }
   
   if(count($errs) == 0){
    if(!$db->validerMotDePasse($MotDePasse)) {
        echo "Le mot de passe est invalide. Veuillez entrer un mot de passe valide.";

    }else{
    $db->insert($Nom, $Prenom, $Email, $MotDePasse, $Role);
    echo "Compte créé avec succès";
    header("location:create.php");
exit();
    
}

}
else {
    // Gérer les erreurs ici et informer l'utilisateur
    foreach($errs as $field => $errorMessages) {
        foreach($errorMessages as $errorMessage) {
            echo "Erreur dans le champ $field : $errorMessage <br>";
        }
    }
}

    }
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
   <script src="app.js"></script>
    <title>compte utilisateur</title>
</head>
<body>
<nav>
  <a href="create.php" class="nav-item is-active" data-active-color="orange" data-target="Home">Accueil</a>
  <a href="#" class="nav-item" data-active-color="green" data-target="About">Tâche</a>
  <a href="createtache.php" class="nav-item" data-active-color="blue" data-target="Testimonials">Ajouter une Tâche</a>
  <a href="#" class="nav-item" data-active-color="rebeccapurple" data-target="Contact">Contact</a>
  <span class="nav-indicator"></span>
  
</nav>
<div class="container">
<div class="top">
    <img src="images/rop.png" alt="" class="imageperso">
    <h1>ESPACE PERSONNEL EMPLOYÉ</h1>
</div>
<div class="créercompt">
<div class="form1">
<form action="" method="POST">
    <fieldset>
        <h1 class="compt">JE CRÉER MON COMPTE</h1>
        <div class="traite1"></div>
        <div class="form2">
            
            <div class="descrip">
                <p>En Créant un compte sur WebMinds Solutions,j'accéde <br> à mon espace personnelle qui <br> me permettent de:</p>
                <ul>
                    <li>Retrouver mes tâche et mes informations personnel</li>
                    <li>créer de nouvelles tâches et voir les détails de chaque tâche créée</li>
                    <li>Modifier le statut des tâches comme terminée</li>
                    <li>Supprimer une tâche</li>
                </ul>
            </div>
            <div class="traite2"></div>
            <div class="champ">
                <div class="nomutil">
            <div>
                    <label for="Prenom"> Prenom</label>
                        <input type="text" name="Prenom">
                </div>
                <div>
                    <label for="Nom"> Nom</label><br>
                        <input type="text" name="Nom">
                </div>
                </div>
                <div>
                    <label for="Email">Email</label>
                        <input type="email" name="Email">
                </div>
                <div>
                    <label for="MotDePasse"> Mot de passe</label>
                        <input type="passeword" name="MotDePasse">
                </div>
                <div>
                <label for="Role">Rôle :</label>
    <select name="Role" id="Role">
        <option value="administrateur">Administrateur</option>
        <option value="utilisateur">Utilisateur</option>
    </select>
                </div>
            <input type="submit" name="submit" value="JE CRÉER MON COMPTE">
            </div>
        </div>
    </fieldset>
</form>
</div>
<div class="form3">
    <h2>AUTHENFICATION</h2>
    <?php if(isset($erreur)) { echo '<p>' . $erreur . '</p>'; } ?>
<form  method="post">

  <div class="containers">
    <label for="uname"><b>Adresse email:</b></label>
    <input type="text" placeholder="Enter Username" name="Email" required><br>

    <label for="psw"><b>Mot de passe:</b></label><br>
    <input type="password" placeholder="Enter Password" name="MotDePasse" required>
        
    <button class="button" type="submit" name="connecter">connecter</button>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>
</div>
</div>
</div>
</body>
</html>