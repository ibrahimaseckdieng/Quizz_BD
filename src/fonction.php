<?php

function verifierInfosConn($login, $password, $infosConn){
	for ($i=0; $i < count($infosConn) ; $i++) { 
		if ($infosConn[$i]->login==$login) {
			if ($infosConn[$i]->password==$password) {
				return true;
			}
			else{
				return false;
			}
		}
	}
	return false;
}

function trouverRole($login, $infosConn){
	for ($i=0; $i < count($infosConn) ; $i++) { 
		if ($infosConn[$i]->login==$login) {
			return $infosConn[$i]->role;
		}
	}
	return $infosConn[$i]->role;
}
function trouverAvatar($login, $infosConn){
	for ($i=0; $i < count($infosConn) ; $i++) { 
		if ($infosConn[$i]->login==$login) {
			return $infosConn[$i]->avatar;
		}
	}
	return $infosConn[$i]->avatar;
}
function trouverNom($login, $infosConn){
	for ($i=0; $i < count($infosConn) ; $i++) { 
		if ($infosConn[$i]->login==$login) {
			return $infosConn[$i]->nom;
		}
	}
	return $infosConn[$i]->nom;
}
function trouverPrenom($login, $infosConn){
	for ($i=0; $i < count($infosConn) ; $i++) { 
		if ($infosConn[$i]->login==$login) {
			return $infosConn[$i]->prenom;
		}
	}
	return $infosConn[$i]->prenom;
}

function validationDonnees($loginIns, $passwordIns, $passwordInsConf, $prenomIns, $nomIns, $infosConn){
	return(verifierExistanceLogin($loginIns, $infosConn)&&verifierIdentiquePasswords($passwordIns, $passwordInsConf)
			&&verifierPrenom($prenomIns)&&verifierNom($nomIns)&&verifierLogin($loginIns)&&verifierPassword($passwordIns));
}
function verifierExistanceLogin($loginIns, $infosConn){
    for ($i=0;$i<count($infosConn);$i++){
        if ($infosConn[$i]->login==$loginIns) {
            return false;
        }
    }
    return true;
}
function verifierIdentiquePasswords($passwordIns, $passwordInsConf){
    if ($passwordIns==$passwordInsConf) {
        return true;
    }
    else{
        return false;
    }
}
function verifierPrenom($prenomIns){
    if($prenomIns!=""){
        return true;
    }
    else{
        return false;
    }
}
function verifierNom($nomIns){
    if($nomIns!=""){
        return true;
    }
    else{
        return false;
    }
}
function verifierLogin($loginIns){
    if($loginIns!=""){
        return true;
    }
    else{
        return false;
    }
}
function verifierPassword($passwordIns){
    if($passwordIns!=""){
        return true;
    }
    else{
        return false;
    }
}

