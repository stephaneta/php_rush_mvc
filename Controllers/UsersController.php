<?php
//check pool_php_d09 ex_09 for registration and login with session

require 'AppController.php';

class UsersController extends AppController{

  public function __construct()
  {
    $this->loadModel('User');
    //var_dump ($this->model);
  }

  public function register()
  {
    if(isset($_SESSION['errors']))
      $_SESSION['errors'] = "";
    if($_POST)
    {
      $username = $_POST["username"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $password_confirmation = $_POST["password_confirmation"];

      if($this->checkRegistrationForm($username, $email, $password, $password_confirmation))
      {
        $user = $this->model;
        $password = sha1($password);
        $user->createUser($username, $password, $email);
        $_SESSION['auth'] = $user->getEmail();
        $this->render('Layouts/home.php');
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

  public function login()
  {

    if(isset($_POST['email']) && isset($_POST["password"]))
    {
        $user = $this->model->getUserByEmail($_POST['email']);
        if (sha1($_POST["password"]) == $user->getHashedPassword())
        {
            $_SESSION['auth'] = $user->getEmail();
            $this->render('Layouts/home.php');
            return;
        }
        else
        {
          echo $user->getHashedPassword();
          $_SESSION['errors'] = "Incorrect email/password";
        }
    }
    $this->render();
  }

  public function logout()
  {
    if (!isset($_SESSION['auth']))
    {
      $this->render('login.php');
      return;
    }
    $email = $_SESSION['auth'];
    $user = $this->model->getUserByEmail($email);
    echo'in';
    echo '<br>';
    unset($_SESSION['auth']);
    $this->render('Layouts/home.php');

  }

  public function modify_account(){

  }

  function checkRegistrationForm($name, $email, $password, $passwordConfirm)
  {
    $errors = [];
    $_SESSION['errors'] = '';

    if(!isset($name) || !isset($email) || !isset($password) || !isset($passwordConfirm))
    {
    $errors[] = "Veuillez remplir tous les champs";
    $_SESSION["errors"] = $errors;

    }


    if(strlen($name)<3 || strlen($name)>10)
    {
    $errors[] = "Invalid name";
    $_SESSION["errors"] = $errors;

    }


    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $errors[] = "Invalid email";
      $_SESSION["errors"] = $errors;

    }


    if(strlen($password) < 8  || strlen($password) > 20)
    {
    $errors[] = "Invalid password";
    $_SESSION["errors"] = $errors;

    }


    if ($password != $passwordConfirm)
    {
    $errors[] = "Passwords are not identical";
    $_SESSION["errors"] = $errors;

    }

    if (empty($_SESSION['errors']))
    {
      return true;
    }

  }


    public function index()
    {
      echo 'ikuhiuhj';
      if(!isset($_SESSION['auth']))
        $this->render('user/login.php');


      $user = $this->model->getUserByEmail($_SESSION['auth']);
      if($user->getGroupe() != 'admin')
      {
        echo 'non';
        $this->render('home.php');
      }


      $users = $this->model->getUsersWithLimit(10);
      $this->render();
    }


}

 ?>
