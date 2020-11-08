<?php
session_start();
ini_set('display_errors', "On");

require_once('../config/UserLogic.php');
$UserLogic = new UserLogic();


//エラーメッセージ
$err = [];//バリデーションに引っかかったら$err[]配列に入れるようにする


$token = filter_input(INPUT_POST, 'csrf_token');

//トークンがない、もしくは一致しないときは処理を中止
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
  exit('不正リクエスト');
}

unset($_SESSION['csrf_token']);


// バリデーション
if(!$username = filter_input(INPUT_POST, 'username')) {
  $err[] = 'ユーザ名を記入して下さい';
}
if(!$email = filter_input(INPUT_POST, 'email')) {
  $err[] = 'メールアドレスを記入して下さい';
}
$password = filter_input(INPUT_POST, 'password');//パスワードは少し違う正規表現
if(!preg_match("/\A[a-z\d]{8,100}+\z/i", $password)) { //正規表現　これの他にもある あっていたらtrueを返すので違う場合にエラーを出すので！で
  $err[] = 'パスワードは英数字8文字以上100文字以下にして下さい';
}

$password_conf = filter_input(INPUT_POST, 'password_conf');
if($password !== $password_conf) {
  $err[] = '確認用パスワードと異なっています';
}

if(count($err) === 0) {
  //ユーザを登録する処理
  $hasCreated = $UserLogic->createUser($_POST);

  if(!$hasCreated) {
    $err[] = '登録に失敗しました';
  }
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>User OK</title>
</head>
<body>
  <?php if (count($err) > 0) :?><!--エラーが０よりも大きかったら-->
    <?php foreach ($err as $e) :?><!--$errから$eに一つずつ取り出して-->
      <p><?php echo $e?></p><!--$eを表示-->
    <?php endforeach ?>
  <?php else : ?><!--それ以外なら-->
    <h2 class="topTitle">User OK</h2><!--登録完了メッセージを表示-->
  <?php endif ?>
  <div class="backHome"><a href="signup_form.php">Go Home</a></div>
  
</body>
</html>