<?php
include_once("../../Controllers/TodoList/tasksController.php");
$tasksController = new tasksController();
$tasks = $tasksController->tasks();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>update task</title>
  </head>
  <body>
    <form class="" action="updateTask.php?id=<?= $task['id'];?>" method="post">
      <label for="">title</label>
      <input type="text" name="title" value="">
      <label for="">description</label>
      <input type="text" name="description" value="">
      <input type="submit" name="submitTask" value="submit">
    </form>
    <?php
      if($_SERVER["REQUEST_METHOD"] == "POST")
      {
        $tasksController = new tasksController();
        $tasksController->update_task($_GET['id'], $_POST['title'], $_POST['description']);
      }

     ?>
  </body>
</html>
