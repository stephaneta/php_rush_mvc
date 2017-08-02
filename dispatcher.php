<?php
require 'Src/router.php';

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
    if (array_key_exists($url, $this->routes))
    {
      $controller = $this->routes[$url]['controller'];
      $action     = $this->routes[$url]['action'];
      $ctr = new $controller();
      $ctr->$action();
    }

  }
}

 ?>
