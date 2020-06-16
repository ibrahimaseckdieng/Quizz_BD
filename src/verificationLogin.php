<?php
    
    $param=$_GET['param'];
    if($param=="loginIns"){
        verificationLoginIns();
    }
    if($param=="listeQuestions"){
        getAllQuestionsBySql();
    }
    if($param=="listeReponses"){
        getAllReponsesBySql();
    }
    if($param=="listeJoueurs"){
        getAllPlayersBySql();
    }
    if($param=="listeAdmins"){
        getAllAdminsBySql();
    }
    if($param=="id_question"){
        supprimerQuestion();
    }
    if($param=="supprimerJoueur"){
        supprimerJoueur();
    }
    if($param=="desactiverJoueur"){
        desactive_active_joueur();
    }
    if($param=="enregistrerQuestion"){
        enregistrer_question_deja_repondu();
    }
    function verificationLoginIns(){
        require "conn.php";
        if (isset($_POST["loginIns"])) {
            $req = $bdd->prepare('select login from admin where login=?');
            $req->execute(array($_POST["loginIns"]));
            $donnees=$req->fetch();
            if (count($donnees)>1) {
                echo "echec";
                return;
            }
            else{
                echo "reussi";
                return;
            }
        }
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
        echo json_encode($questions, JSON_HEX_TAG);
    }

    function getAllReponsesBySql(){
        require "conn.php";
        $question=getAllQuestionsBySqlBis();
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
        echo json_encode($tabReponses, JSON_HEX_TAG);
    }
    function getAllQuestionsBySqlBis(){
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

    function getAllPlayersBySql(){
        require "conn.php";
        $req = $bdd->prepare('select login, password, prenom, nom, score, statut from joueur ORDER BY score DESC');
        $req->execute(array());
        $players=array();
        while($donnees=$req->fetch()){
            $player=array();
            $player['login']=$donnees['login'];
            $player['password']=$donnees['password'];
            $player['prenom']=$donnees['prenom'];
            $player['nom']=$donnees['nom'];
            $player['score']=$donnees['score'];
            $player['statut']=$donnees['statut'];
            array_push($players, $player);
        }
        echo json_encode($players);
    }
    function getAllAdminsBySql(){
        require "conn.php";
        $req = $bdd->prepare('select login, password, prenom, nom from admin');
        $req->execute(array());
        $admins=array();
        while($donnees=$req->fetch()){
            $admin=array();
            $admin['login']=$donnees['login'];
            $admin['password']=$donnees['password'];
            $admin['prenom']=$donnees['prenom'];
            $admin['nom']=$donnees['nom'];
            array_push($admins, $admin);
        }
        echo json_encode($admins);
    }
    function supprimerQuestion(){
        require "conn.php";
        $req = $bdd->prepare('DELETE FROM question WHERE id_question =?');
        $req->execute(array($_POST["id_question"]));
        $reponse=$req->fetch();
        echo $reponse;
    }
    function supprimerJoueur(){
        require "conn.php";
        $req = $bdd->prepare('DELETE FROM joueur WHERE login =?');
        $req->execute(array($_POST["login"]));
        $reponse=$req->fetch();
        echo $reponse;
    }
    function desactive_active_joueur(){
        require "conn.php";
        $req = $bdd->prepare('select statut from joueur where login=?');
        $req->execute(array($_POST["login"]));
        $donnees=$req->fetch();
        if ($donnees['statut']=="active") {
            $req = $bdd->prepare('UPDATE joueur SET statut =:statut WHERE login =:login');
            $req->execute(array(
                'statut'=>"desactive",
                'login'=>$_POST["login"],
            ));
        }
        else{
            $req = $bdd->prepare('UPDATE joueur SET statut =:statut WHERE login =:login');
            $req->execute(array(
                'statut'=>"active",
                'login'=>$_POST["login"],
            )); 
        }
        echo $donnees['statut'];
    }
    function enregistrer_question_deja_repondu(){
        require "conn.php";
        $req = $bdd->prepare('INSERT INTO questionsrepondues(login, id_question) VALUES(:login, :id_question)');
        $req->execute(array(
        'login' => $_POST["login"],
        'id_question' => $_POST["id_question"]));
    }
?>