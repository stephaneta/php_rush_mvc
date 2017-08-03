<?php

include_once 'AppController.php';

class ArticlesController extends AppController{

  public function home()
  {
    $this->render('Layouts/home.php');
  }


}


 ?>
