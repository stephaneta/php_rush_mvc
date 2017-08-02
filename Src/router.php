<?php
require '../Config/configuration.php';

class Router{

  static $routes = [
    PATH.'user/login' => [
      'controller' => 'Users',
      'action' => 'login'
    ],
    PATH.'Articles' => 'displayArticles',
    PATH.'Articles' => 'displayArticles',
    PATH.'Articles' => 'displayArticles'

  ];
}



 ?>
