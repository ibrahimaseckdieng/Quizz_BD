<?php
    require "conn.php";
    if (isset($_POST["login"])) {
        $req = $bdd->prepare('select login, password, prenom, nom, avatar from admin where login=?');
        $req->execute(array($_POST["login"]));
        $donnees=$req->fetch();
        if (count($donnees)>1) {
            echo "reussi";
            return;
        }
        $req = $bdd->prepare('select login, password, prenom, nom, avatar, statut from joueur where login=?');
        $req->execute(array($_POST["login"]));
        $donnees=$req->fetch();
        if (count($donnees)>1) {
            if ($donnees['statut']=="active") {
                echo "reussi";
            } else {
                echo "desactive";
            }
            return;
        }
        echo "echec";
        return;
    }

    if (isset($_POST["password"])) {
        $req = $bdd->prepare('select login, password, prenom, nom, avatar from admin where password=?');
        $req->execute(array($_POST["password"]));
        $donnees=$req->fetch();
        if (count($donnees)>1) {
            echo "reussi";
            return;
        }
        $req = $bdd->prepare('select login, password, prenom, nom, avatar from joueur where password=?');
        $req->execute(array($_POST["password"]));
        $donnees=$req->fetch();
        if (count($donnees)>1) {
            echo "reussi";
            return;
        }
        echo "echec";
        return;
    }
?>