function verifierQuestion($question){
	if($question!=""){
        return true;
    }
    else{
        return false;
    }
}
function verifierNbrePoints($nbrePoints){
	if($nbrePoints!=""){
        return true;
    }
    else{
        return false;
    }
}
function verifierReponses(){
	$nbreReponsesCochees=0;
	foreach ($_POST as $key => $value) {
		if ($value=="") {
			return false;
		}
	}
	foreach ($_POST as $key => $value) {
		if ($value=="on") {
			return true;
		}
	}
	return false;
}
function getReponsesS(){
	$reponses=array();
	foreach ($_POST as $key => $value) {
		if($key!="questionAjoute" && $key!="nbrePointsQAjoute" && $key!="typeReponse" && $key!="btnEnregistrerQuestion" && $key!="reponse"){
			array_push($reponses, $value);
		}
	}
	return $reponses;
}
function getReponsesCorrectesS(){
	$reponsesCorrectes=array();
	$valeur="";
	foreach ($_POST as $key => $value) {
		if($key!="questionAjoute" && $key!="nbrePointsQAjoute" && $key!="typeReponse" && $key!="btnEnregistrerQuestion" && $key=="reponse"){
			array_push($reponsesCorrectes, $valeur);
		}
		$valeur=$value;
	}
	return $reponsesCorrectes;
}
function getReponsesM(){
	$reponses=array();
	foreach ($_POST as $key => $value) {
		if($key!="questionAjoute" && $key!="nbrePointsQAjoute" && $key!="typeReponse" && $key!="btnEnregistrerQuestion" && strstr($key, "checkboxRep")==FALSE){
			array_push($reponses, $value);
		}
	}
	return $reponses;
}
function getReponsesCorrectesM(){
	$reponsesCorrectes=array();
	$valeur="";
	foreach ($_POST as $key => $value) {
		if($key!="questionAjoute" && $key!="nbrePointsQAjoute" && $key!="typeReponse" && $key!="btnEnregistrerQuestion" && strstr($key, "checkboxRep")){
			array_push($reponsesCorrectes, $valeur);
		}
		$valeur=$value;
	}
	return $reponsesCorrectes;
}
function generationQuestions(){
	$nbreQuestionsParJeu=getNbreQuestions();
	$questionnaire = getQuestionnaireBySql();
	$questionsRepondues=getQuestionsReponduesBySql();
	$questionsDuJeu=array();
	for ($i=0; $i < $nbreQuestionsParJeu ; $i++) { 
		$nombreGenere=rand(0, count($questionnaire)-1);
		array_push($questionsDuJeu, $questionnaire[$nombreGenere]);
		array_splice($questionnaire, $nombreGenere, 1);
	}
	return $questionsDuJeu;
}

function getNbreQuestions(){
	require "conn.php";
	$req = $bdd->prepare('select nombre_question from questionsparjeu');
	$req->execute(array());
	$donnees=$req->fetch();
	return $donnees[0];
}

function getScoreTotal($questionsDuJeu){
	$score=0;
	for ($i=0; $i <count($questionsDuJeu) ; $i++) { 
		$score=$score+$questionsDuJeu[$i]->nbrePoints;
	}
	return $score;
}
function getReponsesEntrees(){
	$reponsesEntrees=array();
	$valeur="";
	foreach ($_POST as $key => $value) {
		$valeur=$value;
		if($key!="btnPrecedentJeu" && $key!="btnSuivantJeu"){
			array_push($reponsesEntrees, $valeur);
		}
	}
	return $reponsesEntrees;
}
function verificationReponsesEntrees($reponsesEntrees, $reponsesCorrectes){
	if (count($reponsesCorrectes)!=count($reponsesEntrees)) {
		return -1;
	}
	for ($i=0; $i < count($reponsesCorrectes); $i++) { 
		if (in_array($reponsesCorrectes[$i]['reponse'], $reponsesEntrees)==FALSE) {
			return -1;
		}
	}
	return 1;
}
function enregistrerScore($nombrePointsJoueur, $login){
	$file = '../asset/json/infoConnexion.json';
	$data = file_get_contents($file); 
	$infosConn = json_decode($data);
	for ($i=0; $i <count($infosConn) ; $i++) { 
		if ($infosConn[$i]->login==$login) {
			if ($infosConn[$i]->score < $nombrePointsJoueur) {
				$infosConn[$i]->score=$nombrePointsJoueur;
			}
		}
	}
	file_put_contents('../asset/json/infoConnexion.json', json_encode($infosConn, true));
}
function getScore($login, $infosConn){
    for ($i=0; $i < count($infosConn) ; $i++) {
        if ($infosConn[$i]->login==$login) {
            return $infosConn[$i]->score;
        }
    }
    return $infosConn[$i]->score;
}


/*Fonction d'accès à la Base de Données*/

