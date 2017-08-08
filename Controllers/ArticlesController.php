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
    $usersController = new UsersController();
    $userModel = $usersController->model;
    if(!isset($_SESSION['auth']))
    {
      $this->header('user/login');
      $usersController->login();
      return;
    }
    $articles = $this->model->listByDescDate();
    $articleArray = [];
    foreach ($articles as $key => $val) {
      $author = $userModel->getUserById($val['author_id']);
      $author = $author->getUsername();
      $articleArray[] = [$val['id'], $val['title'], $val['content'], $val['author_id'], $val['creation_date'], $val['edition_date'], $author];
    }

    //$this->header('home');
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

  public function viewAllOfAuthor()
  {
    $email = $_SESSION['auth'];
    $usersController = new UsersController();
    $userModel = $usersController->loadModel('user');
    $author = $userModel->getUserByEmail($email);
    $author = $author->getid();
    $articles = $this->model->getArticlesByAuthor($author);
    $articleArray = [];
    foreach ($articles as $key => $val) {
      $articleArray[] = [$val['id'], $val['title'], $val['content'], $val['author_id'], $val['creation_date'], $val['edition_date']];
    }

    $this->render('', ['articles' => $articleArray]);
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

      if($this->checkForm($title, $content))
      {
        $article = $this->model;
        $article->createArticle($title, $content, $author);
        $this->home();
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

  public function modify($id)
  {
    $article = $this->model->getArticleById($id);
    if(isset($_SESSION['errors']))
      $_SESSION['errors'] = "";
    if($_POST)
    {
      $title = $_POST["title"];
      $content = $_POST["content"];

      if($this->checkForm($title, $content))
      {
        $article = $this->model;
        $fields = ['title' => $title, 'content' => $content];
        $article->updateArticle($id, $fields);
        $this->header('../home');
        $this->home();
      }
      else{
        $this->render('', ['article' => $article]);
      }
    }
    else
    {
      $this->render('', ['article' => $article]);
    }
    //Check user is author
    // $author_id = $article->getAuthor_id();
    // $usersController = new UsersController();
    // $userModel = $usersController->loadModel('user');
    // $author = $userModel->getUserById($author_id);

  }

  public function delete($id)
  {
    $article = $this->model->getArticleById($id);
    $article->deleteArticle($id);
    $this->home();
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
