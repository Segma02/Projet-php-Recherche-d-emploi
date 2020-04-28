// A $( document ).ready() block.
$( document ).ready(function() {

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


    
  $('#container_inscription').hide();
  $('.spinner-grow').hide();
  
    setTimeout(function(){
      $('.spinner-grow').fadeIn().css('color', '#797E86');
  },4000);
  
  setTimeout(function(){
      $('.spinner-grow').css('color', '#8D0089');
  },5000);
  
  setTimeout(function(){
      $('.spinner-grow').css('color', '#C1088E');
  },6500);
  
  setTimeout(function(){
      $('.spinner-grow').css('color','#D65AB3').fadeOut(1300);
  },8800);

  setTimeout(function(){
    $('#loader').fadeOut(2500);
  }, 9200);

  setTimeout(function(){
    $('#container_inscription').fadeIn();
  },15000);
    
 
  $('.image').hide();
  $("#MessageAcceuil").hide();
  $('.entreprise').hide();
  $('.candidat').hide();
    $("#btn-small").hide();
    $('#btn-sm').hide();




      setTimeout(function(){
          $('.image').fadeIn("slow");
                $("#MessageAcceuil").fadeIn("slow");
          setTimeout(function(){
          },60);
      }, 50);


     //mini btn entreprise
  $('#btn-small').on('click', function(){
    $(this).slideUp();
    //second btn jumbotron
    $("#candidat").animate({
        left:"250px"
    })
    .fadeOut("slow");

    setTimeout(function () {
          $("#btn")
          .css("color","grey")
          .css("border","none")
          .css("box-shadow","0px 4px 5px #aaa")
          .fadeIn();

    }, 1000);
    setTimeout(function (){
      $('.candidat').slideUp("slow");
      $('.entreprise').slideDown("slow");

    }, 1500);

    setTimeout(function() {
      $('#btn-sm').slideDown('slow');
    }, 2000);

  });

  //mini btn candidat
  $('#btn-sm').on('click', function(){
    $(this).slideUp();

    //second btn jumbotron
    $("#entreprise").animate({
        right:"250px"
    })
    .fadeOut("slow");

    setTimeout(function () {
          $('#btn1')
          .css("color","grey")
          .css("border","none")
          .css("box-shadow","0px 4px 5px #aaa")
          .fadeIn("slow");

    }, 1000);
    setTimeout(function (){
      $('.entreprise').slideUp();
      $('.candidat').slideDown();
    }, 1500);

    setTimeout(function() {
      $('#btn-small').slideDown('slow');
    }, 2000);
  });

    //SECOND BTN
  $("#btn1").on("click", function(event){
  $('.acceuil').slideUp("slow");

  var id = document.getElementById("title-header");
  id.innerHTML="Vos Informations";

      $("#btn").fadeOut("slow");
      setTimeout(function () {
          $("#btn1").css("background","none")
                    .css("color","grey")
                    .css("border","none")
                    .css("box-shadow","0px 4px 5px #aaa");
      }, 30);
        $('.candidat').fadeIn();
        setTimeout(function () {
          $("#btn-small").slideDown("slow")
            .css("font-size","25px");
},1000);

  });

  //FRIST BTN
  $("#btn").on("click", function(){
  $('.acceuil').slideUp("slow");

  var id = document.getElementById("title-header");
  id.innerHTML="Vos Informations";

      $("#btn1").fadeOut("slow");
      setTimeout(function () {
          $("#btn").css("background","none")
                    .css("color","grey")
                    .css("border","none")
                    .css("box-shadow","0px 4px 5px #aaa");
      }, 30);
        $('.entreprise').fadeIn();
        setTimeout(function () {
          $("#btn-sm").slideDown("slow")
            .css("font-size","25px");
},1000);

  });

  //validation Formulaire


  //candidat

  $('#paysB').on('change', function(){
      if($(this).val()=="Afrique du Sud"){
        $('#icon-pays').remove();
        $('#flag2').html('<img src="public/flags/south-africa.png" class="d-block mx-auto" alt="AF">')
      }

      if($(this).val()=="Angleterre"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/england.png" class="d-block mx-auto" alt="EN">');
      }

      if($(this).val()=="Allemagne"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/germany.png" class="d-block mx-auto" alt="EN">');
      }

      if($(this).val()=="Angola"){
          //3e case:
            $('#icon-pays').remove();
            $('#flag2').html('<img src="public/flags/angola.png" class="d-block mx-auto" alt="AG">');
      }
      if($(this).val()=="Benin"){
        //4e cas
        $('#icon-pays').remove();
        $('#flag2').html('<img src="public/flags/benin.png" class="d-block mx-auto" alt="BN">');
      }
      if($(this).val()=="Burkina Faso"){
        //5e cas
        $('#icon-pays').remove();
        $('#flag2').html('<img src="public/flags/burkina-faso.png" class="d-block mx-auto" alt="BF">')
      }

      if($(this).val()=="Belgique"){
        //6e cas
        $('#icon-pays').remove();
        $('#flag2').html('<img src="public/flags/belgium.png" class="d-block mx-auto" alt="BEL">');
      }

      if($(this).val()=="Cameroun"){
          //7e cas
          $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/cameroon.png" class="d-block mx-auto" alt="CN">');
      }

      if($(this).val()=="Comores"){
        //8e cas
        $('#icon-pays').remove();
        $('#flag2').html('<img src="public/flags/comoros.png" class="d-block mx-auto" alt="CRS">');
      }
      if($(this).val()=="Côte d'Ivoire"){
        //9e cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/ivory-coast.png" class="d-block mx-auto" alt="CI">');
      }
      if($(this).val()=="Chine"){
        //10e cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/china.png" class="d-block mx-auto" alt="CH">');
      }
      if($(this).val()=="Etats-Unis"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/united-states.png" class="d-block mx-auto" alt="EN">');
      }
      if($(this).val()=="Ethiopie"){
        //11e cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/ethiopia.png" class="d-block mx-auto" alt="ET">');
      }
      if($(this).val()=="Espagne"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/spain.png" class="d-block mx-auto" alt="ESP">');
      }
      if($(this).val()=="France"){
        //12e cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/france.png" class="d-block mx-auto" alt="FR">');
      }
      if($(this).val()=="Guinée"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/guinea.png" class="d-block mx-auto" alt="GU">');
      }
      if($(this).val()=="Ghana"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/ghana.png" class="d-block mx-auto" alt="GH">');
      }
      if($(this).val()=="Hollande"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/netherlands.png" class="d-block mx-auto" alt="HD">');
      }
      if($(this).val()=="Italie"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/italy.png" class="d-block mx-auto" alt="IT">');
      }

      if($(this).val()=="Kenya"){
        //13e cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/kenya.png" class="d-block mx-auto" alt="KY">');
      }
      if($(this).val()=="Liberia"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/liberia.png" class="d-block mx-auto" alt="LIB">');
      }
      if($(this).val()=="Libye"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/libya.png" class="d-block mx-auto" alt="LY">');
      }
      if($(this).val()=="Maroc"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/mOrocco.png" class="d-block mx-auto" alt="MRC">');
      }
      if($(this).val()=="Mali"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/mali.png" class="d-block mx-auto" alt="MA">');
      }
      if($(this).val()=="Mozambique"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/mozambique.png" class="d-block mx-auto" alt="MZ">');
      }
      if($(this).val()=="Madagascar"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/madagascar.png" class="d-block mx-auto" alt="MAD">');
      }
      if($(this).val()=="Nigeria"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/nigeria.png" class="d-block mx-auto" alt="NG">');
      }

      if($(this).val()=="Russie"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/russia.png" class="d-block mx-auto" alt="RS">');
      }
      if($(this).val()=="République du Congo"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/republic-of-the-congo.png" class="d-block mx-auto" alt="RC">');
      }

      if($(this).val()=="République du Sénegal"){
        //second cas
        $('#icon-pays').remove();
        $('#flag2').html('<img src="public/flags/senegal.png" class="d-block mx-auto" alt="SN">');
      }
      if($(this).val()=="République Démocratique du Congo"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/democratic-republic-of-congo.png" class="d-block mx-auto" alt="RD">');
      }

      if($(this).val()=="Republique-Centre-Afrique"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/netherlands.png" class="d-block mx-auto" alt="RCA">');
      }

      if($(this).val()=="Togo"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/togo.png" class="d-block mx-auto" alt="TG">');
      }
      if($(this).val()=="Zimbabwe"){
        //second cas
        $('#icon-pays').remove();
          $('#flag2').html('<img src="public/flags/zimbabwe.png" class="d-block mx-auto" alt="ZB">');
      }

  });

  $('#start2').on('click', function(event){



    var nom = $('#nom').val();
    var prenom = $('#prenom').val();
    var pays = $('#paysB').val();
    var adresse = $('#adresse').val();
    var photo = $('#inputimage').val();

    //|| || pays =="" || adresse ==""
    if(nom == ""){
      //nom du candidat
      $('#nom').css("border","1px solid #C21A1A");
      $('#icon-nom').css("color", "#C21A1A");
      $('#msg1').text("Le nom n'a pas été saisi, veuillez remplir ce champ");
      event.preventDefault();
      event.stopPropagation();
    }else if(nom.length<3 && nom.length<15){
      $('#nom').css("border","1px solid #C21A1A");
      $('#icon-nom').css("color", "#C21A1A");
      $('#msg1').text("Le nom n'a pas été saisi, veuillez remplir ce champ")
      event.preventDefault();
      event.stopPropagation();
    }else {
      $('#nom').css("border","1px solid #347B34");
      $('#icon-nom').css("color", "#347B34");
      $('#msg1').text("");
    }


      //prenom du candidat
      if( prenom ==""){
        $('#prenom').css("border", "1px solid #C21A1A");
        $('#icon-prenom').css("color", "#C21A1A");
        $('#msg2').text("Le prénom n'a pas été saisi, veuillez remplir ce champ");
        event.preventDefault();
        event.stopPropagation();
      }else if(prenom.length < 3 || prenom.length >20){
        $('#prenom').css("border", "1px solid #C21A1A");
        $('#icon-prenom').css("color", "#C21A1A");
        $('#msg2').text("Respectez la longeur de caractère (3-20)");
        event.preventDefault();
        event.stopPropagation();
      }else {
        $('#prenom').css("border", "1px solid #347B34");
        $('#icon-prenom').css("color", "#347B34");
        $('#msg2').text("");
      }

      //pays du candidat

      if(pays==""){
        $('#paysB').css("border", "1px solid #C21A1A");
        $('#icon-pays').css("color", "#C21A1A");
        $('#msg3').text("Le pays n'a pas été saisi, veuillez remplir ce champ")
        event.preventDefault();
        event.stopPropagation();
      }else {
          $('#paysB').css("border", "1px solid #347B34");
          $('#icon-pays').css("color", "#347B34");
          $('#msg3').text("");
      }


      //adresse du candidat

      if(adresse == ""){
        $('#adresse').css("border", "1px solid #C21A1A");
        $('#icon-ad').css("color", "#C21A1A");
        $('#msg4').text("Votre adresse est obligatoire");
        event.preventDefault();
        event.stopPropagation();
      }else if(adresse.length<6 || adresse.length>30){
        $('#adresse').css("border", "1px solid #C21A1A");
        $('#icon-ad').css("color", "#C21A1A");
          $('#msg4').text("Votre adresse est trop courte");
        event.preventDefault();
        event.stopPropagation();
      }else {
        $('#adresse').css("border", "1px solid #347B34");
        $('#icon-ad').css("color", "#347B34");
      }

      //photo de profile 
      if(photo == ""){
        $('#msg5').text("vous n'avez selectionné aucune photo");
        event.preventDefault();
        event.stopPropagation();
      }else{
          return console.log("photo selectionné");
      }

  });


  //formulaire entreprise

  $('#paysA').on('change', function(){
      if($(this).val()=="Afrique du Sud"){
        $('#icon-paysA').remove();
        $('#flag').html('<img src="public/flags/south-africa.png" class="d-block mx-auto" alt="AF">');
      }

      if($(this).val()=="Angleterre"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/england.png" class="d-block mx-auto" alt="EN">');
      }

      if($(this).val()=="Allemagne"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/germany.png" class="d-block mx-auto" alt="EN">');
      }

      if($(this).val()=="Angola"){
          //3e case:
            $('#icon-paysA').remove();
            $('#flag').html('<img src="public/flags/angola.png" class="d-block mx-auto" alt="AG">');
      }
      if($(this).val()=="Benin"){
        //4e cas
        $('#icon-paysA').remove();
        $('#flag').html('<img src="public/flags/benin.png" class="d-block mx-auto" alt="BN">');
      }
      if($(this).val()=="Burkina Faso"){
        //5e cas
        $('#icon-paysA').remove();
        $('#flag').html('<img src="public/flags/burkina-faso.png" class="d-block mx-auto" alt="BF">')
      }

      if($(this).val()=="Belgique"){
        //6e cas
        $('#icon-paysA').remove();
        $('#flag').html('<img src="public/flags/belgium.png" class="d-block mx-auto" alt="BEL">');
      }

      if($(this).val()=="Cameroun"){
          //7e cas
          $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/cameroon.png" class="d-block mx-auto" alt="CN">');
      }

      if($(this).val()=="Comores"){
        //8e cas
        $('#icon-paysA').remove();
        $('#flag').html('<img src="public/flags/comoros.png" class="d-block mx-auto" alt="CRS">');
      }
      if($(this).val()=="Côte d'Ivoire"){
        //9e cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/ivory-coast.png" class="d-block mx-auto" alt="CI">');
      }
      if($(this).val()=="Chine"){
        //10e cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/china.png" class="d-block mx-auto" alt="CH">');
      }
      if($(this).val()=="Etats-Unis"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/united-states.png" class="d-block mx-auto" alt="EN">');
      }
      if($(this).val()=="Ethiopie"){
        //11e cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/ethiopia.png" class="d-block mx-auto" alt="ET">');
      }
      if($(this).val()=="Espagne"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/spain.png" class="d-block mx-auto" alt="ESP">');
      }
      if($(this).val()=="France"){
        //12e cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/france.png" class="d-block mx-auto" alt="FR">');
      }
      if($(this).val()=="Guinée"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/guinea.png" class="d-block mx-auto" alt="GU">');
      }
      if($(this).val()=="Ghana"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/ghana.png" class="d-block mx-auto" alt="GH">');
      }
      if($(this).val()=="Hollande"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/netherlands.png" class="d-block mx-auto" alt="HD">');
      }
      if($(this).val()=="Italie"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/italy.png" class="d-block mx-auto" alt="IT">');
      }

      if($(this).val()=="Kenya"){
        //13e cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/kenya.png" class="d-block mx-auto" alt="KY">');
      }
      if($(this).val()=="Liberia"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/liberia.png" class="d-block mx-auto" alt="LIB">');
      }
      if($(this).val()=="Libye"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/libya.png" class="d-block mx-auto" alt="LY">');
      }
      if($(this).val()=="Maroc"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/mOrocco.png" class="d-block mx-auto" alt="MRC">');
      }
      if($(this).val()=="Mali"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/mali.png" class="d-block mx-auto" alt="MA">');
      }
      if($(this).val()=="Mozambique"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/mozambique.png" class="d-block mx-auto" alt="MZ">');
      }
      if($(this).val()=="Madagascar"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/madagascar.png" class="d-block mx-auto" alt="MAD">');
      }
      if($(this).val()=="Nigeria"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/nigeria.png" class="d-block mx-auto" alt="NG">');
      }

      if($(this).val()=="Russie"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/russia.png" class="d-block mx-auto" alt="RS">');
      }
      if($(this).val()=="République du Congo"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/republic-of-the-congo.png" class="d-block mx-auto" alt="RC">');
      }

      if($(this).val()=="République du Sénegal"){
        //second cas
        $('#icon-paysA').remove();
        $('#flag').html('<img src="public/flags/senegal.png" class="d-block mx-auto" alt="SN">');
      }
      if($(this).val()=="République Démocratique du Congo"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/democratic-republic-of-congo.png" class="d-block mx-auto" alt="RD">');
      }

      if($(this).val()=="Republique-Centre-Afrique"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/netherlands.png" class="d-block mx-auto" alt="RCA">');
      }

      if($(this).val()=="Togo"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/togo.png" class="d-block mx-auto" alt="TG">');
      }
      if($(this).val()=="Zimbabwe"){
        //second cas
        $('#icon-paysA').remove();
          $('#flag').html('<img src="public/flags/zimbabwe.png" class="d-block mx-auto" alt="ZB">');
      }

  });












  $('#nomE').keyup(function(){
    var nom = $(this).val();
    
    if(adr!=""){
        $.ajax({
            type:'post',
            url:'',
            data:{
                "nom":nom
            }
        }).done(function(data){
            if(data){
                $('#message1').html(data);
            }
        });
    }
});


  $('#btn-start').on('click', function(event){
      var nom = $('#nomE').val();
      var pays= $('#paysA').val();
      var adresse = $('#adresseE').val();
      var categorie = $('#select-categorie').val();
      var taille= $('#select-taille').val();
      var secteur = $('#select-secteur').val();
      var statut = $('#select-statut').val();
      var photo = $('#image').val();

      if(nom==""){
        $('#nomE').css("border", "1px solid #C21A1A");
        $('#icon-entreprise').css("color", "#C21A1A");
        $('#message1').text("Le nom n'a pas été saisi, veuillez remplir ce champ");
        event.preventDefault();
        event.stopPropagation();
      }else if(nom.length<3 || nom.length>20){
        $('#nomE').css("border", "1px solid #C21A1A");
        $('#icon-entreprise').css("color", "#C21A1A");
        $('#message1').text("Respectez la longeur de caractère (3-20)");
        event.preventDefault();
        event.stopPropagation();
      }else {
        $('#nomE').css("border", "1px solid  #347B34");
        $('#icon-entreprise').css("color", " #347B34");
        $('#message1').text("");
      }


            if(pays==""){
              $('#paysA').css("border", "1px solid #C21A1A");
              $('#icon-paysA').css("color", "#C21A1A");
              $('#message2').text("Aucun pays sélectionné");
              event.preventDefault();
              event.stopPropagation();
            }else {
              $('#paysA').css("border", "1px solid  #347B34");
              $('#icon-paysA').css("color", " #347B34");
              $('#message2').text("");
            }

          if(adresse==""){
            $('#adresseE').css("border", "1px solid #C21A1A");
            $('#icon-adresse').css("color", "#C21A1A");
            $('#message4').text("Votre adresse est obligatoire");
            event.preventDefault();
            event.stopPropagation();

          }else if(adresse.length<8 && adresse.length>30){
            $('#adresseE').css("border", "1px solid #C21A1A");
            $('#icon-adresse').css("color", "#C21A1A");
            event.preventDefault();
            event.stopPropagation();
          }else {
            $('#adresseE').css("border", "1px solid #347B34");
            $('#icon-adresse').css("color", "#347B34");
            $('#message4').text("");
          }

          if(categorie==""){
            $('#icon-cat').css("color", "#C21A1A");
            event.preventDefault();
            event.stopPropagation();
          }else{
              $('#icon-cat').css("color", "#347B34");
          }

          if(taille==""){
            $('#icon-taille').css("color", "#C21A1A");
            event.preventDefault();
            event.stopPropagation();
          }else{
            $('#icon-taille').css("color", "#347B34");
          }

          if(secteur==""){
            $('#icon-secteur').css('color', "#C21A1A");
            event.preventDefault();
            event.stopPropagation();
          }else{
            $('#icon-secteur').css('color', '#347B34');
          }

          if(statut==""){
            $('#icon-statut').css('color', '#C21A1A');
            event.preventDefault();
            event.stopPropagation();
          }else {
            $('#icon-statut').css('color', '#347B34');
          }

          if(photo == ""){
            $('#msg_img').text("vous n'avez selectionné aucune photo");
            event.preventDefault();
            event.stopPropagation();
          }else{
            $('#msg_img').remove();
              return console.log("photo selectionné");
          }

  });


  


});
