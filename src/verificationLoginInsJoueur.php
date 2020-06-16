<?php
    require "conn.php";
    if (isset($_POST["loginIns"])) {
        $req = $bdd->prepare('select login from joueur where login=?');
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
?>