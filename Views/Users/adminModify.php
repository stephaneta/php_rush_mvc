
<?php $user = $array['user'];?>
<?php if(!empty($_SESSION['errors'])): ?>
  <ul>
    <?php foreach ($_SESSION['errors'] as $error) : ?>
      <li><?=$error;?></li>

<?php endforeach;?>
  </ul>
 <?php endif; ?>

<form action="" method='post'>
  Name:<br>
  <input type='text' name='username' value="<?=$user->getUsername(); ?>"><br>
  Email:<br>
  <input type='text' name='email' value="<?=$user->getEmail(); ?>"><br>
  Password:<br>
  <input type="password" name="password" value=""><br>
  Password Confirmation:<br>
  <input type="password" name="password_confirmation" value=""><br>
  Groupe:<br>
  <select class="" name="groupe">
    <option value="user">user</option>
    <option value="writer">writer</option>
    <option value="admin">admin</option>
  </select>
  <input type='submit' value='Submit'>
</form>

<a href="../users/index">Return</a>
