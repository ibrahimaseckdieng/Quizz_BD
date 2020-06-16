$(function(){
    var joue=5; 
    $.ajax({
        type:"POST",
        url:"verificationLogin.php?param=listeJoueurs",
        data:'joue='+joue,
        success:function(allPlayers){  
            let data= JSON.parse(allPlayers);
            sessionStorage.setItem("joueur", 0);
            let tableListeJoueurs = document.getElementById("tableListeJoueurs");
            for (let i=sessionStorage.getItem("joueur");(i<data.length && i<(sessionStorage.getItem("joueur")+15));i++){
                    let trInfos= document.createElement("tr");
                    trInfos.style.color="black";
                    trInfos.style.fontFamily="Times New Roman";
                    let tdNom= document.createElement("td");
                    let tdPrenom= document.createElement("td");
                    let tdScore= document.createElement("td");
                    let tdAction= document.createElement("td");
                    tdNom.innerHTML=data[i]['nom'];
                    tdPrenom.innerHTML=data[i]['prenom'];
                    tdScore.innerHTML=data[i]['score']+" pts";
                    tdAction.innerHTML='<a onClick="delete_joueur(this.id)" href="" id="'+data[i]['login']+'"><img alt="supprimer un joueur" src="../asset/img/Icones/delete.png"/></a>';
                    tdAction.innerHTML+=" ";
                    if (data[i]['statut']=="desactive") {
                        tdAction.innerHTML+='<a onClick="active_desactive_joueur(this.id)" href="" id="'+data[i]['login']+'"><img alt="supprimer un joueur" src="../asset/img/Icones/cadena.png"/></a>';
                    } 
                    else{
                        tdAction.innerHTML+='<a onClick="active_desactive_joueur(this.id)" href="" id="'+data[i]['login']+'"><img alt="supprimer un joueur" src="../asset/img/Icones/cadena_ouvert.png"/></a>';
                    }
                    
                    trInfos.appendChild(tdNom);
                    trInfos.appendChild(tdPrenom);
                    trInfos.appendChild(tdScore);
                    trInfos.appendChild(tdAction);
                    tableListeJoueurs.appendChild(trInfos);
            }
            let session=parseInt(sessionStorage.getItem("joueur"), 10)+15;
            sessionStorage.setItem("joueur", session);
            let btnSuivantJoueurs=document.getElementById('btnSuivantJoueurs');
            btnSuivantJoueurs.addEventListener("click", function(e){
                    let data= JSON.parse(allPlayers);
                    //data=trierTableauJoueurs(data);
                    if (sessionStorage.getItem("joueur")<data.length) {
                        let tableListeJoueurs = document.getElementById("tableListeJoueurs");
                        tableListeJoueurs.innerHTML="";
                        let tr1= document.createElement("tr");
                        let thNom= document.createElement("th");
                        let thPrenom= document.createElement("th");
                        let thScore= document.createElement("th");
                        thNom.innerHTML="Nom";
                        thPrenom.innerHTML="Prenom";
                        thScore.innerHTML="Score";
                        tr1.appendChild(thNom);
                        tr1.appendChild(thPrenom);
                        tr1.appendChild(thScore);
                        tableListeJoueurs.appendChild(tr1);
                        let limite=parseInt(sessionStorage.getItem("joueur"), 10)+15;
                        for (let i=sessionStorage.getItem("joueur");i<data.length && i<limite;i++){
                            let trInfos= document.createElement("tr");
                            trInfos.style.color="black";
                            trInfos.style.fontFamily="Times New Roman";
                            let tdNom= document.createElement("td");
                            let tdPrenom= document.createElement("td");
                            let tdScore= document.createElement("td");
                            tdNom.innerHTML=data[i]['nom'];
                            tdPrenom.innerHTML=data[i]['prenom'];
                            tdScore.innerHTML=data[i]['score']+"   pts";
                            trInfos.appendChild(tdNom);
                            trInfos.appendChild(tdPrenom);
                            trInfos.appendChild(tdScore);
                            tableListeJoueurs.appendChild(trInfos);
                        }
                        let session=parseInt(sessionStorage.getItem("joueur"), 10)+15;
                        sessionStorage.setItem("joueur", session);
                    }
                    else{
                        alert("La Liste des Joueurs est terminée");
                    } 
            });
        }
    });
});