<?php
    include("fonction.php");
    include("../asset/sql/fonctionBD.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Page Admin</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/style.css">
    <link href="../asset/css/bootstrap.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <script src="../asset/js/jquery-3.5.1.min.js"></script>
</head>
<body>
	<div class="container">
        <div id="entete_login"><p>Le <span class="plaisir">plaisir</span> <span id="de">de</span> jouer</p></div>
        <div class="formulaire_inscription">
            <h1 class="sincrire">S'INSCRIRE </h1>
            <h3 class="tester">Pour tester votre niveau de culture générale</h3>
            <form enctype="multipart/form-data" method="POST" action="inscriptionJoueur.php" id="formIns">
                <input type="text" id="prenomIns" name="prenomIns" class="inputIns" placeholder="Prenom">
                </input>
                <div class="tooltipIns" id="tooltipPrenomIns"></div>
                <input type="text" id="nomIns" name="nomIns" class="inputIns" placeholder="Nom">
                </input>
                <div class="tooltipIns" id="tooltipNomIns"></div>
                <input type="text" id="loginIns" name="loginIns" class="inputIns" placeholder="Login">
                </input>
                <div class="tooltipIns" id="tooltipLoginIns"></div>
                <input type="password" id="passwordIns" name="passwordIns" class="inputIns" placeholder="Password">
                </input>
                <div class="tooltipIns" id="tooltipPasswordIns"></div>
                <input type="password" id="passwordInsConf" name="passwordInsConf" class="inputIns" placeholder="Confirmer password">
                </input>
                <div class="tooltipIns" id="tooltipPasswordConfIns"></div>
                <label id="labelAvatar">Avatar</label>
                <label id="labelAvatarIns" for="avatarIns">Choisir un fichier</label>
                <input type="file" name="avatarIns" id="avatarIns" onchange = "loadFile (event)"></input>
                <div><input type="Submit" name="btnIns" value="Créer compte" id="btnIns" ></div>
                </input>
            </form>
            <div id="divAvatarIns">
                <img id="ApercuAvatarIns"/>
                <figcaption id="figcaptionAvatarIns">Avatar Admin</figcaption>
                <img src="../asset/img/Images/logo-QuizzSA.png" id="logo_inscription">
            </div>
        </div>
    </div>
    <script>
        var ApercuAvatarIns = document.getElementById('ApercuAvatarIns');
            ApercuAvatarIns.src ="../asset/img/Icones/profil2.png";
            ApercuAvatarIns.onload = function() {
            URL.revokeObjectURL(ApercuAvatarIns.src)
            }
            document.getElementById('figcaptionAvatarIns').style.display="inline";
        var loadFile = function(event) {
            var ApercuAvatarIns = document.getElementById('ApercuAvatarIns');
            ApercuAvatarIns.src = URL.createObjectURL(event.target.files[0]);
            ApercuAvatarIns.onload = function() {
            URL.revokeObjectURL(ApercuAvatarIns.src)
            }
            document.getElementById('figcaptionAvatarIns').style.display="inline";
        };
    </script>
    <script src="../asset/js/inscriptionJoueur.js" async></script>
</body>
</html>
<?php
    if (isset($_POST['prenomIns'])) {
        inscriptionJoueur();
    }
?>