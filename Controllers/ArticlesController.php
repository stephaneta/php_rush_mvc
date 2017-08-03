<?php

include_once 'AppController';

class Articles extends AppController{

  public function home()
  {
    $this->render('Layouts/home.php');
  }


}


 ?>
