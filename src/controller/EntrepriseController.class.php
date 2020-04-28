<?php
  session_start(); 


use libs\system\Controller;
use src\model\EntrepriseRepository;
use src\model\NotificationARepository;
use src\model\NotificationBRepository;
use src\model\OffreRepository;
use src\model\CvRepository;
use src\model\CandidatRepository;


class EntrepriseController extends Controller{
 


  public function __construct(){
    parent::__construct();
  }


  public function index(){
          $notif = new NotificationBRepository();
          $valeur1 = new EntrepriseRepository();

          $data =array('notif'=>$notif->getNot_B($_SESSION['nom']),
                       'entreprise'=> $valeur1->Entreprise($_SESSION['id'])
                      ); 
          return $this->view->load("entreprise/Acceuil.html", $data);  
  }

  public function Offre(){
    $valeur1 = new EntrepriseRepository();
    $valeur2 = new OffreRepository();
    $notif = new NotificationBRepository();
    //on obtient la ligne de l'objet courant
    $data=array(
      'notif'=> $notif->getNot_B($_SESSION['nom']),
       'entreprise'=> $valeur1->Entreprise($_SESSION['id']),
       'row'=>  $valeur2->getPoste($_SESSION['id']),
       'offres'=> $valeur2-> getAllposte($_SESSION['id'])
    );
         
      return $this->view->load("entreprise/OffreEntreprise.html",$data);   
  }

  public function CVthèque(){
    $notif = new NotificationBRepository();
    $valeur1 = new EntrepriseRepository();
    $candidat = new EntrepriseRepository();
    $data =array('notif'=>$notif->getNot_B($_SESSION['nom']),
                 'entreprise'=> $valeur1->Entreprise($_SESSION['id']),
                 'employed'=>$candidat->Employed($_SESSION['nom']),
                 'count'=> $candidat->Countemployed($_SESSION['nom'])
                ); 
      return $this->view->load("entreprise/cv_entreprise.html", $data);
  }

  public function Publication(){
    $notif = new NotificationBRepository();
    $valeur1 = new EntrepriseRepository();
    $data =array(
                  'notif'=>$notif->getNot_B($_SESSION['nom']),
                  'entreprise'=> $valeur1->Entreprise($_SESSION['id']),                
                  //On récupère les cv en fonction du destinataire 
                   'cv'=>$notif->Allcv($_SESSION['nom'])  
                ); 
     return $this->view->load("entreprise/Publication.html", $data);
  }

    //Inscription 
    public function Insert(){

        $repository = new EntrepriseRepository();
        $entreprise = new Entreprise();
    
        $valid = false;

          if(!empty($_POST)){
                
            extract($_POST);

              $nom= trim(htmlspecialchars(mb_strtoupper(ucfirst($nom))));
              $pays = trim(htmlspecialchars(ucfirst($pays)));
              $categorie = trim(htmlspecialchars($categorie));
              $secteur = trim(htmlspecialchars($secteur));
              $statut = trim(htmlspecialchars($statut));
              $taille = trim(htmlspecialchars($taille));
              $adresse = trim(htmlspecialchars($adresse));
              $photo = $photo_Candidat;

              if(!empty($nom && $pays && $categorie && $secteur && $statut && $taille && $adresse && $photo)){

                  $entreprise->setNom($nom);
                  $entreprise->setPays($pays);
                  $entreprise->setCategorie($categorie);
                  $entreprise->setSecteur($secteur);
                  $entreprise->setStatut($statut);
                  $entreprise->setTaille($taille);
                  $entreprise->setAdresse($adresse);
                  $entreprise->setImage($photo);
                  $entreprise->setDate(date("d-m-Y"));
                   $valid=true;
                }
              }

              if($valid==true){

                $rowA = $repository->testA($nom,$adresse);
                $rowB = $repository->testB($nom);
                $rowC = $repository->testC($adresse);

                if($rowA !=null){
                   
                    $data =array('erreur1'=> "Ce nom existe déjà",
                                 'erreur2'=> "Cette adresse existe déjà",
                                 'nom'=>$nom,
                                 'adresse'=>$adresse
                                );
                    return $this->view->load("templates/inscription.html", $data);
                 }else if($rowB !=null){
                        $data =array('erreur1'=> "Ce nom existe déjà",
                        'nom'=>$nom,
                         );
                     return $this->view->load("templates/inscription.html", $data);
                 }else if($rowC != null){
                        $data =array('erreur2'=> "Cette adresse existe déjà",
                        'adresse'=>$adresse
                        );
                        return $this->view->load("templates/inscription.html", $data);
                 } //on traite trois cas de figure sur la verification des 
                 
                 else{
                  $repository->add($entreprise);
                  $_SESSION['id']= $entreprise->getId(); 
                  $_SESSION['nom']= $entreprise->getNom();
                  $_SESSION['adresse'] = $entreprise->getAdresse();
                  $_SESSION['e_image'] = $entreprise->getImage();
                  return $this->index();
                }
              }
          }

