<?php
$users = $array['users'];
foreach ($users as $user) : ?>
  <div class="user">
    <ul>
      <li><?=$user[2];?></li>
      <li><?=$user[3];?></li>
      <a href="../users/adminModify?id=<?=$user[0]; ?>">Modify</a>
      <a href="../users/adminDelete?id=<?=$user[0]; ?>">Delete</a>
      <a href="../users/adminBan?id=<?=$user[0]; ?>">Ban</a>
    </ul>
  </div>
<?php endforeach ?>
