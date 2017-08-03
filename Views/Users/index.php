<?php
$users = $_SESSION['variables'];
foreach ($users as $user) : ?>
  <div class="user">
    <ul>
      <li><?=$user[2];?></li>
      <li><?=$user[3];?></li>
      <a href="../user/adminModify?id=<?=$user[0]; ?>">Modify</a>
      <a href="../users/index">Delete</a>
      <a href="../users/index">Ban</a>
    </ul>
  </div>
<?php endforeach ?>
