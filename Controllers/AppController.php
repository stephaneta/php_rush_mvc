<?php

require '../Config/db.php';

class AppController{


  public function loadModel($modelName)
  {
    $this->modelName = new $modelName(Database::getInstance());
    return $this->modelName;
  }

  public function render($view = null)
  {
    if ($view == null)
    {
      require __class__.__function__.'.html';
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
