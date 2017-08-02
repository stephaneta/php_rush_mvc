<?php
require 'db.php';
require '../dispatcher.php';
require 'configuration.php';
include '../Models/User.php';

$db = Database::getInstance();
$dispatcher = new Dispatcher();
$dispatcher->getAction();
// $user = new User($db);
// $user->createUser('hahaha', 'hahaha', 'haha@haha.com');
// $user->getUsers('users');



 ?>
