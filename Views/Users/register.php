<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register</title>
  </head>
  <body>
    <?php
      if(!empty($_SESSION['errors'])): ?>
        <ul>
    <?php
        foreach ($_SESSION['errors'] as $error) : ?>
          <li><?=$error;?></li>
    <?php endforeach;?>
        </ul>
    <?php endif;?>
    <form action="" method="post">
      <label for='username' >username: </label>
      <input type='text' name='username' id='name' minlenght='3' maxlenght='10'/>
      <label for='email' >email: </label>
      <input type='email' name='email' id='email'/>
      <label for='password' >password:</label>
      <input type='password' name='password' id='password' minlenght=8 maxlenght=20/>
      <label for='password' >password confirmation:</label>
      <input type='password' name='password_confirmation' id='password_confirmation' minlenght=8 maxlenght=20/>
      <input type='submit' name='Submit' value='Submit'/>
    </form>
    <a href="../">Login</a>

  </body>
</html>
