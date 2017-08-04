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
      $this->header('user/login');
      $usersController->login();
      return;
    }
    $articles = $this->model->listByDescDate();
    $articleArray = [];
    foreach ($articles as $key => $val) {
      $articleArray[] = [$val['id'], $val['title'], $val['content'], $val['author_id'], $val['creation_date'], $val['edition_date']];
    }


    $this->render('Layouts/home.php', ["articles" => $articleArray]);
  }

  public function view($id)
  {
    $article = $this->model->getArticleById($id);
    $articleArray = [];
    $articleArray[] = [$article->getId(), $article->getTitle(), $article->getContent(), $article->getAuthor_id(), $article->getCreationDate(), $article->getEditionDate()];

    //$this->header('view');
    $this->render('', ['article' => $articleArray]);
  }

  public function create()
  {
    if(isset($_SESSION['errors']))
      $_SESSION['errors'] = "";
    if($_POST)
    {
      $title = $_POST["title"];
      $content = $_POST["content"];
      $usersController = new UsersController();
      $userModel = $usersController->loadModel('user');
      $user = $userModel->getUserByEmail($_SESSION['auth']);
      $author = $user->getId();
      var_dump($author);

      if($this->checkForm($title, $content))
      {
        $article = $this->model;
        $article->createArticle($title, $content, $author);
      }
      else{
        $this->render();
      }
    }
    else
    {
      $this->render();
    }
  }

  public function modifyArticle()
  {

  }




  public function checkForm($title, $content)
  {
    $errors = [];
    $_SESSION['errors'] = '';
    if(!isset($title) || !isset($content))
    {
    $errors[] = "Veuillez remplir tous les champs";
    $_SESSION["errors"] = $errors;
    }
    if(strlen($title) < 2)
    {
    $errors[] = "Invalid title";
    $_SESSION["errors"] = $errors;
    }
    if (empty($_SESSION['errors']))
    {
      return true;
    }
  }
}


 ?>
