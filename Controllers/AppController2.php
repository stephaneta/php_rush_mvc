<?php

include_once '../Config/db.php';

class AppController{

  protected $viewPath = __dir__ .'/Views/';

  public function loadModel($modelName)
  {
    $this->model = new $modelName(Database::getInstance());
    return $this->model;
  }

  public function render($view = null, $array = [])
  {
    echo $this->viewPath.'<br>';
    $this->viewPath = str_replace('/Controllers', '', $this->viewPath);
    ob_start();
    require $this->viewPath.'Layouts/header.php';
    $header = ob_get_clean();

    if(preg_match( '/Layouts/', $view))
    {
      var_dump($this->viewPath.$view);
      ob_start();
      require $this->viewPath.$view;
      $content = ob_get_clean();
      var_dump($content);

      return;
    }

    if ($view == null)
    {
      $function = debug_backtrace()[1]['function'];
      $class = get_called_class().'/';
      $class = str_replace('Controller', "", $class);
      ob_start();
      include_once $this->viewPath.$class.$function.'.php';
      $content = ob_get_clean();

      return;
    }
    else{
      $class = get_called_class().'/';
      $class = str_replace('Controller', "", $class);
      echo $class;
      echo $this->viewPath.$class.$view;
      ob_start();
      include_once $this->viewPath.$class.$view;
      $content = ob_get_clean();

      return;
    }

  }

  public function beforeRender()
  {

  }

  // protected function redirect($param)
  // {
  //   Dispatcher::redirect($param);
  // }


}


 ?>
