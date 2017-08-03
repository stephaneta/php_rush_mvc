<?php
if(isset($_GET['id']))
{

}
 ?>

<form action='modify_account.php' method='post'>
  Name:<br>
  <input type='text' name='username' value="<?=$name; ?>"><br>
  Email:<br>
  <input type='text' name='email' value="<?=$firstEmail; ?>"><br>
  Groupe:<br>
  Password:<br>
  <input type="password" name="password" value="">
  Password Confirmation:<br>
  <input type="password" name="password_confirmation" value="">
  <select class="" name="groupe">
    <option value="user">user</option>
    <option value="writer">writer</option>
    <option value="admin">admin</option>
  </select>
  <input type='submit' value='Submit'>
</form>
