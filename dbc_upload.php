<?php
require_once('../config/env.php');
ini_set('display_errors', "On");

function dbConnect() {
  $host   = DB_HOST;
  $dbname = DB_NAME;
  $user   = DB_USER;
  $pass   = DB_PASS;
  $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";


  try {
    $pdo = new PDO($dsn, $user, $pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    return $pdo;
  } catch(PDOException $e) {
    exit($e->getMessage());
  }
}//dbConnect()の閉じタグ


/**
 * ファイルデータを保存
 * @param string $filename  ファイル名
 * @param string $save_path 保存先のパス
 * @param string $caption 投稿の説明
 * @return bool $result
 */
function fileSave($filename, $save_path, $caption) {
  $result = false;

  $sql = 'INSERT INTO main_app.file_app (file_name, file_path, description) VALUES (?, ?, ?)';


  try {
    $stmt = dbConnect()->prepare($sql);//sqlの準備
    $stmt->bindValue(1,$filename);//プレースホルダーのなかに対応する値を入れる
    $stmt->bindValue(2,$save_path);//プレースホルダーのなかに対応する値を入れる
    $stmt->bindValue(3,$caption);//プレースホルダーのなかに対応する値を入れる
    $result = $stmt->execute();//sqlの実行
    return $result;
  } catch (\Exception $e){
    echo $e->getMessage();
    return $result;
  }

}//fileSave()の閉じタグ

/**
 * ファイルデータを取得
 * @return $fileData
 * 
 */


 
 function getAllFile() {

  $sql = 'SELECT * FROM main_app.file_app';

  $fileData = dbConnect()->query($sql);

  return $fileData;
 }//getAllFile()閉じタグ


 function h($str) {
   return htmlspecialchars($str, ENT_QUOTES,"UTF-8");
 }


function fileDelete($id) {

  if(empty($id)) {//$idの値が空ならtrue空じゃなければfalse→IDがあればfalseで下の処理に行く
    exit('NO');
  }
  $pdo = dbConnect();//データベースに接続準備
  $sql = 'DELETE FROM main_app.file_app WHERE id = :id';//消すためのIDをテーブルから取得

  $stmt = $pdo->prepare($sql);//準備：プレースホルダー
  $stmt->bindValue(':id' , (int)$id , PDO::PARAM_INT);//疑問符のプレースホルダーに値をバインドする
  $result = $stmt->execute();//実行
  return $result;
}

?>

