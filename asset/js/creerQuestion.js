let creerQuestion=document.getElementById("creerQuestion");
creerQuestion.classList.add("active");
let iconeCreerQuestion=document.getElementById("iconeCreerQuestion");
desactiverCouleurIcone();
iconeCreerQuestion.src="../asset/img/Images/Icones/ic-ajout-active.png";
var indiceReponseAjoutee=1;
var formAjoutQuestion=document.getElementById('formAjoutQuestion');
formAjoutQuestion.addEventListener('submit',function(e){	
    let questionAjoute = document.getElementById("questionAjoute").value;
    let nbrePointsQAjoute = document.getElementById("nbrePointsQAjoute").value;
    verifierQuestion(questionAjoute);
    verifierNbrePointsQuestion(nbrePointsQAjoute);
    verifierReponses();
    verifierReponsesCochees();
    if (verifierQuestion(questionAjoute) && verifierNbrePointsQuestion(nbrePointsQAjoute) && verifierReponses() && verifierReponsesCochees()) {
        alert("Question ajoutée avec succès !");
    }
    else{
        e.preventDefault(); 
    }
});
function verifierQuestion(questionAjoute){
    let tooltipAjoutQuestion = document.getElementById("tooltipAjoutQuestion");
    tooltipAjoutQuestion.innerHTML="La Question ne doit pas être vide";
    if (questionAjoute!="") {
        tooltipAjoutQuestion.style.display="none";
        return true;
    }
    else{
        tooltipAjoutQuestion.style.display="inline";
        return false;
    }
}
function verifierNbrePointsQuestion(nbrePointsQAjoute){
    let tooltipNbrePointsQAjoute = document.getElementById("tooltipNbrePointsQAjoute");
    tooltipNbrePointsQAjoute.innerHTML="Le nbre de points ne doit pas être vide";
    if (nbrePointsQAjoute!="") {
        tooltipNbrePointsQAjoute.style.display="none";
        return true;
    }
    else{
        tooltipNbrePointsQAjoute.style.display="inline";
        return false;
    }
}
function verifierReponses(){
    let reponses = document.getElementById("divReponses").querySelectorAll(".inputReponse");
    let tooltipReponsesGenerees= document.getElementById("tooltipReponsesGenerees");
    let type=document.getElementById("typeReponse").value;
    let retour=true;
    if (reponses.length<2 &&(type!="Choix texte")) {
        tooltipReponsesGenerees.innerHTML="Générez au minimum 2 réponses";
        tooltipReponsesGenerees.style.display="inline-block";
        retour=false;
    }
    else{
        if(type=="Choix texte") {
            return true;
        }
        else{
            tooltipReponsesGenerees.style.display="none";
        }
    }
    for (let i = 0; i < reponses.length; i++) {
        let idTooltipReponse="tooltipReponse"+(i+1);
        let tooltipReponse= document.getElementById(idTooltipReponse);
        if(reponses[i].value==""){
            retour=false;
            tooltipReponse.style.display="block";
        }
        else{
            tooltipReponse.style.display="none"; 
        }   
    }
    return retour;
}
function verifierReponsesCochees(){
    let type=document.getElementById("typeReponse").value;
    let tooltipReponsesCoche= document.getElementById("tooltipReponsesCoche");
    if (type=="Choix multiple") {
        let checkboxReponse = document.getElementById("divReponses").querySelectorAll(".checkboxReponse");
        let nbrChecked=0;
        for (let i = 0; i < checkboxReponse.length; i++) {
            if(checkboxReponse[i].checked){
                nbrChecked+=1;   
            }
        }
        if (nbrChecked<2) {
            tooltipReponsesCoche.innerHTML="Cochez au minimum 2 réponses";
            tooltipReponsesCoche.style.display="inline-block";
            return false;
        }
        else{
            tooltipReponsesCoche.style.display="none";
        }
    }
    if (type=="Choix simple") {
        let radioReponse = document.getElementById("divReponses").querySelectorAll(".radioReponse");
        let nbrChecked=0;
        for (let i = 0; i < radioReponse.length; i++) {
            if(radioReponse[i].checked){
                nbrChecked+=1;   
            }
        }
        if (nbrChecked<1) {
            tooltipReponsesCoche.innerHTML="Cochez une réponse";
            tooltipReponsesCoche.style.display="inline-block";
            return false;
        }
        else{
            tooltipReponsesCoche.style.display="none";
        }
    }
    return true;
}
document.querySelector('#ajouterReponse').addEventListener('click', () => {
    let type=document.getElementById("typeReponse").value;
    if (type=="Choix multiple") {
        choixMultiple();
    }
    else{
        if (type=="Choix simple") {
            choixSimple();
        }
        else{
            //choixTexte(); 
        }
    }
});
function mySelection() {
    let type=document.getElementById("typeReponse").value;
    if (type=="Choix multiple") {
        const divReponses = document.getElementById("divReponses");
        divReponses.innerHTML = '';
        indiceReponseAjoutee=1;
        //choixMultiple();
    }
    else{
        if (type=="Choix simple") {
            const divReponses = document.getElementById("divReponses");
            divReponses.innerHTML = '';
            indiceReponseAjoutee=1;
            //choixSimple(); 
        }
        else{
            const divReponses = document.getElementById("divReponses");
            divReponses.innerHTML = '';
            indiceReponseAjoutee=1;
            choixTexte();
        }
    }
}

