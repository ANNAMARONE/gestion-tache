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
  <a href="index.php" class="nav-item is-active" data-active-color="orange" data-target="Home">Accueil</a>
  <a href="#" class="nav-item" data-active-color="green" data-target="About">Tâche</a>
  <a href="#" class="nav-item" data-active-color="blue" data-target="Testimonials">Ajouter une Tâche</a>
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
                <label for="role">Rôle :</label>
    <select name="role" id="role">
        <option value="administrateur">Administrateur</option>
        <option value="utilisateur">Utilisateur</option>
    </select>
                </div>
            <input type="submit" value="JE CRÉER MON COMPTE">
            </div>
        </div>
    </fieldset>
</form>
</div>
<div class="form3">
    <h2>Login Form</h2>

<form  method="post">

  <div class="containers">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required><br>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
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