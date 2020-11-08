<?php

require_once('../config/blog.php');
require_once('../config/dbc.php');


ini_set('display_errors', "On");


$blogs = $_POST;



$blog = new Blog();
$blog->blogValidate($blogs);
$blog->blogCreate($blogs);


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Blog</title>
</head>
<body>
  <h2 class="topTitle">Blog</h2>
  <div class="backHome"><a href="index.php">Go Home</a></div>
</body>
</html>