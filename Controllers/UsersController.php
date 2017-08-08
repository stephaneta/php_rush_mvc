<?php

require 'AppController.php';

class UsersController extends AppController{

  public function __construct()
  {
    $this->loadModel('User');
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

      if($this->checkForm($username, $email, $password, $password_confirmation))
      {
        $user = $this->model;
        $password = sha1($password);
        $user->createUser($username, $password, $email);
        $this->login();
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
    if(isset($_SESSION['auth']))
    {
      $this->render('Layouts/home.php');
      return;
    }

    if(isset($_POST['email']) && isset($_POST["password"]))
    {
        $user = $this->model->getUserByEmail($_POST['email']);
        if (sha1($_POST["password"]) == $user->getHashedPassword())
        {
            $_SESSION['auth'] = $user->getEmail();
            $_SESSION['groupe'] = $user->getGroupe();
            $this->header('../home');
            $this->render('Layouts/home.php');
            return;
        }
        else
        {
          $_SESSION['errors'] = "Incorrect email/password";
        }
    }
    $this->render();
  }

  public function logout()
  {
    if (!isset($_SESSION['auth']))
    {
      $this->login();
      return;
    }
    $email = $_SESSION['auth'];
    $user = $this->model->getUserByEmail($email);
    unset($_SESSION['auth']);
    unset($_SESSION['groupe']);
    $this->header('login');
    $this->render('login.php');
    return;

  }

  public function modify()
  {
    $email = $_SESSION['auth'];

    $user = $this->model->getUserByEmail($email);

    if(isset($_SESSION['errors']))
      $_SESSION['errors'] = "";
    if($_POST)
    {
      $username = $_POST["username"];
      $email = $_POST["email"];
      $password = $_POST['password'];
      $passwordConfirmation = $_POST['password_confirmation'];

      if($this->checkForm($username, $email, $password, $passwordConfirmation))
      {
        $password = sha1($password);
        $fields = ['username' => $username, 'email' => $email, 'hashedPassword' => $password];
        $user->updateUser($user->getId(), $fields);
        $this->header('../home');
        $this->render('Layouts/home.php');
      }
      else{
        $this->render('',['user' => $user]);
      }
    }
    else
    {
      $this->render('',['user' => $user]);
    }
  }

  public function delete($id)
  {
    $user = $this->model->getUserById($id);
    unset($_SESSION['auth']);
    unset($_SESSION['groupe']);
    $user->deleteUser($id);
    $this->register();
  }

  public function adminModify($id)
  {
    if(!isset($_SESSION['auth']))
      $this->render('user/login.php');

      $user = $this->model->getUserById($id);
      if($user->getGroupe() == 'admin')
      {
        $error[] = "Vous ne pouvez pas supprimer un administrateur";
        $_SESSION['errors'] = $error;
        $this->index();
        return;
      }
    $user = $this->model->getUserById($id);
    if(isset($_SESSION['errors']))
      $_SESSION['errors'] = "";
    if($_POST)
    {
      $username = $_POST["username"];
      $email = $_POST["email"];
      $groupe = $_POST["groupe"];
      $password = $_POST['password'];
      $passwordConfirmation = $_POST['password_confirmation'];

      if($this->checkForm($username, $email, $password, $passwordConfirmation))
      {
        $password = sha1($password);
        $fields = ['username' => $username, 'email' => $email, 'groupe' =>  $groupe, 'hashedPassword' => $password];
        $user->updateUser($id, $fields);

        $this->index();
      }
      else{
        $this->render('',['user' => $user]);
      }
    }
    else
    {
      $this->render('',['user' => $user]);
    }
  }

  public function adminDelete($id)
  {
    if(isset($_SESSION['errors']))
      unset($_SESSION['errors']);
    $user = $this->model->getUserById($id);
    if($user->getGroupe() == 'admin')
    {
      $error[] = "Vous ne pouvez pas supprimer un administrateur";
      $_SESSION['errors'] = $error;
      $this->index();
      return;
    }
    $user->deleteUser($id);
    $this->index();
  }

  public function checkForm($name, $email, $password, $passwordConfirm)
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
      if(!isset($_SESSION['auth']))
        $this->render('user/login.php');

      $user = $this->model->getUserByEmail($_SESSION['auth']);
      if($user->getGroupe() != 'admin')
      {
        $this->header('../');
        $this->render('Layouts/home.php');
        return;
      }
      $users = $this->model->getUsersWithLimit(10);

      $usersArray = [];
      foreach ($users as  $user) {

        $usersArray[] = [$user['id'], $user['hashedPassword'], $user['username'], $user['email'], $user['groupe'], $user['status']];
      }

      $this->render('', ['users' => $usersArray]);
      if(isset($_SESSION['errors']))
        unset($_SESSION['errors']);
      return;
    }

}

 ?>