function connexion_admin(){
	require "conn.php";
	$req = $bdd->prepare('select login, password, prenom, nom, avatar from admin where login=? and password=?');
	$req->execute(array($_POST["login"], $_POST["password"]));
	$donnees=$req->fetch();
	if (count($donnees)>1) {
		$_SESSION['login'] = $donnees['login'];
		$_SESSION['password'] = $donnees['password'];
		$_SESSION['prenom'] = $donnees['prenom'];
		$_SESSION['nom'] = $donnees['nom'];
		$_SESSION['avatar'] = $donnees['avatar'];
		echo "<script type='application/javascript'>document.location.replace('src/admin.php')</script>";
		return;
	}
	$req = $bdd->prepare('select login, password, prenom, nom, avatar from joueur where login=? and password=?');
	$req->execute(array($_POST["login"], $_POST["password"]));
	$donnees=$req->fetch();
	if (count($donnees)>1) {
		$_SESSION['login'] = $donnees['login'];
		$_SESSION['password'] = $donnees['password'];
		$_SESSION['prenom'] = $donnees['prenom'];
		$_SESSION['nom'] = $donnees['nom'];
		$_SESSION['avatar'] = $donnees['avatar'];
		echo "<script type='application/javascript'>document.location.replace('src/joueur.php')</script>";
		return;
	}
}

function inscriptionJoueur(){
	require "conn.php";
	$uploaddir = '../asset/img/Avatar/';
	$uploadfile = $uploaddir.basename($_FILES['avatarIns']['name']);
	move_uploaded_file($_FILES['avatarIns']['tmp_name'], $uploadfile);
	// Insertion
	$req = $bdd->prepare('INSERT INTO joueur(login, password, prenom, nom, avatar, score, statut) VALUES(:login,
					:password, :prenom, :nom, :avatar, :score,:statut)');
	$req->execute(array(
	'login' => $_POST["loginIns"],
	'password' => $_POST["passwordIns"],
	'prenom' => $_POST["prenomIns"],
	'nom' => $_POST["nomIns"],
	'avatar' => 'asset/img/Avatar/'.$_FILES['avatarIns']['name'],
	'score' => 0,
	'statut' => 'actif'));
}

function inscriptionAdmin(){
	require "conn.php";
	$uploaddir = '../asset/img/Avatar/';
	$uploadfile = $uploaddir.basename($_FILES['avatarIns']['name']);
	move_uploaded_file($_FILES['avatarIns']['tmp_name'], $uploadfile);
	// Insertion
	$req = $bdd->prepare('INSERT INTO admin(login, password, prenom, nom, avatar) VALUES(:login,
					:password, :prenom, :nom, :avatar)');
	$req->execute(array(
	'login' => $_POST["loginIns"],
	'password' => $_POST["passwordIns"],
	'prenom' => $_POST["prenomIns"],
	'nom' => $_POST["nomIns"],
	'avatar' => 'asset/img/Avatar/'.$_FILES['avatarIns']['name']));
}

function ajouterQuestionTexte(){
	require "conn.php";
	// Insertion
	$req = $bdd->prepare('INSERT INTO question(question, nbre_point , type_reponse) VALUES(:question,
					:nbre_point, :type_reponse)');
	$req->execute(array(
	'question' => $_POST["questionAjoute"],
	'nbre_point' => $_POST["nbrePointsQAjoute"],
	'type_reponse' => $_POST["typeReponse"]));

	$req = $bdd->prepare('select id_question from question where question=?');
	$req->execute(array($_POST["questionAjoute"]));
	$donnees=$req->fetch();
	$req = $bdd->prepare('INSERT INTO reponses(id_question, reponse , statut) VALUES(:id_question,
					:reponse, :statut)');
	$req->execute(array(
	'id_question' => $donnees['id_question'],
	'reponse' => $_POST["reponse"],
	'statut' =>'vrai'));
}

