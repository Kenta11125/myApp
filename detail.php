<?php

require_once('../config/blog.php');
require_once('../config/dbc.php');

$blog = new Blog();

ini_set('display_errors', "On");



$result = $blog->getById($_GET['id']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Blog Detail</title>
</head>
<body>
  <h2 class="topTitle">Blog Detail</h2>
  <h3>Title:<?php echo $blog->h($result['title']) ?></h3><!--SQLで取ってきた結果（$result）の中のtitle-->
  <p>Post:<?php echo $blog->h($result['post_at']) ?></p><!--SQLで取ってきた結果（$result）の中のpost_at-->
  <p>Category:<?php echo $blog->h($blog->setCategoryName($result['category'])) ?></p><!--SQLで取ってきた結果（$result）の中のcategory  $dbc->のなかのsetCategoryNameを使ってね-->
  <br>
  <hr>
  <p>Text:<?php echo $result['content'] ?></p><!--SQLで取ってきた結果（$result）の中のconent-->
  <hr>
  <br>
  <div class="backHome"><a href="index.php">Go Home</a></div>
</body>
</html>