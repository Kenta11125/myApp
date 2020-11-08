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

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);



?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Signup Form</title>
</head>
<body>
  <h2 class="topTitle">Signup Form</h2>
  <?php if(isset($login_err)) : ?>
    <p><?php echo $login_err; ?></p>
  <?php endif; ?>
  <form action="register.php" method="POST">
    <p>
      <label for="username">User</label>
      <input type="text" name="username" class="inputText">
    </p>
    <p>
      <label for="email">Email</label>
      <input type="email" name="email" class="inputEmail">
    </p>
    <p>
      <label for="password">Password</label>
      <input type="password" name="password" class="inputPass">
    </p>
    <p>
      <label for="password_conf">Password</label>
      <input type="password" name="password_conf" class="inputPass">
    </p>
    <p>
        <input type="hidden" name="csrf_token" value="<?php echo $UserLogic->h($UserLogic->setToken()); ?>">
        <input type="submit" value="New Entry" class="inputSubmit">
    </p>
  </form>

  <div class="loginSubmit"><a href="login.php">Login</a></div>
  
</body>
</html>