function ajouterQuestionSimple(){
	require "conn.php";
	// Insertion
	$req = $bdd->prepare('INSERT INTO question(question, nbre_point , type_reponse) VALUES(:question,
					:nbre_point, :type_reponse)');
	$req->execute(array(
	'question' => $_POST["questionAjoute"],
	'nbre_point' => $_POST["nbrePointsQAjoute"],
	'type_reponse' => $_POST["typeReponse"]));
	$req = $bdd->prepare('select id_question from question where question=?');
	$req->execute(array($_POST["questionAjoute"]));
	$donnees=$req->fetch();
	$reponses=getReponsesS();
	$reponsesCorrectes=getReponsesCorrectesS();
	for ($i=0; $i <count($reponses) ; $i++) { 
		$req = $bdd->prepare('INSERT INTO reponses(id_question, reponse , statut) VALUES(:id_question,
					:reponse, :statut)');
		if (in_array($reponses[$i], $reponsesCorrectes)) {
			$req->execute(array(
			'id_question' => $donnees['id_question'],
			'reponse' => $reponses[$i],
			'statut' =>'vrai'));
		}
		else{
			$req->execute(array(
			'id_question' => $donnees['id_question'],
			'reponse' => $reponses[$i],
			'statut' =>'faux'));
		}
	}
}

function ajouterQuestionMultiple(){
	require "conn.php";
	// Insertion
	$req = $bdd->prepare('INSERT INTO question(question, nbre_point , type_reponse) VALUES(:question,
					:nbre_point, :type_reponse)');
	$req->execute(array(
	'question' => $_POST["questionAjoute"],
	'nbre_point' => $_POST["nbrePointsQAjoute"],
	'type_reponse' => $_POST["typeReponse"]));

	$req = $bdd->prepare('select id_question from question where question=?');
	$req->execute(array($_POST["questionAjoute"]));
	$donnees=$req->fetch();
	$reponses=getReponsesM();
	$reponsesCorrectes=getReponsesCorrectesM();
	for ($i=0; $i <count($reponses) ; $i++) { 
		$req = $bdd->prepare('INSERT INTO reponses(id_question, reponse , statut) VALUES(:id_question,
					:reponse, :statut)');
		if (in_array($reponses[$i], $reponsesCorrectes)) {
			$req->execute(array(
			'id_question' => $donnees['id_question'],
			'reponse' => $reponses[$i],
			'statut' =>'vrai'));
		}
		else{
			$req->execute(array(
			'id_question' => $donnees['id_question'],
			'reponse' => $reponses[$i],
			'statut' =>'faux'));
		}
	}
}

function getQuestionnaireBySql(){
	require "conn.php";
	$req = $bdd->prepare('select id_question, question, nbre_point, type_reponse from question');
	$req->execute();
	$questions = array(); 
	while($donnees=$req->fetch()){
		$question=array();
		$question['id_question']=$donnees['id_question'];
		$question['question']=$donnees['question'];
		$question['nbre_point']=$donnees['nbre_point'];
		$question['type_reponse']=$donnees['type_reponse'];
		array_push($questions, $question);
	}
	return $questions;
}

function getQuestionsReponduesBySql(){
	require "conn.php";
	$req = $bdd->prepare('select id_question from questionsrepondues where login=?');
	$req->execute(array($_SESSION['login']));
	$questions = array(); 
	while($donnees=$req->fetch()){
		$question=array();
		$question['id_question']=$donnees['id_question'];
		array_push($questions, $question);
	}
	return $questions;
}

function getQuestionsIdQuestionReponduesBySql($questionsRepondues){
	$tab=array();
	for ($i=0; $i <count($questionsRepondues) ; $i++) { 
		$tab[$i]=$questionsRepondues[$i]['id_question'];
	}
	return $tab;
}

function getReponsesBySql($id_question){
	require "conn.php";
	$req = $bdd->prepare('select id_reponse, reponse, statut from reponses where id_question=?');
	$req->execute(array($id_question));
	$reponses = array(); 
	while($donnees=$req->fetch()){
		$reponse=array();
		$reponse['id_reponse']=$donnees['id_reponse'];
		$reponse['reponse']=$donnees['reponse'];
		$reponse['statut']=$donnees['statut'];
		array_push($reponses, $reponse);
	}
	return $reponses;
}

