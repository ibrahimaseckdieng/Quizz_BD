<?php
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
    echo json_encode($tabReponses, JSON_HEX_TAG);
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
?>