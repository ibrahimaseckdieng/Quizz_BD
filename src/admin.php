<?php
session_start();
if (isset($_SESSION['login'])) {
   $login = $_SESSION['login'];
   $prenom= $_SESSION['prenom'];
   $nom= $_SESSION['nom'];
   $avatar= $_SESSION['avatar'];
} else {
   header('Location: ../index.php');
}
include("fonction.php");
?>
<!DOCTYPE html>
<html>
<head>
   <title>Page Admin</title>
   <link rel="stylesheet" type="text/css" href="../asset/css/style.css">
   <link href="../asset/css/bootstrap.css" rel="stylesheet">
   <meta name="viewport" content="width=device-width,initial-scale=1.0">
   <script src="../asset/js/jquery-3.5.1.min.js"></script>
   <style>
      /* Style the navigation menu */
      .topnav {
      overflow: hidden;
      background-color: #333;
      position: relative;
      }

      /* Hide the links inside the navigation menu (except for logo/home) */
      .topnav #myLinks {
      display: none;
      }

      /* Style navigation menu links */
      .topnav a {
      color: white;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
      display: block;
      }

      /* Style the hamburger menu */
      .topnav a.icon {
      background: black;
      display: block;
      position: absolute;
      right: 0;
      top: 0;
      }

      /* Add a grey background color on mouse-over */
      .topnav a:hover {
      background-color: #ddd;
      color: black;
      }

      /* Style the active link (or home/logo) */
      .active {
      background-color: #4CAF50;
      color: white;
      }
   </style>
</head>
<body>
   <script>
      var question = <?php echo json_encode($question, JSON_HEX_TAG); ?>;
      
      var allReponses = <?php echo json_encode(getAllReponsesBySql(), JSON_HEX_TAG); ?>;
   </script>
   <div class="container">
      <div id="entete_login">
         <img src="../asset/img/Images/logo-QuizzSA.png" id="logo_quizz">
         <p id="message">Le <span class="plaisir">plaisir</span> <span id="de">de</span> jouer</p>
         <button id="btnDeconnexion" onclick="deconnexion()">Déconnexion</button>
      </div>
         <div id="menu_hamburger">
            <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <!-- Top Navigation Menu -->
            <div class="topnav">
               <img id="avatarAdminHamburger" src="<?php echo "../" . $avatar; ?>">
               <button id="btnDeconnexionHamburger" onclick="deconnexion()">Déconnexion</button>
               <!-- Navigation links (hidden by default) -->
               <div id="myLinks">
                  <a href="?page=listeQuestions" id="listeQuestions">Liste Questions<img id="iconeListeQuestions" class="iconeMenu" src="../asset/img/Icones/interrogation.png"></a>
                  <a href="?page=creerAdmin" id="creerAdmin">Créer Admin<img id="iconeCreerAdmin" class="iconeMenu" src="../asset/img/Icones/ajout_personne.png"></a>
                  <a href="?page=listeJoueurs" id="listeJoueurs">Liste Joueurs<img id="iconeListeJoueurs" class="iconeMenu" src="../asset/img/Icones/liste.png"></a>
                  <a href="?page=creerQuestion" id="creerQuestion">Créer Question<img id="iconeCreerQuestion" class="iconeMenu" src="../asset/img/Icones/ajout_liste.png"></a>
                  <a href="#" id="dashBoard">DashBoard<img class="iconeMenu" src="../asset/img/Icones/dashboard.png"></a>
               </div>
               <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
               <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                  <i class="fa fa-bars"></i>
               </a>
            </div>
         </div>
      <div class="cadre">
         <div id="menu">
            <div id="profil">
               <div id="divPP">
                  <img id="avatarAdmin" src="<?php echo "../" . $avatar; ?>">
               </div>
               <div id="filiationAdmin">
                  <?php echo $prenom . " ";
                        echo $nom; 
                  ?>
               </div>
            </div>
            <div id="vertical-menu">
               <a href="?page=listeQuestions" id="listeQuestions">Liste Questions<img id="iconeListeQuestions" class="iconeMenu" src="../asset/img/Icones/interrogation.png"></a>
               <a href="?page=creerAdmin" id="creerAdmin">Créer Admin<img id="iconeCreerAdmin" class="iconeMenu" src="../asset/img/Icones/ajout_personne.png"></a>
               <a href="?page=listeJoueurs" id="listeJoueurs">Liste Joueurs<img id="iconeListeJoueurs" class="iconeMenu" src="../asset/img/Icones/liste.png"></a>
               <a href="?page=creerQuestion" id="creerQuestion">Créer Question<img id="iconeCreerQuestion" class="iconeMenu" src="../asset/img/Icones/ajout_liste.png"></a>
               <a href="?page=listeAdmins" id="listeAdmins">Liste Admins<img id="iconeListeJoueurs" class="iconeMenu" src="../asset/img/Icones/liste.png"></a>
               <a href="#" id="dashBoard">DashBoard<img class="iconeMenu" src="../asset/img/Icones/dashboard.png"></a>
            </div>
            <form action="admin.php" method="POST" id="formNbreQuestionsParjeu">
               <label>Nombre de questions/Jeu</label>
               <input type="num" name="nbreQuestionsParJeu" id="nbreQuestionsParJeu" min="5" max="15" value="<?php echo getNombreQuestionsParJeuBySql();?>">
               <input type="Submit" name="btnNbreQuestions" id="btnNbreQuestions" value="OK">
            </form>
         </div>
         <?php
            if (isset($_GET['page'])) {
               include($_GET['page'] . '.php');
            } else {
               include('creerQuestion.php');
            }
         ?>
         <footer><p>Vous êtes connecté en tant que Admin</p></footer>  
      </div>
   </div>
   <script>
      /* Toggle between showing and hiding the navigation menu links when the user clicks on the hamburger menu / bar icon */
      function myFunction() {
         var x = document.getElementById("myLinks");
         if (x.style.display === "block") {
            x.style.display = "none";
         } else {
            x.style.display = "block";
         }
      }
   </script>
   <script src="../asset/js/admin.js" async></script>
</body>
</html>
<?php
   if (isset($_POST['nbreQuestionsParJeu']) && $_POST['nbreQuestionsParJeu'] >= 5) {
      updateQuestionsParJeuBySql();
      
   }
   if (isset($_POST['btnEnregistrerQuestion'])) {
      if (verifierQuestion($_POST['questionAjoute']) && verifierNbrePoints($_POST['nbrePointsQAjoute'])
         && $_POST['typeReponse'] == "Choix texte" && isset($_POST['reponse'])) {
            ajouterQuestionTexte();
      }
      if (verifierQuestion($_POST['questionAjoute']) && verifierNbrePoints($_POST['nbrePointsQAjoute'])
         && $_POST['typeReponse'] == "Choix simple" && isset($_POST['reponse']) && verifierReponses()) {
            ajouterQuestionSimple();
      }
      if (verifierQuestion($_POST['questionAjoute']) && verifierNbrePoints($_POST['nbrePointsQAjoute'])
         && $_POST['typeReponse'] == "Choix multiple" && verifierReponses()) {
            ajouterQuestionMultiple();
      }
   }
   if (isset($_POST['prenomIns'])) {
      inscriptionAdmin();
  }
?>