function getReponses($questionsDuJeu, $questionCourante, $tableauReponsesEntrees){
	$id_question=$questionsDuJeu[$questionCourante]['id_question'];
	$reponses=getReponsesBySql($id_question);
	if ($questionsDuJeu[$questionCourante]['type_reponse']=="Choix multiple") {
		for ($i=0; $i < count($reponses); $i++) {?> 
			<input type="checkbox" id="reponse<?php echo $i;?>" name="reponse<?php echo $i;?>" 
			value="<?php echo $reponses[$i]['reponse'];?>" 
			<?php if(isset($tableauReponsesEntrees[$questionCourante])&&
			in_array($reponses[$i], $tableauReponsesEntrees[$questionCourante])){echo "checked";}?>>
			<label for="reponse<?php echo $i;?>"><?php echo $reponses[$i]['reponse'];?></label><br>
			<?php
		}
	}
	if ($questionsDuJeu[$questionCourante]['type_reponse']=="Choix simple") {
		for ($i=0; $i < count($reponses); $i++) {?> 
			<input type="radio" id="reponse" name="reponse" 
			value="<?php echo $reponses[$i]['reponse'];?>"
			<?php if(isset($tableauReponsesEntrees[$questionCourante])&&
			in_array($reponses[$i], $tableauReponsesEntrees[$questionCourante])){echo "checked";}?>>
			<label for="reponse<?php echo $i;?>"><?php echo $reponses[$i]['reponse'];?></label><br>
			<?php
		}
	}
	if ($questionsDuJeu[$questionCourante]['type_reponse']=="Choix texte") {
		for ($i=0; $i < count($reponses); $i++) {?>
			<label for="reponse<?php echo $i;?>">reponse:</label> 
			<input style="width:50%; height:30px" type="text" id="reponse" name="reponse"
			value="<?php if(isset($tableauReponsesEntrees[$questionCourante])&&
			in_array($reponses[$i]['reponse'], $tableauReponsesEntrees[$questionCourante])){
				echo $reponses[$i]['reponse'];}?>">
			<?php
		}
	}
}

function getReponsesCorrectesBySql($id_question){
	require "conn.php";
	$req = $bdd->prepare('select id_reponse, reponse, statut from reponses where id_question=? and statut=?');
	$req->execute(array($id_question, 'vrai'));
	$reponses = array(); 
	while($donnees=$req->fetch()){
		$reponse=array();
		$reponse['id_reponse']=$donnees['id_reponse'];
		$reponse['reponse']=$donnees['reponse'];
		$reponse['statut']=$donnees['statut'];
		array_push($reponses, $reponse);
	}
	return $reponses;
}

function getTabReponsesCorrectesBySql($questionsDuJeu){
	require "conn.php";
	$tabReponses=array();
	for ($i=0; $i < count($questionsDuJeu); $i++) {
		$req = $bdd->prepare('select id_reponse, reponse, statut from reponses where id_question=? and statut=?');
		$req->execute(array($questionsDuJeu[$i]['id_question'], 'vrai'));
		$reponses = array(); 
		while($donnees=$req->fetch()){
			$reponse=array();
			$reponse['id_reponse']=$donnees['id_reponse'];
			$reponse['reponse']=$donnees['reponse'];
			$reponse['statut']=$donnees['statut'];
			array_push($reponses, $reponse);
		}
		array_push($tabReponses, $reponses);
	}
	return $tabReponses;
}

function getTabReponsesBySql($questionsDuJeu){
	require "conn.php";
	$tabReponses=array();
	for ($i=0; $i < count($questionsDuJeu); $i++) {
		$req = $bdd->prepare('select id_reponse, reponse, statut from reponses where id_question=?');
		$req->execute(array($questionsDuJeu[$i]['id_question']));
		$reponses = array(); 
		while($donnees=$req->fetch()){
			$reponse=array();
			$reponse['id_reponse']=$donnees['id_reponse'];
			$reponse['reponse']=$donnees['reponse'];
			$reponse['statut']=$donnees['statut'];
			array_push($reponses, $reponse);
		}
		array_push($tabReponses, $reponses);
	}
	return $tabReponses;
}

