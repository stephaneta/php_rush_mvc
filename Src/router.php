<?php
require '../Config/configuration.php';

class Router{

  static $routes = [
    PATH.'user/login' => [
      'controller' => 'Users',
      'action' => 'login'
    ],
    PATH.'user/register' => [
      'controller' => 'Users',
      'action' => 'register'
    ],
    PATH.'Articles' => 'displayArticles',
    PATH.'Articles' => 'displayArticles',
    PATH.'Articles' => 'displayArticles'

  ];
}



 ?>
