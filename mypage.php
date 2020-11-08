<?php
session_start();
ini_set('display_errors', "On");

require_once('../config/UserLogic.php');



$UserLogic = new UserLogic();
$result = $UserLogic->checkLogin();




if(!$result) {
  $_SESSION['login_err'] = 'ユーザ登録をしてログインして下さい';
  header('Location: signup_form.php');
  return;
}

$login_user = $_SESSION['login_user'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>My Page</title>
</head>
<body>
  <h2 class="topTitle">My Page</h2>
  <p class="user">Login User<br><?php echo '->' . $UserLogic->h($login_user['name']); ?></p>
  <p class="email">Email<br><?php echo '->' .  $UserLogic->h($login_user['email']); ?></p>
  <div class="list">
    <div class="blog"><a href="../blog/index.php">New Blog</a></div>
    <div class="upload"><a href="../upload/upload_form.php">New File Upload</a></div>
    <div class="MSpost"><a href="../post/home.php">Message App</a></div>
    <div class="study"><a href="../study/study.php">study App</a></div>
  </div>
  <form action="logout.php" method="POST">
    <input type="submit" name="logout" value="Logout" class="inputSubmit"> 
  </form>
  
</body>
</html>