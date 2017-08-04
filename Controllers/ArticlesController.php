<?php

include_once 'AppController.php';
include_once 'UsersController.php';

class ArticlesController extends AppController{

  public function home()
  {
    if(!isset($_SESSION['auth']))
    {
      $usersController = new UsersController();
      $usersController->login();
      return;
    }
    $this->render('Layouts/home.php');
  }


}


 ?>
