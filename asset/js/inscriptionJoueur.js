$(function(){
    formIns.addEventListener('submit',function(e){
        let loginIns=$('#loginIns').val();	
        $.ajax({
            type:"POST",
            url:"verificationLoginInsJoueur.php",
            data:'loginIns='+loginIns,
            success:function(data){
                var tooltipLoginIns = document.getElementById("tooltipLoginIns");
                if (data=="reussi") {
                    alert(data)
                    tooltipLoginIns.style.display="none";
                }
                else{
                    window.stop();
                    tooltipLoginIns.innerHTML="Le Login choisi existe déjà";
                    tooltipLoginIns.style.display="block";
                    
                }
            }
        });		
            let login = document.getElementById("loginIns").value;
            let prenomIns = document.getElementById("prenomIns").value;
            let nomIns = document.getElementById("nomIns").value;
            let passwordIns = document.getElementById("passwordIns").value;
            let passwordInsConf = document.getElementById("passwordInsConf").value;
            let verifLogin=verifierLogin(login), verifPrenom=verifierPrenom(prenomIns), verifNom=verifierNom(nomIns), verifPassword= verifierPassword(passwordIns);
            let verifIdentiquePasswords=verifierIdentiquePasswords(passwordIns, passwordInsConf);
            if (verifPrenom==true && verifNom==true && verifLogin==true && verifPassword==true && verifIdentiquePasswords==true) {
                alert("Admin créé avec succès !");
            }
            else{
                e.preventDefault();
            }
                
    });
});
function verifierExistanceLogin(login, data){
    for (i=0;i<data.length;i++){
        if (login==data[i].login) {
            var tooltipLoginIns = document.getElementById("tooltipLoginIns");
            tooltipLoginIns.innerHTML="Le Login choisi existe déjà";
            tooltipLoginIns.style.display="block";
            return true;
        }
    }
    return false;
}
function verifierIdentiquePasswords(passwordIns, passwordInsConf){
    if (passwordIns==passwordInsConf) {
        return true;
    }
    else{
        var tooltipPasswordConfIns = document.getElementById("tooltipPasswordConfIns");
        var passwordInsConf=document.getElementById("passwordInsConf");
        passwordInsConf.value="";
        tooltipPasswordConfIns.innerText="Ce champ doit-etre identique au champ password";
        tooltipPasswordConfIns.style.display="block"; 
        return false;
    }
}
function verifierPrenom(prenomIns){
    if(prenomIns!=""){
        return true;
    }
    else{
        var tooltipPrenomIns = document.getElementById("tooltipPrenomIns");
        tooltipPrenomIns.innerHTML="Le Prenom ne doit pas être vide";
        tooltipPrenomIns.style.display="block";
        return false;
    }
}
function verifierNom(nomIns){
    if(nomIns!=""){
        return true;
    }
    else{
        var tooltipNomIns = document.getElementById("tooltipNomIns");
        tooltipNomIns.innerHTML="Le Nom ne doit pas être vide";
        tooltipNomIns.style.display="block";
        return false;
    }
}
function verifierLogin(loginIns){
    if(loginIns!=""){
        return true;
    }
    else{
        var tooltipLoginIns = document.getElementById("tooltipLoginIns");
        tooltipLoginIns.innerHTML="Le Login ne doit pas être vide";
        tooltipLoginIns.style.display="block";
        return false;
    }
}
function verifierPassword(passwordIns){
    if(passwordIns!=""){
        return true;
    }
    else{
        var tooltipPasswordIns = document.getElementById("tooltipPasswordIns");
        tooltipPasswordIns.innerHTML="Le Password ne doit pas être vide";
        tooltipPasswordIns.style.display="block";
        return false;
    }
}
function deactivateTooltips() {
    let tooltips = document.querySelectorAll('.tooltipIns'),
        tooltipsLength = tooltips.length;
    for (let i = 0; i < tooltipsLength; i++) {
        tooltips[i].style.display = 'none';
    }
  
}
deactivateTooltips();
function desactiverCouleurIcone(){
    var icone = document.querySelectorAll('.iconeMenu'),
        iconeLength = icone.length;
    for (var i = 0; i < iconeLength; i++) {
        if(icone[i].src=="../asset/img/Images/Icones/ic-liste-active.png"){
            icone[i].src=="../asset/img/Images/Icones/ic-liste.png"
        }
        if(icone[i].src=="../asset/img/Images/Icones/ic-ajout-active.png"){
            icone[i].src=="../asset/img/Images/Icones/ic-ajout.png"
        }
    }
}
function readTextFile(file, callback) {
    var rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("GET", file, true);
    rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4 && rawFile.status == "200") {
            callback(rawFile.responseText);
        }
    }
    rawFile.send(null);
}