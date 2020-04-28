$(document).ready(function(){
   
       
    /*

    ===============================================================================================================
    ===============================================================================================================
           =========
     ==============       ===============        ============      =======           =======      ================
    ===============       ===============      ===============     =======           =======     ==================
    ======                =====                ===============     =========       =========    ====================
    ======                =====                ======              ==========     ==========    ========     =======
     =====                ==============       ======              =========================    ========     =======
      ===============     ==============       ======   =========  =========================    ========     =======
       ===============    =====                ======   ========   =======   =====  ========    ====================
                ========  =====                ======    =====     =======    ===   ========    ====================
               ========   =====                ===============     =======          ========    =======      =======
               ======     ==============       ===============     =======          ========    =======      =======
    ===============       ==============         ===========       =======          ========    =======      =======
     ============
      ====

      ==============================================================================================================
      ==============================================================================================================
    */


    

    $('.notif').on('click', function(){
      
            $('.badge-danger').remove();
            
    });


    //masqué !!!
    $('#row-appear-cv').hide();
    $('#mescv').hide();
    $('#success').hide();
    $('.alert-danger').hide();

    //START CV BTN 
    $("#start-cv").on('click', function(event){
        event.preventDefault();
        event.stopPropagation();
        $('#mescv').slideUp();
        setTimeout(function(){
            $('#row-appear-cv').slideDown("slow");
        },900);
    });


    

    //favoris

    //add
    $('.addF').click(function(){
        var id =$(this).val();
        
        $.ajax({
            type:'post',
            url:'addFavoris',
            dataType:'text',
            data:{
                "add":id
            }
        }).done(function(data){
          if(data == 1){
              Swal.fire({
                title:"Poste enregistré",
                text:"veuillez consulter la section favoris pour voir ce poste",
                icon:"success"
              });
          }
        });
    });

    //delete

    $('.deleteFavoris').click(function(){
        var id =$(this).val();

        if(id !=""){
            $.ajax({
                type:'post',
                url:'deleteFavoris',
                dataType:'text',
                data:{
                    "idF":id
                }
            }).done(function(data){
                if(data==1){
                    setTimeout(function(){
                        $('#media'+id).fadeOut();
                    },2000);

                    setTimeout(function(){
                        Swal.fire({
                            text:"Vous avez supprimé ce poste",
                            icon:"success"
                          });
                    },4000);
                }
               
            });
        }
    });
   
    $('#off_destinataire').mouseenter(function(){
        Swal.fire({
            'text':"Vous devez attendre la reponse de "+$(this).val(),
            'icon':"info"
        });
    });

    $('#link-reply').mouseenter(function(){
        Swal.fire({
            'text':"Vous avez répondu à une entreprise, veuillez patientez jusqu'à la prochaine réponse.",
            'icon':"info"
        });
    });
    
    $('#submit-off').mouseenter(function(){
        Swal.fire({
            'text':$(this).val()+", vous avez déjà envoyé votre cv",
            'icon':"info"
        });
    });
    if($())
    $('#cvsubmit').on('click', function(event){
        var profession = $('#profession').val();
        var mobile = $('#mobile').val();
        var adresse = $('#adresse').val();
        var pays = $('#lieu').val();
        var competence = $('#cp1').val();
        var langue = $('#lg1').val();
        var projet= $('#projet1').val();
        var experience =$('#exp-cv').val();

        var valid = false;
         
        if(profession==""){
         
            valid = false;
        }else if(profession.length<3){
          
            valid = false;
        }else{
            valid = true;
        }

                if(mobile==""){
                    
                    valid = false;
                }
                else {
                    valid =true;
                }   

                        if(adresse==""){
                           
                            valid = false;
                        }else if(adresse.length<10){
                          
                            valid = false;
                        }else{
                            valid = true;
                        }

                            if(pays==""){
                               
                                valid = false;
                            }else{
                                valid = true;
                            }


                            if(competence==""){
                               
                                valid = false;
                            }else{
                               valid =true;
                            }

                                    if(langue==""){
                                      
                                        valid = false;
                                    }else{
                                       valid =true;
                                    }

                                    if(projet==""){
                                       
                                        valid =false;
                                    }else if(projet.length<10){
                                       
                                        valid =false;
                                    }
                                    else{
                                        valid= true;
                                    }

                                    if(experience==""){
                                       
                                        valid = false;
                                    }else if(experience.length<10){
                                      
                                        valid =false;
                                    }
                                    else{
                                        valid = true;
                                    }

                                                

                if(valid==true){
                    
                    var donnees = $('#form_cv').serialize();
                   $.ajax({
                       type:'post',
                       url: 'Cv_',
                       data: donnees,
                       dataType:"text"
                   })
                   .done(function(data){
                        Swal.fire({
                            title:"CV envoyé",
                            icon:"success"
                        })

                        alert(data);
                       
                   }).fail(function(){
                       alert("echec");
                   })

                }
                
                if(valid== false){
                    Swal.fire({
                        title:"Echec de l'envoi",
                        text:"Veuillez revoir votre cv",
                        icon:"error"
                    })
                }

                event.preventDefault();
                event.stopPropagation();
                
    });

    $('#cv_off').on('click', function(){
        Swal.fire({
            title:"Echec",
            text: "vous devez attendre la reponse du destinataire",
            icon:"error"

        })
    });

    $('#container_candidat').hide();
        //combo de couleur
    
    setTimeout(function(){
        $('.spinner-grow').css('color', '#797E86');
    },1000);
    
    setTimeout(function(){
        $('.spinner-grow').css('color', '#8D0089');
    },2000);

    setTimeout(function(){
        $('.spinner-grow').css('color', '#C1088E');
    },3500);

    setTimeout(function(){
        $('.spinner-grow').css('color','#D65AB3').fadeOut(1300);
    },5800);

    
    
    

    setTimeout(function(){
        $('#container_candidat').fadeIn(700);
    }, 7200);

       $('#cvlist').click(function(){
        $('#row-appear-cv').slideUp("slow");

        setTimeout(function(){
            $('#mescv').slideDown();
        },900);
       });    
       
       
            $('.edit_cv').click(function(){
                var id = $(this).val();
                alert(id);
                var profession = $('#e_profession'+id).val();
                var mobile = $('#e_tel'+id).val();
                var langue = $('#e_langue'+id).val();
                var competence = $('#e_cmp'+id).val();
                var projet = $('#e_projet'+id).val();
                var experience = $('#e_experience'+id).val();
                var valid = false;

                if(profession == ""){
                    valid = false;
                }
                else if(profession.length<3){
                    valid = false;
                } else if(mobile == ""){
                    valid = false;
                }
                 else if(langue == ""){
                    valid = false;
                }
                else if(!langue.match(/[a-z]/g)){
                    valid = false;
                }else if(competence==""){
                    valid= false;
                }else if(competence.length<4){
                    valid = false;
                }else if(projet ==""){
                    valid = false;
                }else if(projet.length<20){
                    valid = false;
                }else if(experience ==""){
                    valid = false;
                }else if(experience.length<20){
                    valid = false;
                }
                else{
                    valid = true;
                }


                if(valid == true){

                    //on recupere la valeur du button cliqué
                    var id = $(this).attr('value');
                    $.ajax({
                        async:true,
                        type:'post',
                        url:'editcv',
                        dataType:"text",
                        data:{
                            "id_edit":id,
                            "profession":profession,
                            "langue":langue,
                            "tel":mobile,
                            "competence":competence,
                            "projet":projet,
                            "experience":experience
                        }
                   })
                   .done(function(data){
                    Swal.fire({
                        title:'Offre Modifié',
                        icon:"success"
                    });
                    setTimeout(function(){
                        $('#dislayoffre').load("refreshcv");
                    },3000);
                   });
                }
                
                if(valid == false){
                    Swal.fire({
                        title:'CV non modifié',
                        text:'veuillez revoir votre cv',
                        icon:'error'
                    });
                }
            });

            
              $('#search_offre').keyup(function(){
                var offre = $(this).val();
                $('#result_search').html(''); // mettre le contenu à blanc
              
                if(offre == ""){
                    $('#notification').fadeIn();
                }else{
                    $.ajax({
                        type:'post',
                        url:'search',
                        data: {
                            'offre':offre
                        },
                        success:function(data){
                            
                           if(data){
                               $('#result_search').append(data);
                               $('#notification').hide();
                           }
                        }
                    });
                
                }
                
        
            });

            $('.carousel').carousel('cycle');
});