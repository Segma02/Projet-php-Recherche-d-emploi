$(document).ready(function(){
    $('#chart_div').hide();
    $('#mespostes').hide();
    $("#echec").hide();
    
       /*

    ===============================================================================================================
    ===============================================================================================================
         ==========
     ==============       ===============      ===============     =======           =======      ================
    ===============       ===============      ===============     =======           =======     ==================
    ======                =====                ===============     =========       =========    ====================
    ======                =====                ======              ==========     ==========    ========     =======
     =====                ==============       ======              =========================    ========     =======
      ===============     ==============       ======   =========  =========================    ========     =======
       ===============    =====                ======    ========  =======   =====  ========    ====================
                ========  =====                ======    =====     =======    ===   ========    ====================
               ========   =====                ===============     =======          ========    =======      =======
               ======     ==============       ===============     =======          ========    =======      =======
    ===============       ==============       ===============     =======          ========    =======      =======
     ============
      ========

      ==============================================================================================================
      ==============================================================================================================
    */
 

    $('#btn-poste').on('click', function(){
       
        var departement = $('#departement').val();
        var contrat = $('#contrat').val();
        var poste = $('#poste-text').val();
        var valid = false;

       
        if(departement== null){ 
            valid =false;
            
        }else if(departement.length<7){
           
            valid=false;
        }else if(contrat ==null){
          
                valid=false;
            }else if(contrat!="CDI" && contrat!="CDD" && contrat!="Stagiaire"){
          
                valid = false;    
            }else if(poste ==null){
              
                valid=false; 
            }else if(poste.length<20){
               
                valid=false; 
            }else{
                    valid = true;
            }

                
                if(valid==true){


                    $.ajax({
                        type:'POST',
                        url:'Insertoffre',
                        dataType:'text',
                        data:{
                            departement:departement,
                            contrat:contrat,
                            poste:poste,
                            adresse:$('#adresse').val()
                        }
                    }).done(function(){
                        Swal.fire({
                            title:"Offre envoyée",
                            icon:"success"
                        })       
                    });
                }  
                
                if(valid == false){
                    Swal.fire({
                        title:"Echec",
                        text:"Veuillez revoir votre offre",
                        icon:"error"
                    })                                                      
                }
    });

    $('#btnOption2').on('click', function(){  
        setTimeout(function(){
            $('#chart_div').slideUp();
        },1000);
        setTimeout(function(){
            $('#mespostes').slideDown();
        },2000);

    });

    $('#btnOption1').on('click', function(){
       
        setTimeout(function(){
            $('#mespostes').slideUp();  
        },1000);

        setTimeout(function(){
            $('#chart_div').slideDown(500);
        },2000);
    });



 




    // editer page 
   

    
 
        $(".editoffre").click(function(){
            var id = $(this).attr('value');
            var departement = $('#edit_departement'+id).val();
            var contrat = $('#edit_contrat'+id).val();
    
            //partie edit_poste 
            var min = $('#edit_poste-text'+id).attr("minlength");
            var max = $('#edit_poste-text'+id).attr("maxlength");
            var  poste= $('#edit_poste-text'+id).val();
    
            var valid = false;
    
           
            if(departement ==""){ 
                valid =false;
            }else if(departement.length<10 || departement.length>20){
                valid=false;
            } else {
                valid =true;
            }
    
                if(contrat == ""){
                    valid=false;
                }else if(contrat!="CDI" && contrat!="CDD" && contrat!="Stagiaire"){   
                    valid = false;    
                }else{
                    valid=true; 
                }
    
        
                    if(poste==""){
                        valid = false;
                    }else if(poste.length<min || poste.length>max){
                        valid = false;
                    }else{
                        
                        valid =true;
                    }
            
    
               
    
                    
                    if(valid==true){
                           $.ajax({
                                async:true,
                                type:'post',
                                url:'Edit_Offre',
                                dataType:"text",
                                data:{
                                    "editer":id,
                                    "departement": departement,
                                    "contrat":contrat,
                                    "poste":poste
                                }
                           })
                           .done(function(){
                            Swal.fire({
                                title:'Offre Modifié',
                                icon:"success"
                            });
                            setTimeout(function(){
                                $('#offre-card'+id).load('refreshEdit');
                            },2000);
                           });
                    }  
                    if(valid == false){
                            Swal.fire({
                                title:"Echec",
                                text:"Votre modification a échoué",
                                icon:"error"
                            })                                               
                    }
                   
        });


        //chart js 
        
      
    $.ajax({
        url:'chartJs',
        dataType:'json'
    })
    .done(function(reponse){
       var nb_candidats =[];
       var date = [];

       for(let i=0; i<reponse.length; i++){
           nb_candidats.push(reponse[i].id);
           date.push(reponse[i].creation);
       }

       
       var ctx = document.getElementById('myChart').getContext('2d');
       var myChart = new Chart(ctx, {
       type: 'pie',
       data: {
           labels:date,
           datasets: [{
               label: 'Nombre de candidats atteints'+nb_candidats.length,
               data: nb_candidats,
               backgroundColor: [
                   '#FF0057',
                   '#C74C42',
                   '#E3254C',
                   '#FA7557',
                   '#FA7557',
                   '#FBA38F',
                   '#FA8E8E',
                   '#FA8E4C',
                   '#FBB3B3',
                   '#FF0057',
                   '#C74C42',
                   '#E3254C',
                   '#FA7557',
                   '#FA7557',
                   '#FBA38A',
                   '#FA8E8E',
                   '#FA8E4C',
                   '#FBB3B3',
                   '#FF0057',
                   '#C74C42',
                   '#E3254C',
                   '#FA7557',
                   '#FA7557',
                   '#FBA38F',
                   '#FA8E8E',
                   '#FA8E4C',
                   '#FBB3B3'
               ],
               borderWidth: 0
           }]
       },
       options: {
           scales: {
               yAxes: [{
                   ticks: {
                       beginAtZero: true
                   }
               }]
           },
           animation: {
            onProgress: function(animation) {
                progress.value = animation.animationObject.currentStep / animation.animationObject.numSteps;
            }
        },
        responsive:true
       }
   });
    });



    //recherche candidats

     $('#search-candidats').keyup(function(){
         $('#result-candidats').html('');
         var value = $(this).val();

            if(value !=""){
                $.ajax({
                    type:'post',
                    url:'search',
                    data:{
                        'profession':encodeURIComponent(value)
                    }
                }).done(function(data){
                    if(data){  //si les donnees existent
                        $('#result-candidats').append(data);
                        $('#candidats-notifications').hide();
                    }
                });
            }else{
                $('#candidats-notifications').fadeIn();
            }
     });

     
     $('#search_public').keyup(function(){

        var search= $(this).val();
        $('#result-public').html(''); //mettre la page a blanc 
         if(search !=""){
             $.ajax({
                type:'post',
                url:'cv_public',
                data:{
                    'profession':search
                }
             }).done(function(data){
                if(data){ //si les donnees existent
                    $('#result-public').append(data);
                   $('#row-home').hide();
                }
             });
         }else{
            $('#row-home').fadeIn();
         }
     });
});