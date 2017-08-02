<?php

include_once '../Config/db.php';

class AppController{

  protected $viewPath = __dir__ .'/Views/';

  public function loadModel($modelName)
  {
    $this->model = new $modelName(Database::getInstance());
    return $this->model;
  }

  public function render($view = null)
  {

    $this->viewPath = str_replace('/Controllers', '', $this->viewPath);

    if(preg_match( '/Layouts/', $view))
    {

      var_dump($this->viewPath.$view);
      require $this->viewPath.$view;
      return;
    }

    if ($view == null)
    {
      $function = debug_backtrace()[1]['function'];
      $class = get_called_class().'/';
      $class = str_replace('Controller', "", $class);
      require $this->viewPath.$class.$function.'.php';
      return;
    }
    else{
      $class = get_called_class().'/';
      $class = str_replace('Controller', "", $class);
      echo $class;
      echo $this->viewPath.$class.$view;
      require $this->viewPath.$class.$view;
      return;
    }

  }

  public function beforeRender()
  {

  }

  protected function redirect($param)
  {

  }

}


 ?>
