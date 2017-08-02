<?php
include_once("../../Controllers/TodoList/tasksController.php");
$tasksController = new tasksController();
$tasks = $tasksController->tasks();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>tasks</title>
  </head>
  <body>
    <a href="addTask.php">Add task</a>

    <ul><?php
    foreach ($tasks as $task) :
      foreach ($task as $value) :

        ?>
        <li>
          <?php echo $value;?>

        </li>
      <?php endforeach ;?>

        <a href="updateTask.php?id=<?= $task['id'];?>">Edit task</a>
    <?php  endforeach;?>



    </ul>
  </body>
</html>
