<?php

require_once('../config/post.php');


$postDelete = new Post();
$result = $postDelete->postDelete($_GET['id']);


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

    <h2 class="topTitle">Delete OK</h2>
    <div class="backHome"><a href="./home.php">GO HOME</a></div>
    
</body>
</html>