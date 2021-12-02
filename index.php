<?php
  session_start();
  include("src/fonction.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Page de Connexion </title>
  <link rel="stylesheet" type="text/css" href="asset/css/style.css">
  <link href="asset/css/bootstrap.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <script src="asset/js/jquery-3.5.1.min.js"></script>
</head>
<body>
  <script>
    
  </script>
  <div class="container">
    <div id="entete_login"><p>Le <span class="plaisir">plaisir</span> <span id="de">de</span> jouer</p></div>
    <div class="formulaire_connexion">
        <img src="asset/img/Images/logo-QuizzSA.png" id="logo_login">
        <h1 class="seConnecter">Se <span class="plaisir">Connecter</span></h1>
        <form action="index.php" method="POST">
          <input id="login" type="texte" name="login" placeholder="Login" class="inputLogin" value="">
          <div id="tooltipLogin">Le login entré est Incorrect</div>
          <input id="password" type="password" name="password" placeholder="Password" class="inputPassword">
          <div id="tooltipPassword">Le password entré est Incorrect</div>
          <div>
            <input id="btnConnexion" name="btnConnexion" type="Submit" value="Connexion">
            <p id="inscrire"> Vous n’avez pas de compte ? <a href="src/inscriptionJoueur.php" id="inscriptionJoueur">Inscrivez-vous</a></p>
          </div>
        </form>
    </div>
  </div>
  <script src="asset/js/script.js"></script>
</body>
</html>
<?php
  if (isset($_POST['login']) && isset($_POST['password'])) {
    connexion_admin();
    if(connexion_admin()=="connexion"){
      echo "kdfsdfksllslslklksfl";
    }
    else{
      echo "Pas Connexion";
    }
  }
?>