          public function Connexion(){
            if(isset($_GET['Ma_session'])){
              return $this->view->load("entreprise/connexion.html");      
          }else if(isset($_GET['New_session'])){
              return $this->view->load("entreprise/newSession.html");
          }else{
              return $this->view->load("entreprise/connexion.html");
          }
        }


          public function Validation(){
            $repository = new EntrepriseRepository();
             if(!empty($_POST)){
                extract($_POST);
                
                if(isset($recruter)){
                  $repository->validate($recruter);

                  return $this->Publication();

                }else {
                  if(isset($rejeter)){
                    $repository->invalidate($rejeter);
                    return $this->Publication();
                  }  
                }
             }
          }

          public function ValidationPublique(){
            $repository = new EntrepriseRepository();
             if(!empty($_POST)){
                extract($_POST);
                
                if(isset($recruter)){
                  $repository->validatepublique($recruter,$_SESSION['nom']);
                  return $this->CVthèque();

                }else {
                  if(isset($rejeter)){
                    $repository->invalidatepublique($rejeter);
                    return $this->index();
                  }  
                }
             }
          }


          //partie Insertion Offre 


          public function Insertoffre(){
            
            $repository = new OffreRepository(); 
            $notif = new NotificationARepository();
            $valeur1 = new EntrepriseRepository();
            $notifA = new NotificationA();  
            $entreprise = $valeur1->Entreprise($_SESSION['id']);
            $offre = new Offre();
          
            $valid = false;
    
            if(!empty($_POST)){
                extract($_POST);
             
                $departement = trim(htmlentities(ucfirst($departement)));
                $contrat= trim($contrat);
                $poste = ucfirst(htmlspecialchars($poste));
            
                if(!empty($departement && $contrat && $poste && $adresse)){
                    $offre->setNom($_SESSION['nom']);         
                    $offre->setAdresse($adresse);
                    $offre->setDepartement($departement);
                    $offre->setLieu($entreprise->getPays());
                    $offre->setContrat($contrat);
                    $offre->setPoste($poste);
                    $offre->setDate(date("d/m/Y"));
                    $offre->setId_entreprise($repository->getEntreprise($_SESSION['id']));   
                    $offre->setImage($entreprise->getImage());        
                    $valid=true;
                }else{
                    print("echec");
                    $valid=false;
                }
    
                if($valid==true){
                    $repository->addOffre($offre);
            
                    //Notification
                    $notifA->setOffre_id($notif->getCv($offre->getId()));
                    $notif->addNotif($notifA);
                    //----------------------------------------
                    return $this->Offre();      
                }
    
                
    
            }
        }

        //Modifier Offre

          public function Edit_Offre(){
            $repository = new OffreRepository();

              if(!empty($_POST)){
                extract($_POST);
                if(isset($editer)){
                    $repository->editOffre($editer, $departement, $contrat, $poste);
                    $_SESSION['edit'] = $editer;
                    echo $_SESSION['edit'];
                }else{
                  echo 0;
                }
              }
          }

