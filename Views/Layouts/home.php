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
    <a href="user/articles/view">Vos articles</a>
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
          <a href="article/modify?id=<?=$article[0];?>">Edit Article</a>
          <a href="article/delete?id=<?=$article[0];?>">Delete Article</a>
        <?php endif; ?>

      </div>
    <?php endforeach; ?>
  </div>
  <div class="sideMenu">
    <?php if($_SESSION['groupe'] == 'admin' || $_SESSION['groupe'] == 'writer') :?>
    <a href="article/create">Create article</a>
  <?php endif; ?>
  </div>


</body>
</html>
