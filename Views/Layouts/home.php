<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <link rel="stylesheet" href="Webroot/Css/style.css">
</head>
<body>

  <?php include 'header.php'; ?>
  <?php $articles = $array['articles']; ?>
  <?php if($_SESSION['groupe'] == 'admin' || $_SESSION['groupe'] == 'writer') :?>
    <a href="#">Vos articles</a>
  <?php endif;?>
  <div class="articleslist">
    <?php foreach ($articles as $article): ?>
      <div class="article">

        <h3><?=$article[1];?></h3>
        <p><?=$article[2];?></p>
        <p><?=$article[3];?></p>
        <p><?=$article[4];?></p>
        <a href="article/view?id=<?=$article[0];?>">View Article</a>
        <?php if($_SESSION['groupe'] == 'admin'): ?>
          <a href="#">Edit Article</a>
          <a href="#">Delete Article</a>
        <?php endif; ?>

      </div>
    <?php endforeach; ?>
  </div>
  <div class="sideMenu">
    <a href="article/create">Create article</a>
  </div>


</body>
</html>
