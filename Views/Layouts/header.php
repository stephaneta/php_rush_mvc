<?php include_once '../Controllers/UsersController.php';?>
<header>
  <nav>
    <div class="">


    <ul>
      <li>home</li>
      <li>lnlk</li>
      <li>lnlk</li>
      <?php if(isset($_SESSION['groupe']) && $_SESSION['groupe'] == 'admin'): ?>
        <p><?=$_SESSION['auth'];?></p>

          <p>admin panel</p>
          <li><a href="users/index">Manage users</a></li>
          <li><a href="articles/index">Manage articles</a></li>

    <?php endif; ?>
    </ul>
    </div>
    <div class="user">
      <ul>
        <li><a href="user/logout">logout</a></li>
        <li><a href="user/modify">modify account</a></li>
      </ul>
    </div>

  </nav>
</header>
