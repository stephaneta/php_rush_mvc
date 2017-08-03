<?php
require 'Src/router.php';
include_once 'Models/User.php';
include_once 'Controllers/UsersController.php';
include_once 'Controllers/ArticlesController.php';

class Dispatcher{

  public function __construct()
  {
    $this->routes = Router::$routes;
  }

  public function getUrl()
  {
    return $_SERVER['REQUEST_URI'];
  }

  public function getAction()
  {
    $url = $this->getUrl();
    if (strstr($url, '?'))
    {
      $pieces = explode('?', $url);
      unset($pieces[1]);
      var_dump($pieces[0]);
      $url = $pieces[0];
    }

    if (array_key_exists($url, $this->routes))
    {
      $controller = $this->routes[$url]['controller'].'Controller';
      $action     = $this->routes[$url]['action'];
      $ctr = new $controller();
      $ctr->$action($_GET['id']);
    }
  }

  // static function redirect($param)
  // {
  //   var_dump($param);
  //   $routes = Router::$routes;
  //   $url = PATH.'Views'.$param;
  //   var_dump($url);
  //   if (array_key_exists($url, $routes))
  //   {
  //     var_dump($url);
  //     $controller = $this->routes[$url]['controller'].'Controller';
  //     $action     = $this->routes[$url]['action'];
  //     $ctr = new $controller();
  //     $ctr->$action();
  //   }
  // }
}

 ?>
