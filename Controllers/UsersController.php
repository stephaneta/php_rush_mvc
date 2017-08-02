<?php
//check pool_php_d09 ex_09 for registration and login with session

require 'AppController.php';

class UsersController extends AppController{

  public function __construct()
  {
    $this->loadModel('User');
    //var_dump ($this->model);
  }

  public function login()
  {

    if(isset($_POST['email']) && isset($_POST["password"]))
    {
        $user = $this->model->getUserByEmail($_POST['email']);
        if (password_verify($_POST["password"], $user->getHashedPassword()) == true)
        {
          echo 'jjjjjjjjjjjjjjjjjjjjj';
            $_SESSION['user'] = $_POST['email'];
            //$this->render('Layouts/home.php');
            return;
        }
        else
        {
          echo 'hhhhhhhhhhhhhhhhh';
          $_SESSION['errors'] = "Incorrect email/password";
        }
    }
    $this->render();
  }
  public function register()
  {
    if($_POST)
    {
      $username = $_POST["username"];
      $email = $_POST["email"];
      $password = sha1($_POST["password"]);
      $password_confirmation = sha1($_POST["password_confirmation"]);

      if($this->checkRegistrationForm($username, $email, $password, $password_confirmation))
      {
        $user = $this->model;
        $user->createUser($username, $password, $email);
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

  function checkRegistrationForm($name, $email, $password, $passwordConfirm)
  {
    $errors = [];
    $_SESSION['errors'] = '';
    //$checkError = true;
    if(!isset($name) || !isset($email) || !isset($password) || !isset($passwordConfirm))
    {
    $errors[] = "Veuillez remplir tous les champs";
    $_SESSION["errors"] = $errors;
    //$checkError = false;
    }
    else
    {
      unset($_SESSION["errors"]);
    }

    if(strlen($name)<3 || strlen($name)>10)
    {
    $errors[] = "Invalid name";
    $_SESSION["errors"] = $errors;
    //$checkError = false;
    }
    else
    {
      unset($_SESSION["errors"]);
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
  $errors[] = "Invalid email";
    $_SESSION["errors"] = $errors;
    //$checkError = false;
    }
    else
    {
      unset($_SESSION["errors"]);
    }

    if(in_array(strlen($password), range(8, 20)))
    {
    $errors[] = "Invalid password";
    $_SESSION["errors"] = $errors;
    //$checkError = false;
    }
    else
    {
      unset($_SESSION["errors"]);
    }

    if ($password != $passwordConfirm)
    {
    $errors[] = "Passwords are not identical";
    $_SESSION["errors"] = $errors;
    //$checkError = false;
    }

    else
    {
      unset($_SESSION["errors"]);
    }
    if (empty($_SESSION['errors']))
    {
      return true;
    }

  }


}

 ?>
