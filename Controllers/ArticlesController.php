<?php
include_once '../Models/Article.php';
include_once 'UsersController.php';

class ArticlesController extends AppController{

  public function __construct()
  {
    $this->loadModel('Article');
  }

  public function home()
  {
    if(!isset($_SESSION['auth']))
    {
      $usersController = new UsersController();
      $usersController->login();
      return;
    }
    $articles = $this->model->listByDescDate();
    $articleArray = [];
    foreach ($articles as $key => $val) {
      $articleArray[] = [$val['id'], $val['title'], $val['content'], $val['author'], $val['creation_date'], $val['edition_date']];
    }

    $this->render('Layouts/home.php', ["articles" => $articleArray]);
  }


}


 ?>