function choixMultiple(){
    let type=document.getElementById("typeReponse").value;
    const divReponses = document.getElementById("divReponses");
        let label= document.createElement("label");
        let input = document.createElement("input");
        let checkbox = document.createElement("input");
        let tooltip = document.createElement("div");
        tooltip.innerHTML="Ce champ ne peut pas être vide";
        tooltip.id="tooltipReponse"+indiceReponseAjoutee;
        tooltip.className="tooltipCreerQuestion";
        tooltip.className="tooltipReponses";
        label.innerText= "Reponse "+indiceReponseAjoutee;
        input.type = "text";
        input.className="inputReponse";
        checkbox.className="checkboxReponse";
        input.name ="reponse"+indiceReponseAjoutee;
        checkbox.type="checkbox";
        checkbox.name="checkboxRep"+indiceReponseAjoutee;
        divReponses.appendChild(label);
        divReponses.appendChild(input);
        divReponses.appendChild(checkbox);
        divReponses.appendChild(tooltip);
        tooltip.style.display="none";
        indiceReponseAjoutee+=1;
}
function choixSimple(){
    let type=document.getElementById("typeReponse").value;
    const divReponses = document.getElementById("divReponses");
        let label= document.createElement("label");
        let input = document.createElement("input");
        let radio = document.createElement("input");
        let tooltip = document.createElement("div");
        tooltip.innerHTML="Ce champ ne peut pas être vide";
        tooltip.id="tooltipReponse"+indiceReponseAjoutee;
        tooltip.className="tooltipCreerQuestion";
        tooltip.className="tooltipReponses";
        label.innerText= "Reponse "+indiceReponseAjoutee;
        input.type = "text";
        input.className="inputReponse";
        radio.className="radioReponse";
        input.name ="reponse"+indiceReponseAjoutee;
        radio.type="radio";
        radio.name="reponse";
        divReponses.appendChild(label);
        divReponses.appendChild(input);
        divReponses.appendChild(radio);
        divReponses.appendChild(tooltip);
        tooltip.style.display="none";
        indiceReponseAjoutee+=1;
}
function choixTexte(){
    let type=document.getElementById("typeReponse").value;
    const divReponses = document.getElementById("divReponses");
        let label= document.createElement("label");
        let input = document.createElement("input");
        let tooltip = document.createElement("div");
        tooltip.innerHTML="Ce champ ne peut pas être vide";
        tooltip.id="tooltipReponse"+indiceReponseAjoutee;
        tooltip.className="tooltipCreerQuestion";
        tooltip.className="tooltipReponses";
        label.innerText= "Reponse ";
        input.type = "text";
        input.className="inputReponse";
        input.style.marginLeft="70px";
        input.name ="reponse";
        divReponses.appendChild(label);
        divReponses.appendChild(input);
        divReponses.appendChild(tooltip);
        tooltip.style.display="none";
        indiceReponseAjoutee+=1;
}
function deactivateTooltips() {
    let tooltips = document.querySelectorAll('.tooltipCreerQuestion'),
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