          public function refreshEdit(){
              $repository = new OffreRepository();

              if($_SESSION['edit']){
                $row = $repository->getOffre($_SESSION['edit']);
            
                 echo "
                
                <div class='card-body'>
                <div>
                    <div>
                        <img src='../public/image/entreprise/".$row->getImage()."' width='30'>
                        <span class='text-secondary'><strong>Vous</strong></span>
                    </div>
                    <hr class='my-2'>
                    <p class='text-secondary'><strong><ion-icon name='reader-sharp'></ion-icon>Contrat: ".$row->getContrat()."</strong></p>
                    <p class='text-secondary' style='margin-top: -12px;'><strong><ion-icon name='business-sharp'></ion-icon>".$row->getDepartement()."</strong></p>
                </div>
                   <div class='alert alert-secondary'>
                        <p class='text-secondary'>
                        <p class='text-secondary'><strong style='font-family:'Alex Brush', cursive; font-size: 25px; text-decoration: underline grey;'>Smarta <img src='../public/image/imgcool.png' width='20'></strong> message</p>
                            ".$row->getPoste()."
                        </p>
                   </div>
                   <div>
                        <h6 class='text-primary'><ion-icon name='at'></ion-icon><strong>".$row->getAdresse()."</strong></h6>
                   </div>
            </div>
            <div class='row'>
                <a class='text-secondary ml-4' style='font-size: 25px;' data-toggle='modal' data-target='#modal".$row->getId()."' data-toggle='tooltip' title='Editer'><ion-icon name='reader-outline'></ion-icon></a>
            </div>
                ";
            }
  
  
              }

              public function chartJs(){
                  $repository = new CandidatRepository();
                  echo json_encode($repository->chartCandidat());   
             }
            

             //recherche de candidats

             public function search(){
                $repository = new CvRepository();

                if(!empty($_POST['profession'])){
                      $row = $repository->search_cv($_POST['profession'],$_SESSION['nom']);

                      if($row !=null){
                        foreach($row as $result){
                          ?>
                          <div class="media m-md-1 mt-5 shadow">
                            <img src="../public/image/candidat/<?=  $result->getPhoto()?>" class="align-self-start" width="50px"  alt="">
                              <div class="media-body">
                                  <p class="text-dark ml-2" style="font-weight:bolder"><?= $result->getNom()?> <?=$result->getPrenom()?></p>
                                  <p class="text-primary h6 ml-2" style="text-decoration:underline; margin-top:-15px;"><?= $result->getAdresse()?></p>
                              </div>
                              <a class="text-secondary align-self-end mr-3" data-toggle="collapse" data-target="#link-collapse<?=$result->getId()?>"><ion-icon name="reader-sharp"></ion-icon></a>
                           </div> 
                           <div class="collapse" id="link-collapse<?=$result->getId()?>">
                              <div class="card card-body">
                                 <div class="row d-block">
                                    <p  class="text-secondary"><ion-icon name="person"></ion-icon> <?=$result->getProfession()?></p>
                                    <p class="text-secondary mt-2" style="text-decoration:underline">Contact</p>
                                    <p class="text-secondary" style="margin-top:-15px;"><ion-icon name="call-sharp"></ion-icon> <?=$result->getTel()?></p>
                                    <p class="text-secondary" style="margin-top:-15px;"><ion-icon name="at-sharp"></ion-icon> <?= $result->getAdresse()?></p>
                                    <p class="text-secondary" style="margin-top:-15px;"><ion-icon name="home-sharp"></ion-icon> <?= $result->getLieu()?></p>

                                    <div class="row justify-content-center">
                                        <?php
                                          if($result->getDestination() == $_SESSION['nom'] && $result->getAccepted()=="OUI"){
                                            ?>
                                            <p class='text-secondary font-weight-bold'>Vous avez accepté ce candidat <ion-icon name='person-add-sharp'></ion-icon></p>
                                            <?php
                                            }else{
                                              if($result->getDestination() == $_SESSION['nom'] && $result->getAccepted()=="NON"){
                                                ?>
                                                     <p class='text-secondary font-weight-bold'>Vous avez rejeté le cv de ce candidat <ion-icon name='person-remove-sharp'></ion-icon></p>
                                                <?php
                                              }
                                            }
                                        ?>
                                    </div>
                                  </div>
                              </div>
                            </div>
                              
                          <?php
                        }
                      }else{
                        ?>
                            <p class="text-secondary h4">Aucun resultat ne correspond à vos critères <ion-icon name="notifications-off-sharp"></ion-icon></p>
                            
                        <?php
                      }
                }
             }

