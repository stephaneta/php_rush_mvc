

  <?php include 'header.php'; ?>
  <?php $articles = $array['articles']; ?>

  <div class="articleslist">
    <?php foreach ($articles as $article): ?>
      <div class="article">

        <h3><?=$article[1];?></h3>
        <p><?=$article[2];?></p>
        <p><?=$article[6];?></p>
        <p><?=$article[4];?></p>
        <ul>
          <li><a href="article/view?id=<?=$article[0];?>">View Article</a></li>
          <?php if($_SESSION['groupe'] == 'admin'): ?>
            <li><a href="article/modify?id=<?=$article[0];?>">Edit Article</a></li>
            <li><a href="article/delete?id=<?=$article[0];?>">Delete Article</a></li>
          <?php endif; ?>
        </ul>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="sideMenu">
    <?php if($_SESSION['groupe'] == 'admin' || $_SESSION['groupe'] == 'writer') :?>
    <a href="article/create">Create article</a>
  <?php endif; ?>
  </div>
