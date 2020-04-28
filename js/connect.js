$(document).ready(function(){
    $('.carousel').carousel('cycle');

    //control saisie
    $('#adr-candidat').keyup(function(){
        var adr = $(this).val();
        $('#validation').html('');
        if(adr!=""){
            $.ajax({
                type:'post',
                url:'field_validate',
                data:{
                    "adresse":adr
                }
            }).done(function(data){
                if(data){
                    $('#validation').html(data);
                }
            });
        }
    });

    // new connexion
    $('#adr2-candidat').keyup(function(){
        var adr = $(this).val();
        $('#validation').html('');
        if(adr!=""){
            $.ajax({
                type:'post',
                url:'field_validate2',
                data:{
                    "adresse":adr
                }
            }).done(function(data){
                if(data){
                    $('#validation').html(data);
                }
            });
        }
    });

    //btn validation 

    $('#c_btn-start').click(function(event){
        valid = false;
        if($('#adr-candidat').val()==""){
            event.preventDefault();
            event.stopPropagation();
             valid = false;
        }else{
            valid= true;
        }
      
    });

    // btn new session
    $('#c_btn-start').click(function(event){
        valid = false;
        if($('#adr2-candidat').val()==""){
            event.preventDefault();
            event.stopPropagation();
             valid = false;
        }else if($('##c_btn-start').val() == ""){
            event.preventDefault();
            event.stopPropagation();
             valid = false;
        }else{
            valid= true;
        }
      
    });


    //partie entreprise
    $('#adr-entreprise').keyup(function(){
        var adr = $(this).val();
        $('#validation').html('');
        if(adr!=""){
            $.ajax({
                type:'post',
                url:'field_validate',
                data:{
                    "adresse":adr
                }
            }).done(function(data){
                if(data){
                    $('#validation').append(data);
                }
            });
        }
    });

    $('#adr2-entreprise').keyup(function(){
        var adr = $(this).val();
        $('#validation').html('');
        if(adr!=""){
            $.ajax({
                type:'post',
                url:'field_validate2',
                data:{
                    "adresse":adr
                }
            }).done(function(data){
                if(data){
                    $('#validation').append(data);
                }
            });
        }
    });

    $('#e_btn-start').click(function(event){
        valid = false;
        if($('#adr-entreprise').val()==""){
            
            event.preventDefault();
            event.stopPropagation();
             valid = false;
        }else if($('#adr2-entreprise').val()==""){
            event.preventDefault();
            event.stopPropagation();
            valid = false;
        }else{
            valid= true;
        }      
    });

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
});