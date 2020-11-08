<?php

require_once('../config/post.php');
require_once('../config/UserLogic.php');

$post = new Post();





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
    <form action="post_create.php" method="POST">
        <label>
            name<br><input class="inputText" name="name" type="text" placeholder="name" >
            <p class="text">Message</p>
            <textarea class="textArea" name="text" rows="10" placeholder="Message"></textarea>
            <br>
            <input type="submit" value="GO">
        </label>
    </form>
    <div class="backHome"><a href="./home.php">GO HOME</a></div>
</body>
</html>