             //lister les cv publiés 
             public function cv_public(){
                $repository = new CvRepository();
                if(!empty($_POST['profession'])){
                   $row = $repository->cv_public($_POST['profession']);

                   if($row !=null){
                     ?>
                     <div id="publication">
                       <?php
                       foreach($row as $res){
                         ?>
                            <div class="media shadow mt-4" id="media-public">
                                <img src="../public/image/candidat/<?=$res->getPhoto()?>" class="rounded align-self-start" width="50" alt="">
                                <span><a class="text-secondary ml-0" data-toggle="collapse" type="button" data-target="#collapse<?=$res->getId()?>" data-toggle="tooltip" data-placement="bottom" title="Voir l'offre" style="font-size: 30px;"><ion-icon name="reader-sharp"></ion-icon></a></span>   
                                <div class="media-body ml-0">
                                    <p class="text-muted h6"><?=$res->getNom()?> <?=$res->getPrenom()?> <ion-icon name="earth-sharp"></icon-icon></p>
                                    <p class="text-primary" style="text-decoration:underline"><?=$res->getAdresse()?></p>
                                    <div class="col-sm-12">
                                    <div class="alert alert-secondary mr-4 mb-4">
                                      <?php
                                      if($res->getAccepted()=="OUI" && $res->getDestination() == $_SESSION['id']){
                                          ?>
                                          <p class="text-secondary">Vous avez recruté ce candidat</p>
                                      <?php
                                      }else if($res->getAccepted()=="OUI" && $res->getDestination() != $_SESSION['id']){
                                        ?>
                                          <p class="text-secondary">Ce candidat a été accepté par <?=$res->getDestination() ?></p>
                                        <?php
                                      }else if($res->getAccepted()=="NON" && $res->getDestination() == $_SESSION['id']){
                                        ?>
                                            <p class="text-secondary">Vous avez rejeté ce candidat</p>
                                        <?php
                                      }else{
                                        ?>
                                            <p class="text-secondary">Ce candidat a effectué une demande d'emploi publique, veuillez verifier cette demande</p>
                                        <?php
                                      }
                                      ?>
                                    </div>
                                    </div>
                                    <div class="collapse bg-white mr-3" id="collapse<?=$res->getId()?>" style="opacity:0.9;">
                                    <div class="row justify-content-center mr-4">
                                         
                                      
                                          <div class="col-sm-6 mt-2">
                                              <div class="sections">
                                                  <p><strong>Compétences</strong></p>
                                              </div>
                                              <p><?=$res->getCompetence()?></p>
                                          </div>
                                          <div class="col-sm-6 mt-2">
                                              <div class="sections">
                                                  <p><strong>Langues</strong></p>
                                              </div>
                                              <p><?=$res->getLangages()?></p>
                                          </div>
                                    
                                     
                                          <div class="col-sm-6">
                                              <div class="sections">
                                                  <p><strong>Projets</strong></p>
                                              </div>
                                              <p><?=$res->getProjet()?></p>
                                          </div>
                                          <div class="col-sm-6">
                                              <div class="sections">
                                                  <p><strong>Experiences</strong></p>
                                              </div>
                                              <p><?=$res->getExperience()?></p>
                                          </div>
                                      </div>
                                      <div class="row justify-content-center">
                                      <?php
                                      if($res->getAccepted()=="OUI" && $res->getDestination() == $_SESSION['id']){
                                          ?>
                                          <p class="text-secondary">Vous avez recruté ce candidat <ion-icon name="person-add-sharp"></ion-icon></p>
                                      <?php
                                      }else if($res->getAccepted()=="OUI" && $res->getDestination() != $_SESSION['id']){
                                        ?>
                                          <p class="text-secondary">Ce candidat a été accepté par <?=$res->getDestination() ?></p>
                                        <?php
                                      }else if($res->getAccepted()=="NON" && $res->getDestination() == $_SESSION['id']){
                                        ?>
                                            <p class="text-secondary">Vous avez rejeté ce candidat <ion-icon name="person-remove-sharp"></ion-icon></p>
                                        <?php
                                      }else{
                                        ?>
                                            <form class="form-inline" action="ValidationPublique" method="POST">
                                                <div class="row">
                                                    <!--On récupère l'Id de Cv par le button -->
                                                    <button class="btn btn-success btn-md text-white mr-4 mb-3" type="submit" name="recruter" value="<?=$res->getId()?>">Recruter<ion-icon name="checkmark-circle"></ion-icon></button>
                                                    <button class="btn btn-danger btn-md text-white mr-3 mb-3" type="submit" name="rejeter" id="btn_rejet" value="<?=$res->getId()?>">Rejeter<ion-icon name="close-circle"></ion-icon></button>
                                                
                                                </div>
                                            </form>   
                                        <?php
                                      }
                                      ?>
                                      </div>
                                    
                                    </div>   
                                    </div>
                                    
                             </div>
                             
                        <?php
                       }
                       ?>
                        
                       <?php
                   }else{
                      ?>
                           <p class="text-secondary h4 ml-5">Aucun resultat ne correspond à vos critères <ion-icon name="notifications-off-sharp"></ion-icon></p>
                      <?php
                   }
                }
             }


