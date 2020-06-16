$(function(){
   btnConnexion.addEventListener('click',function(e) {
     let login=$('#login').val();
     let password=$('#password').val();
     $.ajax({
       type:"POST",
       url:"src/verificationConnexion.php",
       data:'login='+login,
       success:function(data){
         var tooltipLogin = document.getElementById("tooltipLogin");
         if (data=="reussi") {
           tooltipLogin.style.display = "none";
         }
         if (data=="echec"){
           tooltipLogin.style.display = "block";
           window.stop();
         }
         if (data=="desactive"){
          tooltipLogin.innerHTML="Votre Compte a été desactive !"
          tooltipLogin.style.display = "block";
          window.stop();
         }
       }
     });

     $.ajax({
       type:"POST",
       url:"src/verificationConnexion.php",
       data:'password='+password,
       success:function(data){
         var tooltipPassword = document.getElementById("tooltipPassword");
         if (data=="reussi") {
           tooltipPassword.style.display = "none";
         }
         else{
           tooltipPassword.style.display = "block";
           window.stop();
         }
       }
     });
   });
 });

function deactivateTooltips() {
   let tooltipLogin=document.getElementById('tooltipLogin');
   tooltipLogin.style.display = 'none';
   let tooltipPassword=document.getElementById('tooltipPassword');
   tooltipPassword.style.display = 'none';
}
deactivateTooltips();


