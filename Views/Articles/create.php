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
  <label for='title' >title: </label>
  <input type='text' name='title' id='title' />
  <label for='content' >content: </label>
  <textarea type='content' name='content' id='content'/>

  
  <input type='submit' name='Submit' value='Submit'/>
</form>