             public function Deconnexion(){
               if(isset($_POST['exit'])){
                 return $this->Connexion();
               }else{
                 print("echec");
               }
             }

             // \\    // \\

             // verifier la session
             public function field_validate(){
              $repository = new EntrepriseRepository();
  
              if(isset($_POST['adresse'])){

                    if($_POST['adresse'] == $_SESSION['adresse']){
                      ?>
                      <p class="text-success">Cette adresse est valide</p>
                      <?php   
                 }else{
                     ?>
                      <p class="text-danger">Nous ne reconnaissons pas cette adresse</p>
                     <?php
                 }

              }
          }


          public function field_validate2(){
            $repository = new EntrepriseRepository();
            if(isset($_POST['adresse'])){

              if($_POST['adresse'] == $_SESSION['adresse']){
                  ?>
                    <p class="text-warning">Êtes-vous <?=$_SESSION['nom']?> ? ceci est reservé aux nouvelles sessions</p>
                  <?php 

              }else{
                    $row = $repository->Connexion($_POST['adresse']);
                    if($row !=null){
                      ?>
                      <p class="text-success">Cette adresse est valide</p>
                      <?php   
                  }else{
                      ?>
                        <p class="text-danger">Nous ne reconnaissons pas cette adresse</p>
                      <?php
                      
                  }
              }
            }
        }


          public function Connected(){
            $repository = new EntrepriseRepository();
              if(isset($_POST['connect'])){
                //pour plus de securité verifier si l'adresse correspond à l'adresse de la session session
                // puis verifier si cette adresse figure dans la base
                if($_POST['adresse'] == $_SESSION['adresse']){
                  $row = $repository->connexion2($_POST['adresse']);
                  if($row!=null){
                      $_SESSION['id'] = $row->getId();
                      $_SESSION['nom'] = $row->getNom();
                      $_SESSION['adresse'] = $row->getAdresse();
                      $_SESSION['e_image'] = $row->getImage();
                      return $this->index();
                  }else{
                    $this->Connexion();
                  }
              }else{
                $data=array(
                  'erreur'=> "<p class='text-danger'>Si cette session ne vous appartient pas inscrivez-vous.</p>",
                  'adresse'=> $_POST['adresse']
                ) ;
                return $this->view->load("entreprise/connexion.html",$data);
              }
            }else if(isset($_POST['newSession'])){ // new session
              $row= $repository->connexion2($_POST['adresse']);

              if($_POST['adresse'] == $_SESSION['adresse']){
                $data = array('erreur'=>"<p class='text-warning'>Rendez-vous sur votre session !</p>",
                              'adresse'=>$_POST['adresse']
                );      
                return $this->view->load("entreprise/newSession.html",$data); 
              }
               else if($row !=null){
                   $_SESSION['id'] = $row->getId();
                   $_SESSION['nom'] = $row->getNom();
                   $_SESSION['adresse'] = $row->getAdresse();
                   $_SESSION['e_image'] = $row->getImage();

                   if(isset($_SESSION['adresse'])){
                     return $this->index(); //palier au problème d'actualisation
                   }
                }
                else{
                    $data=array(
                        'erreur'=> "<p class='text-danger'>Si vous n'avez pas de compte veuillez vous inscrire simplement.</p>",
                        'adresse'=> $data['adresse'] = $_POST['adresse']
                      ) ;
                      return $this->view->load("entreprise/newSession.html",$data);
                }
                }else{
                    $this->Connexion(); 
                }
          }

          

   }
