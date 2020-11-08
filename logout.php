<?php
session_start();
ini_set('display_errors', "On");

require_once('../config/UserLogic.php');
$UserLogic = new UserLogic();

if(!$logout = filter_input(INPUT_POST, 'logout')){
  exit('不正なリクエスト');
}

$result = $UserLogic->checkLogin();

if(!$result) {
  exit('セッションが切れたのでログインしなおして下さい');
}

//ログアウト
$logout = $UserLogic->logout();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Logout</title>
</head>
<body>
  <h2 class="topTitle">Logout</h2>
  <div class="backHome"><a href="./login_form.php">Go Home</a></div>
</body>
</html>