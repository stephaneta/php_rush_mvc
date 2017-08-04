<?php
require '../Config/configuration.php';

class Router{

  static $routes = [
    PATH           => [
      'controller' => 'Articles',
      'action'     => 'home'
    ],
    PATH.'home'           => [
      'controller' => 'Articles',
      'action'     => 'home'
    ],
    PATH.'user/login' => [
      'controller' => 'Users',
      'action' => 'login'
    ],
    PATH.'user/register' => [
      'controller' => 'Users',
      'action' => 'register'
    ],
    PATH.'user/logout' => [
      'controller' => 'Users',
      'action' => 'logout'
    ],
    PATH.'users/index' => [
      'controller' => 'Users',
      'action'     => 'index'
    ],
    PATH.'user/modify' => [
      'controller' => 'Users',
      'action' => 'modify'
    ],
    PATH.'user/delete' => [
      'controller' => 'Users',
      'action' => 'delete'
    ],
    PATH.'users/adminModify' => [
      'controller' => 'Users',
      'action' => 'adminModify'
    ],
    PATH.'users/adminDelete' => [
      'controller' => 'Users',
      'action' => 'adminDelete'
    ],
    PATH.'user/articles/view' => [
      'controller' => 'Articles',
      'action' => 'ViewByAuthor'
    ],
    PATH.'article/view' => [
      'controller' => 'Articles',
      'action' => 'view'
    ],
    PATH.'article/create' => [
      'controller' => 'Articles',
      'action' => 'create'
    ],
    PATH.'article/modify' => [
      'controller' => 'Articles',
      'action' => 'modify'
    ],
    PATH.'article/delete' => [
      'controller' => 'Articles',
      'action' => 'delete'
    ],

  ];
}



 ?>
