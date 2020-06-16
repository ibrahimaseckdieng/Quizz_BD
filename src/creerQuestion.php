<!DOCTYPE html>
<html>
<head>
	<title>Page Ajout Question</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/style.css">
    <style>
        /* CSS de la page creerQuestion.php*/
        
    </style>
</head>
<body>
    <div id="zoneAjoutQuestion">
        <h2>Ajouter une Question</h2>
        <form action="admin.php" method="POST" id="formAjoutQuestion">
        <div id="divQuestion">
            <label>Question</label>
            <input name="questionAjoute" id="questionAjoute">
            </input>
            <div id="tooltipAjoutQuestion" class="tooltipCreerQuestion">Ce champ ne peut pas être vide</div>
        </div>
        <div id="divNbrePoints">
            <label>Nbre de Points</label>
            <input type="number" name="nbrePointsQAjoute" min="10" max="50" step="10" id="nbrePointsQAjoute" />
            <div id="tooltipNbrePointsQAjoute" class="tooltipCreerQuestion">Ce champ ne peut pas être vide</div>
        </div>
        <div id="divSelect">
            <label>Type de réponse</label>
            <select id="typeReponse" name="typeReponse" onchange="mySelection()">
            <option>Choix multiple
                <option>Choix simple
                <option>Choix texte</select>
            <a href="#" id="ajouterReponse">
            <img src="../asset/img/Icones/ic-ajout-reponse.png" id="imgAjout">
            </a>
        </div>
        <div id="tooltipReponsesGenerees" class="tooltipCreerQuestion">
        </div>
        <div id="divReponses">
        </div>
        <div id="tooltipReponsesCoche" class="tooltipCreerQuestion">
        </div>
        <div id="divSubmit">
            <input type="submit" name="btnEnregistrerQuestion" value="Enregistrer" id="btnEnregistrerQuestion" />
        </div>
        </form>
	</div>
	<script src="../asset/js/creerQuestion.js"></script>
</body>
</html>
