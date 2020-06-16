<?php
    session_start();
    if (isset($_SESSION['login'])) {
		$login=$_SESSION['login'];
    	$infosConn=$_SESSION['infosConn'];
	}
	else{
		header('Location: ../index.php');
	}
	include("fonction.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Page Admin</title>
	<link rel="stylesheet" type="text/css" href="../asset/css/test.css">
</head>
<body>
	<script src="../asset/js/jquery-3.1.1.min.js"></script>
	<script src="../asset/js/script.js"></script>
	<div id="container">
		<div id="haut">
			<img id="logoQuizzSA" src="../asset/img/Images/logo-QuizzSA.png">
			<h2 id="plaisir"> Le plaisir de jouer</h2>
		</div>
        <div id="formQuestion">
			<div id="parametrer">
                <p>
                    CREER ET PARAMETRER VOS QUIZZ
                </p>
                <div id="btnDeconnexion"><a href="deconnexion.php">Déconnexion</a></div>
			</div>
			<div id="menu">
				<div id="profil">
					<div id="divPP">
						<img id="avatarAdmin" src="<?php echo "../".trouverAvatar($login, $infosConn);?>">
					</div>
					<div id="filiationAdmin">
						<?php echo trouverPrenom($login, $infosConn)." ";echo trouverNom($login, $infosConn);?> 
					</div>
				</div>
				<div id="vertical-menu">
					<a href="#" class="active" id="listeQuestion">Liste Questions<img class="iconeMenu" src="../asset/img/Images/Icones/ic-liste.png"></a>
					<a href="#">Créer Admin<img class="iconeMenu" src="../asset/img/Images/Icones/ic-ajout.png"></a>
					<a href="#">Liste Joueurs<img class="iconeMenu" src="../asset/img/Images/Icones/ic-liste.png"></a>
					<a href="#">Créer Questions<img class="iconeMenu" src="../asset/img/Images/Icones/ic-ajout.png"></a>
				</div>
			</div>
			<div id="zoneInfo">
					
			</div>
		</div>
	</div>
	<script src="../asset/js/jquery-3.1.1.min.js"></script>
	<script src="../asset/js/script.js"></script>
</body>
</html>
