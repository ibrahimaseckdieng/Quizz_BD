<script src="../asset/js/jquery-3.1.1.min.js"></script>
<script src="../asset/js/script.js">sessionStorage.clear();</script>
<?php
    session_start();
    session_destroy();
    header('Location:../index.php');
?>
<span id="paraInscrire">S'INSCRIRE</span>
        <span id="mesInscrire">Pour proposer des quizz</span>