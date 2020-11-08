<?php

ini_set('display_errors', "On");

require_once('dbc.php');

class UserLogic extends Dbc
{

  protected $table_name ='main_app.mypage_app';

  public function createUser($userData) //registerの$_POSTが$userDaraに入ってくる
  {
    $result = false;

    $sql = "INSERT INTO $this->table_name (name, email, password) VALUES (?, ?, ?)";//sql文　テーブル名　プレースホルダー

    $arr   = [];
    $arr[] = $userData['username'];//name
    $arr[] = $userData['email'];//email
    $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT);//password


    try {
      $stmt = $this->dbConnect()->prepare($sql);
      $result = $stmt->execute($arr);
      return $result;
    }catch (\Exception $e) {
      return $result;
    }
  }

  public function login($email, $password)
  {

    //結果
    $result = false;

    //ユーザをemailから検索して取得

    $user = $this->getUserByEmail($email);

    if(!$user) {
      $_SESSION['msg'] = 'Eメールが一致しません';
      return $result;
    }

    if (password_verify($password, $user['password'])) {
      //ログイン成功処理
      session_regenerate_id(true);//セッションハイジャック対策になる　古いセッション🆔を破棄して新しく作る
      $_SESSION['login_user'] = $user;
      $result = true;
      return $result; 
    }
    $_SESSION['msg'] = 'パスワードが一致しません';
    return $result;
  }

  public function getUserByEmail($email)
  {
    //SQLの実行
    //SQLの準備
    //SQLの結果を返す
    $sql = "SELECT * FROM $this->table_name WHERE email = ?";

    //emailを配列に入れる
    $arr   = [];
    $arr[] = $email;

    try {
      $stmt = $this->dbConnect()->prepare($sql);
      $stmt->execute($arr);
      $user = $stmt->fetch();
      return $user;
    }catch(\Exception $e) {
      return false;
    }
  }

  public function checkLogin() 
  {
    $result = false;
    // セッションにログインユーザが入っていなければfalse

    if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
      return $result = true;
    }

    return $result;
  }

  public static function logout() 
  {
    $_SESSION = array();
    session_destroy();
  }

 
 /**
  * CSRF対策
  * 流れ
  * トークンを作成
  * フォームからそのトークンを送信
  * 送信後の画面でそのトークンを照会
  * トークンを削除
  * 
  */
 
 function setToken() {
 
   $csrf_token = bin2hex(random_bytes(32));
 
   $_SESSION['csrf_token'] = $csrf_token;
 
   return $csrf_token;
 
 }
}









?>