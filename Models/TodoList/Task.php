<?php

include_once "/home/changeme/Rendu/PHP_Intro_Rush_MVC/Models/Db.php";

class Task
{

  private $db;
  private $pdo;

  public function __construct()
  {
    $this->db = Database::getInstance();
    $this->pdo = $this->db->getConnection();

  }

  public function get_tasks()
  {
    $query = "SELECT * FROM tasks";
    $tmp = $this->pdo->query($query);
    $res = $tmp->fetchAll(PDO::FETCH_ASSOC);
    return $res;
  }

  public function get_task($id)
  {
    $query = "SELECT * FROM tasks WHERE id = :id";
    $tmp = $this->pdo->prepare($query);
    $tmp->bindParam(':id', $id);
    $tmp->execute();
    $res = $tmp->fetch(PDO::FETCH_ASSOC);
    return $res;
  }

  public function post_task($title, $description = null)
  {
    $query = "INSERT INTO tasks (title, description, creation_date) VALUES (:title, :description, NOW())";
    $tmp = $this->pdo->prepare($query);
    $tmp->execute(array(
      "title"=>$title, "description"=>$description
    ));

  }

  public function put_task($id, $title = null, $description = null)
  {
    if ($title == null && $description == null)
      return;
    if($title == null && $description != null)
    {
      $query = "UPDATE tasks SET description=:description, edition_date=NOW() WHERE id = $id";
      $tmp = $this->pdo->prepare($query);
      $tmp->execute(array(
        "description"=>$description
      ));
    }
    if($title != null && $description == null)
    {
      $query = "UPDATE tasks SET title=:title, edition_date=NOW() WHERE id = $id";
      $tmp = $this->pdo->prepare($query);
      $tmp->execute(array(
        "title"=>$title
      ));
    }
    if($title != null && $description != null)
    {
      $query = "UPDATE tasks SET title=:title, description=:description, edition_date=NOW() WHERE id = $id";
      $tmp = $this->pdo->prepare($query);
      $tmp->execute(array(
        "title"=>$title,
        "description"=>$description
      ));
    }

  }

  public function delete_task($id)
  {
    $query = "DELETE FROM tasks WHERE id = $id";
    $this->pdo->query($query);
  }
}





?>
