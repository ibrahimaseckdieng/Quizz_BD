<?php
    session_start();
	if (isset($_SESSION['login'])) {
		$login = $_SESSION['login'];
      $prenom= $_SESSION['prenom'];
      $nom= $_SESSION['nom'];
      $avatar= $_SESSION['avatar'];
	}
	else{
		header('Location: ../index.php');
	}
    include("fonction.php");
    if ((isset($_POST['btnSuivantJeu'])==false && isset($_POST['btnPrecedentJeu'])==false) || isset($_POST['btnRejouer'])) {
        if(isset($_SESSION['questionCourante']) && $_SESSION['questionCourante']<5){
            $nombrePointsJoueur=$_SESSION['nombrePointsJoueur'];
            enregistrerScoreBySql($nombrePointsJoueur, $login);
        }
        $_SESSION['questionsDuJeu']=generationQuestions();
        $questionsDuJeu=$_SESSION['questionsDuJeu'];
        $tableauReponsesCorrectes=getTabReponsesCorrectesBySql($questionsDuJeu);
        $_SESSION['tableauReponsesCorrectes']=$tableauReponsesCorrectes;
        $tableauReponses=getTabReponsesBySql($questionsDuJeu);
        $_SESSION['tableauReponses']=$tableauReponses;
        $_SESSION['nombrePointsJoueur']=0;
        $nombrePointsJoueur=$_SESSION['nombrePointsJoueur'];
        $_SESSION['questionCourante']=0;
        $questionCourante=$_SESSION['questionCourante'];
        $_SESSION['tableauReponsesEntrees']=array();
        $tableauReponsesEntrees=$_SESSION['tableauReponsesEntrees'];
        $_SESSION['score']=getScoreBySql($login);
        $_SESSION['allScore']=getAllScoresBySql();
	}
    else{
        if(isset($_POST['btnSuivantJeu'])){
            $questionsDuJeu=$_SESSION['questionsDuJeu'];
            $questionCourante=$_SESSION['questionCourante'];
            $nombrePointsJoueur=$_SESSION['nombrePointsJoueur'];
            $reponsesEntrees=getReponsesEntrees();
            $tableauReponsesEntrees=$_SESSION['tableauReponsesEntrees'];
            $tableauReponsesEntrees[$questionCourante]= $reponsesEntrees;
            $id_question=$questionsDuJeu[$questionCourante]['id_question'];
            $reponsesCorrectes=getReponsesCorrectesBySql($id_question);
            if (verificationReponsesEntrees($reponsesEntrees, $reponsesCorrectes)==1) {
                $nombrePointsJoueur+= $questionsDuJeu[$questionCourante]['nbre_point'];
            }
            $_SESSION['questionCourante']+=1;
            $questionCourante=$_SESSION['questionCourante'];
            $_SESSION['nombrePointsJoueur']=$nombrePointsJoueur;
            $_SESSION['tableauReponsesEntrees']=$tableauReponsesEntrees;
        }
        else{
            $_SESSION['questionCourante']=$_SESSION['questionCourante']-1;
            $questionCourante=$_SESSION['questionCourante'];
            $questionsDuJeu=$_SESSION['questionsDuJeu'];
            $nombrePointsJoueur=$_SESSION['nombrePointsJoueur'];
            $tableauReponsesEntrees=$_SESSION['tableauReponsesEntrees'];
            $reponsesEntrees=$tableauReponsesEntrees[$questionCourante];
            $tableauReponsesEntrees[$questionCourante]= $reponsesEntrees;
            $id_question=$questionsDuJeu[$questionCourante]['id_question'];
            $reponsesCorrectes=getReponsesCorrectesBySql($id_question);
            if (verificationReponsesEntrees($reponsesEntrees, $reponsesCorrectes)==1) {
                $nombrePointsJoueur-= $questionsDuJeu[$questionCourante]['nbre_point'];
            }
            $_SESSION['nombrePointsJoueur']=$nombrePointsJoueur;
            $_SESSION['tableauReponsesEntrees']=$tableauReponsesEntrees;
        }
    }
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
        let questionCourante = <?php echo json_encode($questionCourante, JSON_HEX_TAG); ?>;
        let nbreQuestionJeu = <?php echo json_encode(count($questionsDuJeu), JSON_HEX_TAG); ?>;
        let nombrePointsJoueur = <?php echo json_encode($nombrePointsJoueur, JSON_HEX_TAG); ?>;
        let allScore = <?php echo json_encode($_SESSION['allScore'], JSON_HEX_TAG); ?>;
        var login = <?php echo json_encode($_SESSION['login'], JSON_HEX_TAG); ?>;
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
               <img id="avatarAdminHamburger" src="<?php echo "../" . $avatar;?>">
               <button id="btnDeconnexionHamburger" onclick="deconnexion()">Déconnexion</button>
               <!-- Navigation links (hidden by default) -->
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
                  <img id="avatarAdmin" src="<?php echo "../" . $avatar;?>">
               </div>
               <div id="filiationAdmin">
                  <?php echo $prenom . " ";
                        echo $nom; 
                  ?>
               </div>
            </div>
            <div id="score">
               <div id="top_scores">
                  <div id="titre_top_scores">Top Scores</div>
                  <table id="tableMeilleursScores">

                  </table>
               </div>
               <div id="mon_top_score">
                  <div id="titre_mon_top_score">Mon Top Score</div>
                  <div id="tableMonScore">
                     <p>
                        <?php echo $_SESSION['score']." pts";?>
                     </p>
                  </div>
               </div>
            </div>
            <div id="quiz-time">
               <p id="temps">Temps Restant:</p>
               <p id="quiz-time-left"></p>
             </div>
         </div>
         <div id="zoneJoueur">
            <div id="zoneJeu">
                <?php if ($questionCourante<count($questionsDuJeu)) {?>
                <div id="questionPosee">
                    <p>
                       
                    <?php echo $questionsDuJeu[$questionCourante]['question'];?></p>
                </div>
                <div id="pointQuestion">
                    <p>
                    <?php echo $questionsDuJeu[$questionCourante]['nbre_point']." pts";?></p>
                </div>
                <form action="joueur.php" id="formQuestionPosee" method="POST">
                    <div id="reponsesQuestionsPosee">
                    <?php getReponses($questionsDuJeu, $questionCourante, $tableauReponsesEntrees); ?>
                    </div>
                    <input type="Submit" id="btnPrecedentJeu" name="btnPrecedentJeu" value="Precedent" <?php if($questionCourante==0){echo "disabled";}?>></input>
                    <span id="niveauQuestion">
                        <?php
                           echo ($questionCourante+1)."/". count($questionsDuJeu);
                        ?> 
                    </span>
                    <input type="Submit" id="btnSuivantJeu" name="btnSuivantJeu" value="<?php if($questionCourante==count($questionsDuJeu)-1){echo " Terminer ";}else{echo "Suivant ";}?>">
                    </input>
                </form>
                <?php } else{ enregistrerScoreBySql($nombrePointsJoueur, $login); } ?>
            </div>
         </div>
         <?php
            
         ?>
         <footer><p>Vous êtes connecté en tant que Joueur</p></footer>
         <form action="joueur.php" id="formQuitter" method="POST">
            <input type="Submit" id="btnQuitterJeu" name="btnQuitterJeu" value="Quitter Quizz"></input>
         </form>  
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
   <script src="../asset/js/joueur.js" async></script>
</body>
</html>
