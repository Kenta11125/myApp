<?php

require_once('../config/post.php');
ini_set('display_errors', "On");

$posts = $_POST;

$newPost = new Post();
$newPost->postCreate($posts);
$newPost->postValidate($posts);


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Message App</title>
</head>
<body>
    <h2 class="topTitle">Message App</h2>   
    <hr>
    <h2 class="topTitle">Message OK</h2>
    <!-- <h3 class="subTopTitle">投稿内容</h3>
    <p>name:<?php ?></p>
    <p>text:<?php ?></p> -->
    <hr>


    <div class="backHome"><a href="./home.php">GO HOME</a></div>
</body>
</html>