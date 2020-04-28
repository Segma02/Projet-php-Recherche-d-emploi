<?php

use libs\system\Controller;
use src\model\CandidatRepository;
use src\model\CvRepository;
use src\model\OffreRepository;
use src\model\NotificationARepository;
use src\model\NotificationBRepository;
use src\model\FavorisRepository;

session_start();

class CandidatController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        
        $notif = new NotificationARepository();
        $rep_cd = new CandidatRepository();
        $data =array('notif'=>$notif->getNot_A(),
                     'candidat'=> $rep_cd->getCandidat($_SESSION['c_id'])
                    ); 
        if(isset($_SESSION['c_adresse'])){
        return $this->view->load("candidat/Acceuil2.html",$data);
        }else{
            return $this->Out();
        }
    }

    public function CV(){
        $notif = new NotificationARepository();
        $rep_cd = new CandidatRepository();
        $cv = new CvRepository();


        $data =array('notif'=>$notif->getNot_A(),
        'msg'=>$rep_cd->Countcv(($_SESSION['c_id'])),
        'row'=> $cv->getEachcv($_SESSION['c_id']),
        'cvrecent'=> $cv->recupere((isset($_SESSION['cv_id'])?$_SESSION['cv_id']:0)),
         'mescv'=>$cv->getMycv($_SESSION['c_id']),
        'candidat'=> $rep_cd->getCandidat($_SESSION['c_id'])
        );
      
    
        if(isset($_GET['destinataire'])){ 
            return $this->view->load("candidat/CV_candidat.html", $data);
        }else{
            return $this->view->load("candidat/CV_candidat.html",$data);
        }
    }


    public function Mesfavoris(){
        $repository = new CvRepository();
        $repfavoris = new FavorisRepository();
        $notif = new NotificationARepository();
        $rep_cd = new CandidatRepository();


        $data = array(
            'notif'=> $notif->getNot_A(), 
            'favoris'=> $repfavoris->Myfavoris($_SESSION['c_id']),
            'count'=> $repfavoris->nbFavoris($_SESSION['c_id']),
            'candidat'=> $rep_cd->getCandidat($_SESSION['c_id'])
        );

            return $this->view->load("candidat/Favoris.html", $data);
    }

    public function Publication(){
        $repository = new CvRepository();
        $rep_cd = new CandidatRepository();
        $notif = new NotificationARepository();
        $data = array('notif'=>$notif->getNot_A(),
                      'offres'=>$rep_cd->getOffre(),
                      'rowcv'=>$repository->getEachcv($_SESSION['c_id']),
                      'cv'=>$repository->getMycv($_SESSION['c_id']),
                      'candidat'=> $rep_cd->getCandidat($_SESSION['c_id'])
                    ); 


        if(isset($_GET['view'])){
            return $this->view->load("views/Mescv.html",$data);
        }

        return $this->view->load("candidat/Publication.html",$data);
    }

    public function addFavoris(){
        $repfavoris = new FavorisRepository();
        $repoffre = new OffreRepository();
        $favoris = new Favoris();
               //Add Favoris
               if(!empty($_POST['add'])){
                $line_candidat = $repfavoris->candidat($_SESSION['c_id']);
                $row = $repoffre->getOffre($_POST['add']);
                if($row !=null){
    
                    //ajout de l'offre dans les favoris
                    $favoris->setNom($row->getNom());
                    $favoris->setAdresse($row->getAdresse());
                    $favoris->setContrat($row->getContrat());
                    $favoris->setDepartement($row->getDepartement());
                    $favoris->setLieu($row->getLieu());
                    $favoris->setImage($row->getImage());
                    $favoris->setPoste($row->getPoste());
                    $favoris->setDate($row->getDate());
                    $favoris->setCandidat($line_candidat);
                    $repfavoris->add($favoris);
                }
                echo 1;
            }
    }

    public function deleteFavoris(){
        $repfavoris = new FavorisRepository();
        $favoris = new Favoris();
       
        if(isset($_POST['idF'])){
            $repfavoris->delete($_POST['idF']);
            $row = $repfavoris->nbFavoris($_SESSION['c_id']);

            echo 1;
        }
    }

    public function Insert(){
        $repository = new CandidatRepository();
        $candidat = new Candidat();
        $valid = false;
        if(!empty($_POST)){

          extract($_POST);

          $nom = trim(htmlentities(ucfirst($nom)));
          $prenom = trim(htmlspecialchars(ucfirst($prenom)));
          $pays = trim(htmlspecialchars($pays));
          $photo = $photo_Candidat;

          if(!empty($nom && $prenom && $pays && $adresse && $photo)){
              $candidat->setNom($nom);
              $candidat->setPrenom($prenom);
              $candidat->setPays($pays);
              $candidat->setAdresse($adresse);
              $candidat->setImage($photo);
              $candidat->setDateCompte(date("d-m-Y"));
              $valid = true;
          }

          if($valid == true){
            $rowA = $repository->testA($nom, $prenom, $adresse);
            $rowB = $repository->testB($nom);
            $rowC = $repository->testC($prenom);
            $rowD = $repository->testD($adresse);


            if($rowA !=null){
                   
                $data =array('erreur1'=> "Ce nom existe déjà",
                             'erreur2'=> "Ce prenom existe déjà",
                             'erreur3'=> "Cette adresse existe déjà",
                             'nom'=>$nom,
                             'prenom'=>$prenom,
                             'adresse'=>$adresse
                            );
                return $this->view->load("templates/inscription.html", $data);
             }else if($rowB !=null){
                    $data =array('erreur1'=> "Ce nom existe déjà",
                    'nom'=>$nom,
                     );
                 return $this->view->load("templates/inscription.html", $data);
             }else if($rowC != null){
                    $data =array('erreur2'=> "Ce prénom existe déjà",
                    'prenom'=>$prenom
                    );
                    return $this->view->load("templates/inscription.html", $data);
             }else if($rowD != null){
                $data =array('erreur3'=> "Ce prénom existe déjà",
                'adresse'=>$adresse
                );
                return $this->view->load("templates/inscription.html", $data);
             } 
              //on traite trois cas de figure sur la verification des 


              else{
                $_SESSION['c_id']=$repository->addCandidat($candidat);
                $_SESSION['c_nom']=$candidat->getNom();
                $_SESSION['prenom']= $candidat->getPrenom();
                $_SESSION['c_adresse']= $candidat->getAdresse();
                $_SESSION['image'] = $candidat->getImage();
                $_SESSION['cv_id'] = null;
                $repository->addCandidat($candidat);
                return $this->index();
              }
          }
        }
       
    }

    public function Connexion(){
        if(isset($_GET['Ma_session'])){
            return $this->view->load("candidat/connexion.html");      
        }else if(isset($_GET['New_session'])){
            return $this->view->load("candidat/newSession.html");
        }else{
            return $this->view->load("candidat/connexion.html");
        }
    }

  

    public function Cv_(){
        $repository = new CvRepository();
        $rep_cd = new CandidatRepository();
        //notification repository
        $notif = new NotificationBRepository();
        $notifB = new NotificationB();
        $cv = new Cv();
        $candidat = $rep_cd->getCandidat($_SESSION['c_id']);
        $global= "Public";
        $valid = false;

        if(!empty($_POST)){
            extract($_POST);



            $competence1= ucfirst(trim(htmlspecialchars($competence1)));
            $competence2= ucfirst(trim(htmlspecialchars($competence2))); // au cas où
            $competence3= ucfirst(trim(htmlspecialchars($competence3))); // au cas où

            $competences = $competence1."  ".$competence2."  ".$competence3;

            $langue1= ucfirst(trim(htmlspecialchars($langue1)));  
            $langue2= ucfirst(trim(htmlspecialchars($langue2))); // au cas où
            $langue3= ucfirst(trim(htmlspecialchars($langue3))); // au cas où

            $langues = $langue1."  ".$langue2."  ".$langue3;

            $projet1 = ucfirst(trim(htmlspecialchars($projet1)));
           

            $projets = $projet1;

            $exp1 = ucfirst(trim(htmlspecialchars($exp1)));

            $experiences = $exp1;

            //on verifie si il y a une ligne qui possède le nom correspendant
            if(!empty($destinataire)){
                if(!empty($profession && $mobile && $adresse && $lieu && $competences && $langues && $projets && $experiences)){
                            $cv->setCandidat($repository->getCandidat($_SESSION['c_id']));
                            $cv->setNom($_SESSION['c_nom']);
                            $cv->setPrenom($_SESSION['prenom']);
                            $cv->setProfession($profession);
                            $cv->setPhoto($candidat->getImage());
                            $cv->setAdresse($candidat->getAdresse());
                            $cv->setLieu($candidat->getPays());
                            $cv->setTel($mobile);
                            $cv->setCompetence($competences);
                            $cv->setExperience($experiences);
                            $cv->setLangages($langues);
                            $cv->setProjet($projets);
                            $cv->setDestination($destinataire);
                            $cv->setDate(date("d-m-Y"));

                            $cv->setAccepted("-");
                            $cv->setDateval(0);

                            $valid =true;

                            if($valid == true){    
                             $_SESSION['cv_id']=$repository->addCv($cv);
                             //partie notification
            
                             //On récupère l'Id de l'Emetteur
                            $notifB->setCvid($notif->getCv($cv->getId()));
                            //On récupère le Nom du destinataire 
                            $notifB->setDestination($destinataire);
                            $notif->add($notifB);
                           
                              echo $notif->add($notifB);
                            }else {
                              echo 0;
                            }
            
                 }                      
                           
            }else{
                if(!empty($profession && $mobile && $adresse && $lieu && $competences && $langues && $projets && $experiences)){
                
                                $cv->setCandidat($repository->getCandidat($_SESSION['c_id']));
                                $cv->setNom($_SESSION['c_nom']);
                                $cv->setPrenom($_SESSION['prenom']);
                                $cv->setProfession($profession);
                                $cv->setPhoto($candidat->getImage());
                                $cv->setAdresse($candidat->getAdresse());
                                $cv->setLieu($candidat->getPays());
                                $cv->setTel($mobile);
                                $cv->setCompetence($competences);
                                $cv->setExperience($experiences);
                                $cv->setLangages($langues);
                                $cv->setProjet($projets);
                                $cv->setDestination($global);
                                $cv->setDate(date("d-m-Y"));
                                $cv->setAccepted("-");
                                $cv->setDateval(0);
                                
                                $valid = true;

                              
                   }

                   if($valid == true){
                   $_session['cv_id']= $repository->addCv($cv);
                    
                    //partie notification

                    //On récupère l'Id de l'Emetteur
                    $notifB->setCvid($notif->getCv($cv->getId()));

                    //on desactive l'envoie du cv

                    //On récupère le Nom du destinataire 
                    $notifB->setDestination($global);
                    $notif->addNotif($notifB);
                        //---------------------------------------
                        echo 1;
                    }else{
                    echo 0;
                    }
                               
                }
            }
        }


        public function editcv(){
            $repository = new CvRepository();
            if(!empty($_POST)){
                extract($_POST);
                if(isset($id_edit)){
                    $_SESSION['id_cv']= $repository->editCv($id_edit, $profession, $langue, $mobile, $competence, $projet, $experience);
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }



        public function search(){
            $repository = new OffreRepository();
        
               if(!empty($_POST['offre'])){
                   $row = $repository->search_offre($_POST['offre']);
                
                    if($row != null){
                        foreach($row as $result){
                            ?>

                           <div class="media mt-3 m-md-4 pr-3 shadow"> 
                              <img src="../public/image/Entreprise/<?=$result->getImage()?>"  class="align-self-start ml-3 mt-3" width="50px" alt="">
                              <div class="media-body"> 
                                        <div class="row ml-2">
                                                <div class="col-sm-12">           
                                                    <span class="text-dark ml-2" style="font-weight: bold;"><?=$result->getNom()?>  
                                                    </span><br>
                                                    <span class="text-primary"  style="text-decoration: underline #5B24FF;"><?=$result->getAdresse()?></span>  
                                                        <p class="text-secondary"><?=$result->getNom()?> a publié une offre d'emploi êtes vous intéressé ?</p>
                                                </div>
                                        </div> 
                                    <div class="row ml-2">
                                            <div class="col-md-12">
                                                <p class="text-secondary"><ion-icon name="calendar-sharp"></ion-icon> publié le <?=$result->getDate()?></p>
                                                <span><a class="text-secondary ml-0" data-toggle="modal" type="button" data-target="#modal<?=$result->getId()?>" data-toggle="tooltip" data-placement="bottom" title="Voir l'offre" style="font-size: 30px;"><ion-icon name="eye-sharp"></ion-icon></a></span>   
                                            </div>
                                    </div> 
                               </div>
                            </div>

                        <div class="modal fade" id="modal<?=$result->getId()?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content" style="background-color: #F5F5F5;">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    <img src="../public/image/Entreprise/<?=$result->getImage()?>" width="50px">
                                    <span><?=$result->getNom()?></span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row ml-2">
                                        <div class="col-md-12">
                                            <span  class="text-secondary" style="font-family:calibri; font-size:30px;">Respensable de <?=$result->getDepartement()?></span>
                                        </div>
                                    </div>
                                    <div class="row justify-content-start ml-2">
                                        <div class="col-sm-0">
                                            <span class="text-secondary"><ion-icon name="location"></ion-icon><?=$result->getlieu()?></span>
                                        </div>
                                        <div class="col-sm-0 ml-1">
                                            <span class="text-secondary"><ion-icon name="reader-outline"></ion-icon> <?=$result->getContrat()?></span>
                                        </div>
                                    </div>
                                    <p class="text-secondary ml-2 mt-5" style="font-size:25px;" id="poste">Poste</p>
                                    <div class="form-row justify-content-start ml-2">
                                        <div class="col-md-10">
                                        <p class="text-secondary">
                                            <?=$result->getPoste()?>
                                        </p>
                                        </div>
                                    </div>
                                    <p class="text-info"><ion-icon name="at"></ion-icon><?=$result->getAdresse()?></p>
                                </div>
                            </div>
                            </div>
                        </div>
                            <?php 
                            }
                    }else{
                        ?>
                            <p class="text-secondary ml-4 h4">Aucun resultat ne correspond à vos critères <ion-icon name="notifications-off-sharp"></ion-icon></p>
                        <?php
                    }
            
                }
        }


        public function Deconnexion(){
            if(!empty($_POST['exit'])){
                //si je detruis la session ici ca affectera la session Entreprise
                return $this->Connexion();
            }
        }

        public function field_validate(){
            if(isset($_POST['adresse'])){
               
                  if($_POST['adresse'] == $_SESSION['c_adresse']){
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
            $repository = new CandidatRepository();
            if(isset($_POST['adresse'])){
                if($_POST['adresse'] == $_SESSION['c_adresse']){
                    ?>
                      <p class="text-warning">Êtes-vous <?=$_SESSION['c_nom']?> <?=$_SESSION['prenom'] ?> ? ceci est reservé aux nouvelles sessions</p>
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
            $repository = new CandidatRepository();
          
              if(isset($_POST['connect'])){ // session actuelle
                //pour plus de securité verifier si l'adresse correspond à l'adresse de la session session
                // puis verifier si cette adresse figure dans la base
                if($_POST['adresse'] == $_SESSION['c_adresse']){
                    $row =$repository->connexion2($_POST['adresse']);
                  if($row!=null){
                      $_SESSION['c_id'] = $row->getId();
                      $_SESSION['c_nom'] = $row->getNom();
                      $_SESSION['c_adresse'] = $row->getAdresse();
                      $_SESSION['image'] = $row->getImage();
                      return $this->index();
                  }
              }else{
                $data=array(
                    
                  'erreur'=> "<p class='text-danger'>Si cette session ne vous appartient pas, connectez-vous à un autre compte ou inscrivez-vous simplement.</p>",
                  'adresse'=> $_POST['adresse']
                ) ;
                return $this->view->load("candidat/connexion.html",$data);
              }
            }
               else if(isset($_POST['newSession'])){ // new session
                   $row= $repository->connexion2($_POST['adresse']);
                  if($_SESSION['c_adresse'] == $_POST['adresse']){
                    $data = array('erreur'=>"<p class='text-warning'>Rendez-vous sur votre session !</p>",
                    'adresse'=>$_POST['adresse']
                    );      
                    return $this->view->load("candidat/newSession.html",$data); 
                  }
                   else if($row!=null){
                        $_SESSION['id'] = $row->getId();
                        $_SESSION['c_nom'] = $row->getNom();
                        $_SESSION['c_adresse'] = $row->getAdresse();
                        $_SESSION['image'] = $row->getImage();

                        if(isset($_SESSION['c_adresse'])){
                            return $this->index(); //palier au problème d'actualisation
                        }

                    }else{
                        $data=array(
                            'erreur'=> "<p class='text-danger'>Si vous n'avez pas de compte, veuillez vous inscrire simplement.</p>",
                            'adresse'=> $data['adresse'] = $_POST['adresse']
                          ) ;
                          return $this->view->load("candidat/newSession.html",$data);
                    }
                }else{
                    $this->Connexion(); 
                }
             
          }
          
}
