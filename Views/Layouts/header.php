<header>
  <nav>
    <ul>
      <li>home</li>
      <li>lnlk</li>
      <li>lnlk</li>
      <?php if(isset($_SESSION['auth'])): ?>
        <ul>
          <p>admin panel</p>
          <li><a href="../users/index">Manage users</a></li>
          <li><a href="../articles/index">Manage articles</a></li>
      </ul>
    <?php endif; ?>
    </ul>
  </nav>
</header>
