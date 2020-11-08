<?php

require_once('./dbc_upload.php');


// ファイル関連の取得
$file = $_FILES['img'];
$filename = basename($file['name']);//fileの中のnameの値
$tmp_path = $file['tmp_name'];//fileの中のtmp_nameの値
$file_err = $file['error'];//fileの中のerrorの値
$filesize = $file['size'];//fileの中のsizeの値
// できるだけ変数にしておくと良い　初めに宣言しておく

// 絶対パス
$upload_dir = 'images/';

// ファイルネームの変更
$save_filename = date('Y-m-d.H:i:s') . $filename;

$err_msgs = array();

$save_path = $upload_dir.$save_filename;

// キャプションの取得
$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);
// サニタイズはセキュリティ的にやっておいた方が良いこと

// キャプションのバリデーション
// 未入力
if(empty($caption)) {//キャプションが空なら
  array_push($err_msgs, 'キャプションを入力してください<br>');
}

// 140文字以下か
if (strlen($caption) > 140) {//strlen()は文字数の取得をしてくれる
  array_push($err_msgs, 'キャプションは140文字以内で入力してください<br>');
}

// ファイルのバリデーション
// ファイルサイズが１MB未満か
if($filesize > 1048576 || $file_err == 2) {
  array_push($err_msgs,'ファイルサイズは１MB未満にしてください<br>');
}

// 拡張子は画像形式か

$allow_ext = array('jpg', 'jpeg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array(strtolower($file_ext), $allow_ext)) {
  array_push($err_msgs,'画像ファイルを添付してください<br>');
}


if(count($err_msgs) === 0 ) {
  // ファイルはあるかどうか
  
  if(is_uploaded_file($tmp_path)) {
    if(move_uploaded_file($tmp_path, $save_path)) {
      echo $filename . 'を' . $upload_dir . 'にアップしました<br>';
      // DBに保存(ファイル名、ファイルパス、キャプション)を引数にしてdbc_uploadに保存
      $result = fileSave($filename, $save_path, $caption);
      if($result) {
        echo 'データベースに保存しました';
      } else {
        echo 'データベースへの保存が失敗しました';
      }
    } else {
      echo 'ファイルが保存できませんでした<br>';
    }
  } else {
    echo 'ファイルが選択されていません<br>';
  }
} else {
  foreach ($err_msgs as $msg) {
    echo $msg;
    // echo '<br>';
  }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">

  <title>完了</title>
</head>
<body>
  <div class="backHome"><a href="./upload_form.php">戻る</a></div>
</body>
</html>