<?php include_once '../Controllers/UsersController.php';?>
<header>
  <nav>
    <div class="container">
      <?php if(isset($_SESSION['groupe']) && $_SESSION['groupe'] == 'admin'): ?>

        <div class="adminPanel">
          <ul>
            <p>Admin panel:</p>
            <li><a href="users/index">Manage users</a></li>
            <li><a href="articles/index">Manage articles</a></li>
          </ul>
        </div>
      <?php endif; ?>
      <div class="user">
        <p>Welcome <?=$_SESSION['auth'];?></p>
        <ul>
          <?php if($_SESSION['groupe'] == 'admin' || $_SESSION['groupe'] == 'writer') :?>
            <li><a href="user/articles/view">Your articles</a></li>
            <li><a href="user/modify">Your account</a></li>
          <?php endif;?>
          <li><a href="user/logout">logout</a></li>
        </ul>
      </div>
    </div>

  </nav>
</header>
