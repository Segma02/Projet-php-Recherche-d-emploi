<?php
  session_start();
 
  use libs\system\Controller;

 
  class WelcomeController extends Controller{

    public function __construct(){
      parent::__construct();
    }

    public function index(){
        return  $this->view->load("templates/inscription.html");
    }
  
  }
 ?>
