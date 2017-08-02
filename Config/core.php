<?php
include_once 'db.php';
include_once '../dispatcher.php';

$db = Database::getInstance();
$dispatcher = new Dispatcher();
$dispatcher->getAction();

 ?>
