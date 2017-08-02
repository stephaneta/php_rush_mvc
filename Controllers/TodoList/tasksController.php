<?php
include_once("../../Models/TodoList/Task.php");
class TasksController
{
  public function secure_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }

  public function tasks() {
    $task = new Task();
    $tasks = $task->get_tasks();
    foreach ($tasks as $key => $task) {
      $tasks[$key]["title"] = $this->secure_input($task["title"]);
      $tasks[$key]["description"] = nl2br($this->secure_input($task["description"]));
    }
    return $tasks;
  }

  public function task($id) {
    $task = new task();
    $row = $task->get_task($id);
    $row["title"] = $this->secure_input($row["title"]);
    $row["description"] = $this->secure_input($row["description"]);
    return $row;
  }

  public function create_task($title, $description) {
    $task = new task();
    if ($title) {
      $title = $this->secure_input($title);
      if($description) {
        $description = $this->secure_input($description);
      }

      // if($task->post_task($title, $description) == -1) {
      //   return;
      // }
      $task->post_task($title, $description);
    }
  }

  public function update_task($id, $title, $description) {
    $task = new task();
    echo $id.'haaaaaaaaaaaa';
    if (!empty($task->get_task($id))) {
      echo 'babababa';
      if ($title != null) {
        echo 'title';
        $title = $this->secure_input($title);
        if($description != null) {
          echo 'description';
          $description = $this->secure_input($description);
        }
        $task->put_task($id, $title, $description);
      }
    }
  }

  public function delete_task($id) {
    $task = new task();
    if (!empty($task->get_task($id))) {
    $task->delete_task($id);
    }
  }
}
include_once("../../Views/TodoList/tasks.php");
?>
