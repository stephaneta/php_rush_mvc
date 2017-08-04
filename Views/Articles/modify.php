
<?php $article = $array['article']; ?>
<?php if(!empty($_SESSION['errors'])): ?>
    <ul>
<?php
    foreach ($_SESSION['errors'] as $error) : ?>
      <li><?=$error;?></li>
<?php endforeach;?>
    </ul>
<?php endif;?>


<form action="" method="post">
  <label for='title' >title: </label>
  <input type='text' name='title' id='title' value="<?=$article->getTitle();?>"/>
  <label for='content' >content: </label>
  <textarea type='content' name='content' id='content' value="" rows="8" cols="80">
    <?=$article->getContent();?>
  </textarea>
  <input type='submit' name='Submit' value='Submit'/>
</form>
