<!DOCTYPE html>
<html>
<head>
	<title>Page Admin</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/style.css">
</head>
<body>
	<div id="zoneListeJoueurs">
        <div id="titreListeJoueurs">LISTE DES JOUEURS PAR SCORE</div>
        <div id="listeJoueursParScore">
            <table id="tableListeJoueurs">
                <tr>
                    <td class="thListeJoueurs">Nom</td>
                    <td class="thListeJoueurs">Prenom</td>
                    <td class="thListeJoueurs">Score</td>
                    <td class="thListeJoueurs">Actions</td>
                </tr>
            </table>
        </div>
        <button id="btnSuivantJoueurs">Suivant</button>
    </div>
    <script>
        function delete_joueur(login){
            if (confirm("Etes-vous sûr de vouloir supprimer ce joueur ?")){
                $.ajax({
                    type:"POST",
                    url:"verificationLogin.php?param=supprimerJoueur",
                    data:'login='+login,
                    success:function(reponse){
                    }                        
                });
            }
            else{
                window.stop();
            }
        }

        function active_desactive_joueur(login){
                $.ajax({
                    type:"POST",
                    url:"verificationLogin.php?param=desactiverJoueur",
                    data:'login='+login,
                    success:function(reponse){
                        
                    }                        
                });
        }

        function edit_question(id_question){

        }
    </script>
	<script src="../asset/js/listeJoueurs.js" async></script>
</body>
</html>
