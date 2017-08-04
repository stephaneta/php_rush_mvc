<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="home/changeme/php_rush_mvc/Webroot/Css/style.css">
  </head>
  <body>
    <?php var_dump($_SESSION['auth']); ?>
  
    <?php var_dump($_SESSION['auth']); ?>
    <?php include 'header.php'; ?>
    <a href="user/login">login</a>
    <a href="user/logout">logout</a>
    <a href="user/register">register</a>
    <a href="user/modify">modify account</a>

  </body>
</html>
