<?php

session_start();
ini_set('display_errors', "On");
require_once('../config/UserLogic.php');

$UserLogic = new UserLogic();

$result = $UserLogic->checkLogin();
if($result) {
  header('Location: mypage.php');
  return;
}

$err = $_SESSION;

// セッションを消す処理
$_SESSION = array();
session_destroy();

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
  <h2 class="topTitle">Login Form</h2>
  <?php if(isset($err['msg'])) : ?>
    <p><?php echo $err['msg']; ?></p>
  <?php endif; ?>
  <form action="login.php" method="POST">
    <p>
      <label for="email">Emaik</label>
      <input type="email" name="email" class="inputText">
      <?php if(isset($err['email'])) : ?>
        <p><?php echo $err['email']; ?></p>
      <?php endif; ?>
    </p>
    <p>
      <label for="password">Password</label>
      <input type="password" name="password" class="inputPass">
      <?php if(isset($err['password'])) : ?>
        <p><?php echo $err['password']; ?></p>
      <?php endif; ?>
    </p>
    <p>
      <input type="submit" value="Login" class="inputSubmit">
    </p>
  </form>
  <div class="loginSubmit"><a href="signup_form.php">New Entry</a></div>
  
</body>
</html>


