var questionsDuJeu;
$.ajaxSetup({cache: false, async:false, global:false})
$.get('getQuestionDuJeu.php', function (data) {
    questionsDuJeu =JSON.parse(data);
});
var tableauReponsesEntrees;
$.ajaxSetup({cache: false, async:false, global:false})
$.get('getQuestionDuJeu.php', function (data) {
    tableauReponsesEntrees =JSON.parse(data);
});
var tableauReponsesCorrectes;
$.ajaxSetup({cache: false, async:false, global:false})
$.get('getTableauReponsesCorrectes.php', function (data) {
    tableauReponsesCorrectes =JSON.parse(data);
});
var tableauReponses;
$.ajaxSetup({cache: false, async:false, global:false})
$.get('getTableauReponses.php', function (data) {
    tableauReponses =JSON.parse(data);
});

function deconnexion() {
    if (confirm("Etes-vous sûr de vouloir vous déconnecter ?")){
        window.location.href = "deconnexion.php";
    } 
}
if (nbreQuestionJeu==questionCourante){
    recapitulatifQuizz(questionsDuJeu, questionCourante);
}
else{
    //alert(nbreQuestionJeu);
    let btnQuitterJeu=document.getElementById("btnQuitterJeu");
    btnQuitterJeu.addEventListener("click", function (e) {
        e.preventDefault();
        if (confirm("Etes-vous sûr de vouloir quitter ce quizz ?")){
            recapitulatifQuizz(questionsDuJeu, questionCourante);
            e.preventDefault();
            return;
        }
        
    });
    var total_seconds = 15 * 1;
    var c_minutes = parseInt(total_seconds / 60);
    var c_seconds = parseInt(total_seconds % 60);
    var timer;
    timer = setTimeout(CheckTime, 1000);
}

