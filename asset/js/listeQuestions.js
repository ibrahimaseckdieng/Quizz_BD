$(function(){
    var ques=2;
    var allQuestionss;
    $.ajax({
        type:"POST",
        url:"verificationLogin.php?param=listeQuestions",
        data:'ques='+ques,
        success:function(allQuestions){
            let data= JSON.parse(allQuestions);
            let listeQuestionsJeu = document.getElementById("listeQuestionsJeu");
            for (let i=0;i<data.length;i++){
                var rep=2;
                $.ajax({
                    type:"POST",
                    url:"verificationLogin.php?param=listeReponses",
                    data:'rep='+rep,
                    success:function(allReponses){
                        let reponses= JSON.parse(allReponses);
                        let divQuestion= document.createElement("div");
                        let question= document.createElement("div");

                        question.innerHTML=parseInt(i, 10)+1+". "+data[i]['question'];
                        question.style.color="#04A4FE";
                        question.style.fontSize="18px";
                        question.innerHTML+='<a onClick="delete_question(this.id)" href="" id="'+data[i]['id_question']+'"><img src="../asset/img/Icones/delete.png"/></a>';
                        question.innerHTML+='<a onClick="edit_question(this.id)" href="admin.php?page=creerQuestion" id="'+data[i]['id_question']+'"><img src="../asset/img/Icones/edit.png"/></a>';
                        question.style.marginLeft="2%";
                        divQuestion.appendChild(question);
                        if (data[i]['type_reponse']=="Choix multiple") {
                            for (let index = 0; index < reponses[i].length; index++) {
                                let divReponse=document.createElement("div");
                                let input=document.createElement("input");
                                let label=document.createElement("label");
                                divReponse.style.marginLeft="24px";
                                divReponse.style.fontWeight="bold";
                                input.id="reponse";
                                input.type="checkbox";
                                input.readOnly=true;
                                if (reponses[i][index].statut=='vrai') {
                                    input.checked="on";
                                }
                                label.for="reponse";
                                label.innerHTML=reponses[i][index]['reponse'];
                                divReponse.appendChild(input);
                                divReponse.appendChild(label);
                                divQuestion.appendChild(divReponse);
                            }
                        }
                        if (data[i]['type_reponse']=="Choix simple") {
                            for (let index = 0; index < reponses[i].length; index++) {
                                let divReponse=document.createElement("div");
                                let input=document.createElement("input");
                                let label=document.createElement("label");
                                divReponse.style.marginLeft="25px";
                                divReponse.style.fontWeight="bold";
                                input.id="reponse";
                                input.type="radio";
                                input.readOnly=true;
                                if (reponses[i][index].statut=='vrai') {
                                    input.checked="on";
                                }
                                label.for="reponse";
                                label.innerHTML=reponses[i][index]['reponse'];
                                divReponse.appendChild(input);
                                divReponse.appendChild(label);
                                divQuestion.appendChild(divReponse);
                            }
                        }
                        if (data[i]['type_reponse']=="Choix texte") {
                            for (let index = 0; index < reponses[i].length; index++) {
                                let divReponse=document.createElement("div");
                                let input=document.createElement("input");
                                divReponse.style.marginLeft="25px";
                                divReponse.style.fontWeight="bold";
                                input.style.fontWeight="bold";
                                input.type="text";
                                input.value=reponses[i][index]['reponse'];
                                input.readOnly=true;
                                divReponse.appendChild(input);
                                divQuestion.appendChild(divReponse);
                            }
                        }
                        listeQuestionsJeu.appendChild(divQuestion);
                        
                    }
                });
            }
             
        }
    });
});

    