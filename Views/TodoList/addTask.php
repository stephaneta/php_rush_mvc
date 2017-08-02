<?php
include_once("../../Controllers/TodoList/tasksController.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Add task</title>
  </head>
  <body>
    <form class="" action="addTask.php" method="post">
      <label for="">title</label>
      <input type="text" name="title" value="">
      <label for="">description</label>
      <input type="text" name="description" value="">
      <input type="submit" name="submitTask" value="submit">
    </form>
    <?php
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        $tasksController = new tasksController();
        $tasksController->create_task($_POST['title'], $_POST['description'])
      }

     ?>
  </body>
</html>
