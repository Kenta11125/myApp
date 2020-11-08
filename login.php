<?php
session_start();
ini_set('display_errors', "On");

require_once('../config/UserLogic.php');

$UserLogic = new UserLogic();

// $login = $UserLogic->login();



//エラーメッセージ
$err = [];//バリデーションに引っかかったら$err[]配列に入れるようにする

// バリデーション
if(!$email = filter_input(INPUT_POST, 'email')) {
  $err['email'] = 'メールアドレスを記入して下さい';
}
if (!$password = filter_input(INPUT_POST, 'password')) {
  $err['password'] = 'パスワードを記入して下さい';
}

if(count($err) > 0) {
  //エラーがあった場合は戻す
  $_SESSION = $err;
  header('Location: login_form.php');
  return;
}

// ログイン成功時の処理
$result = $UserLogic->login($email, $password);

// ログイン失敗時の処理
if(!$result) {
  header('Location: login_form.php');
  return;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Login</title>
</head>
<body>
  <h2 class="topTitle">Login OK</h2>
  <div class="backHome"><a href="mypage.php">Go Home</a></div>
</body>
</html>