function enregistrerScoreBySql($nombrePointsJoueur, $login){
	require "conn.php";
	$req = $bdd->prepare('select score from joueur where login=?');
	$req->execute(array($login));
	$scores=array();
	while($donnees=$req->fetch()){
		$score=array();
		$score['score']=$donnees['score'];
		array_push($scores, $score);
	}
	if ($scores[0]['score']<$nombrePointsJoueur) {
		$req = $bdd->prepare('UPDATE joueur SET score= :score WHERE login = :login');
		$req->execute(array('score' => $nombrePointsJoueur,
							'login' => $login));
	}
}

function getScoreBySql($login){
	require "conn.php";
	$req = $bdd->prepare('select score from joueur where login=?');
	$req->execute(array($login));
	$scores=array();
	while($donnees=$req->fetch()){
		$score=array();
		$score['score']=$donnees['score'];
		array_push($scores, $score);
	}
	return $scores[0]['score'];
}

function getAllScoresBySql(){
	require "conn.php";
	$req = $bdd->prepare('select prenom, nom, score from joueur ORDER BY score DESC LIMIT 5');
	$req->execute(array());
	$scores=array();
	while($donnees=$req->fetch()){
		$score=array();
		$score['prenom']=$donnees['prenom'];
		$score['nom']=$donnees['nom'];
		$score['score']=$donnees['score'];
		array_push($scores, $score);
	}
	return $scores;
}

function getAllQuestionsBySql(){
	require "conn.php";
	$req = $bdd->prepare('select id_question , question, nbre_point, type_reponse from question');
	$req->execute(array());
	$questions=array();
	while($donnees=$req->fetch()){
		$question=array();
		$question['id_question']=$donnees['id_question'];
		$question['question']=$donnees['question'];
		$question['nbre_point']=$donnees['nbre_point'];
		$question['type_reponse']=$donnees['type_reponse'];
		array_push($questions, $question);
	}
	return $questions;
}

function getAllReponsesBySql(){
	require "conn.php";
	$question=getAllQuestionsBySql();
	$tabReponses=array();
	for ($i=0; $i < count($question); $i++) {
		$req = $bdd->prepare('select id_reponse, reponse, statut from reponses where id_question=?');
		$req->execute(array($question[$i]['id_question']));
		$reponses = array(); 
		while($donnees=$req->fetch()){
			$reponse=array();
			$reponse['id_reponse']=$donnees['id_reponse'];
			$reponse['reponse']=$donnees['reponse'];
			$reponse['statut']=$donnees['statut'];
			array_push($reponses, $reponse);
		}
		array_push($tabReponses, $reponses);
	}
	return $tabReponses;
}

function getAllPlayersBySql(){
	require "conn.php";
	$req = $bdd->prepare('select login, password, prenom, nom, score from joueur ORDER BY score DESC');
	$req->execute(array());
	$players=array();
	while($donnees=$req->fetch()){
		$player=array();
		$player['login']=$donnees['login'];
		$player['password']=$donnees['password'];
		$player['prenom']=$donnees['prenom'];
		$player['nom']=$donnees['nom'];
		$player['score']=$donnees['score'];
		array_push($players, $player);
	}
	return $players;
}
function getNombreQuestionsParJeuBySql(){
	require "conn.php";
	$req = $bdd->prepare('select nombre_question from questionsparjeu');
	$req->execute();
	$donnees=$req->fetch(); 
	return $donnees['nombre_question'];
}
function updateQuestionsParJeuBySql(){
	require "conn.php";
	$req = $bdd->prepare('TRUNCATE TABLE questionsparjeu');
	$req->execute(array());
	$req = $bdd->prepare('INSERT INTO questionsparjeu(nombre_question) VALUES(:nombre_question)');
    $req->execute(array(
		'nombre_question'=>$_POST["nbreQuestionsParJeu"]
	));
	return $_POST["nbreQuestionsParJeu"];
}

?>