<?php
require 'AppController.php';

class UsersController extends AppController{

  public function __construct()
  {
    $this->loadModel('User');
  }

  public function login()
  {

    require('../Views/Users/login.php');
    $this->render();
    // if(isset($_POST['email']) && isset($_POST["password"]))
    // {
    //     $user = $this->User->getUserByEmail();
    //     if (password_verify($_POST["password"], $user->getHashedPassword()) == true)
    //     {
    //         $_SESSION['user'] = $_POST['email'];
    //         header("Location: index.php");
    //         exit();
    //     }
    //     else
    //     {
    //         echo "Incorrect email/password";
    //     }
    // }
  }



}

 ?>