topScores();
function topScores(infosConn){
        let data= allScore;
        let tableMeilleursScores = document.getElementById("tableMeilleursScores");
        tableMeilleursScores.innerHTML="";
        for (let i=0;i<data.length;i++){
            let trInfos= document.createElement("tr");
            let tdNom= document.createElement("td");
            let tdScore= document.createElement("td");
            trInfos.style.color="#04A4FE";
            tdNom.style.width="70%";
            tdScore.style.width="25%";
            tdNom.innerHTML=data[i]['prenom']+" "+data[i]['nom'];
            tdScore.innerHTML=data[i]['score']+" pts";
            if(i==0){
                tdScore.style.borderBottom="2px solid green";
            }
            if(i==1){
                tdScore.style.borderBottom="2px solid blue";
            }
            if(i==2){
                tdScore.style.borderBottom="2px solid yellow";
            }
            if(i==3){
                tdScore.style.borderBottom="2px solid orange";
            }
            if(i==4){
                tdScore.style.borderBottom="2px solid red";
            }
            trInfos.appendChild(tdNom);
            trInfos.appendChild(tdScore);
            tableMeilleursScores.appendChild(trInfos);
        }    
}
//monScore();
function monScore(){
    let tableMonScore = document.getElementById("tableMonScore");
    tableMonScore.innerHTML="";
    let div=document.createElement('div');
    div.innerHTML=sessionStorage.getItem("score")+" pts";
    div.style.width="100%";
    div.style.height="100px";
    div.style.fontSize="40px";
    div.style.color="#04A4FE";
    div.style.fontWeight="bold";
    div.style.marginTop="50px";
    tableMonScore.appendChild(div);
}   
function trierTableauJoueurs(data){
    let echangeur;
    for (let index = 0; index < data.length; index++) {
        for (let k = 0; k < data.length; k++) {
            if (data[index].score>data[k].score) {
                echangeur=data[k];
                data[k]=data[index];
                data[index]=echangeur;
            }    
        } 
    }
    return data;
}
function verificationReponsesEntrees(reponsesEntrees, reponsesCorrectes){
    if (reponsesCorrectes.length!=reponsesEntrees.length) {
		return false;
	}
	for (let i=0; i < reponsesCorrectes.length; i++) { 
		if (reponsesEntrees.indexOf(reponsesCorrectes[i]['reponse'])==-1) {
			return false;
		}
	}
	return true;
}
function CheckTime() {
    document.getElementById("quiz-time-left").innerHTML = c_seconds + ' secondes ';
    if (total_seconds <= 0) {
        let btnSuivantJeu=document.getElementById("btnSuivantJeu");
        btnSuivantJeu.click();
    } 
    else {
        total_seconds = total_seconds - 1;
        c_minutes = parseInt(total_seconds / 60);
        c_seconds = parseInt(total_seconds % 60);
        timer = setTimeout(CheckTime, 1000);
    }
}
function recapitulatifQuizz(questionsDuJeu, questionCourante) {
    let data= questionsDuJeu;
    let zoneJeu = document.getElementById("zoneJeu");
    zoneJeu.innerHTML="";
    let correction=document.createElement("p");
    correction.innerHTML="Vous avez realise un Score de "+nombrePointsJoueur+" pts.";
    correction.style.textAlign="center";
    correction.style.border="2px solid rgb(81,191,208)";
    correction.style.width="90%";
    correction.style.height="70px";
    correction.style.paddingTop="10px";
    correction.style.marginLeft="5%";
    correction.style.marginTop="10px";
    correction.style.fontSize="25px";
    correction.style.fontWeight="bold";
    correction.style.background="rgb(239, 239, 239)";
    zoneJeu.appendChild(correction);
    let btnRejouer=document.createElement("a");
    btnRejouer.innerHTML="Rejouer";
    btnRejouer.href="joueur.php";
    btnRejouer.style.textDecoration="none"
    btnRejouer.style.textAlign="center";
    btnRejouer.style.border="2px solid rgb(81,191,208)";
    btnRejouer.style.width="30%";
    btnRejouer.style.height="35px";
    btnRejouer.style.marginLeft="40%";
    btnRejouer.style.fontSize="25px";
    btnRejouer.style.color="white";
    btnRejouer.style.borderRadius="2px";
    btnRejouer.style.background="rgb(81,191,208)";
    btnRejouer.id="btnRejouer";
    btnRejouer.name="btnRejouer";
    zoneJeu.appendChild(btnRejouer);
    for (let i=0;i<questionCourante;i++){
        var id_question=data[i].id_question;
        $.ajax({
            type:"POST",
            url:"verificationLogin.php?param=enregistrerQuestion",
            data:{'id_question':id_question,'login':login},
            success:function(data){
              
            }
        });
        let divQuestion= document.createElement("div");
        let question= document.createElement("span");
        let image= document.createElement("img");
        image.style.marginTop="0px";
        question.style.fontSize="15px";
        question.innerHTML=parseInt(i, 10)+1+". "+data[i].question+"("+data[i].nbre_point+" points)";
        if(verificationReponsesEntrees(tableauReponsesEntrees[i], tableauReponsesCorrectes[i])){
            image.src="../asset/img/Icones/cochevrai.png";
        }
        else{
            image.src="../asset/img/Icones/cochefaux.png";
        }
        divQuestion.appendChild(question);
        divQuestion.appendChild(image);
        if (data[i].type_reponse=="Choix multiple") {
            for (let index = 0; index < tableauReponses[i].length; index++) {
                let divReponse=document.createElement("div");
                let input=document.createElement("input");
                let label=document.createElement("label");
                divReponse.style.marginLeft="24px";
                divReponse.style.fontWeight="bold";
                input.id="reponse";
                input.type="checkbox";
                input.readOnly=true;
                if (tableauReponses[i][index].statut=='vrai') {
                    input.checked="on";
                }
                label.for="reponse";
                label.innerHTML=tableauReponses[i][index].reponse;
                divReponse.appendChild(input);
                divReponse.appendChild(label);
                divQuestion.appendChild(divReponse);
            }
        }
        if (data[i].type_reponse=="Choix simple") {
            for (let index = 0; index < tableauReponses[i].length; index++) {
                let divReponse=document.createElement("div");
                let input=document.createElement("input");
                let label=document.createElement("label");
                divReponse.style.marginLeft="25px";
                divReponse.style.fontWeight="bold";
                input.id="reponse";
                input.type="radio";
                input.readOnly=true;
                if (tableauReponses[i][index].statut=='vrai') {
                    input.checked="on";
                }
                label.for="reponse";
                label.innerHTML=tableauReponses[i][index].reponse;
                divReponse.appendChild(input);
                divReponse.appendChild(label);
                divQuestion.appendChild(divReponse);
            }
        }
        if (data[i].type_reponse=="Choix texte") {
            for (let index = 0; index < tableauReponses[i].length; index++) {
                let divReponse=document.createElement("div");
                let input=document.createElement("input");
                divReponse.style.marginLeft="25px";
                divReponse.style.fontWeight="bold";
                input.style.fontWeight="bold";
                input.id="reponse";
                input.type="text";
                input.value=tableauReponses[i][index].reponse;
                input.readOnly=true;
                divReponse.appendChild(input);
                divQuestion.appendChild(divReponse);
            }
        }
        zoneJeu.appendChild(divQuestion);
    }
}