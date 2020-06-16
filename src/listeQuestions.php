<!DOCTYPE html>
<html>
<head>
	<title>Page Admin</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/style.css">
    <style>
        
    </style>
</head>
<body>
	<div id="zoneListeQuestions">
        <div id="listeQuestionsJeu">

        </div>
    </div>
    <script>
        function delete_question(id_question){
            if (confirm("Etes-vous sûr de vouloir supprimer cette question ?")){
                $.ajax({
                    type:"POST",
                    url:"verificationLogin.php?param=id_question",
                    data:'id_question='+id_question,
                    success:function(reponse){
                    }                        
                });
            }
            else{
                window.stop();
            }
        }

        function edit_question(id_question){

        }
    </script>
	<script src="../asset/js/listeQuestions.js" async></script>
</body>
</html>
