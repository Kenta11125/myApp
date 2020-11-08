<?php

require_once('./dbc_upload.php');


$files = getAllFile();




?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>New File Upload</title>
</head>
<!-- <style>

  textarea {
    width: 98%;
    height: 60px;
  }
  .file_up {
    margin-bottom: 10px;
  }
  .submit {
    text-align: right;
  }
  .btn {
    display: inline-block;
    border-radius: 3px;
    font-size: 18px;
    background-color: #67c5ff;
    border: 2px solid #67c5ff;
    padding: 5px 10px;
    color: #fff;
    cursor: pointer;
  }
</style> -->
<body>
  <!-- マイページへ -->
  <h2 class="topTitle">New File Upload</h2>
  <div class="list">
    <div class="mypage"><a href="../user/mypage.php">My Page</a></div>
    <div class="blog"><a href="../blog/index.php">New Blog</a></div>
    <div class="blog"><a href="../post/home.php">Message App</a></div>
  </div>
  <form enctype="multipart/form-data" action="./file_upload.php" method="POST"><!-- enctype="multipart/form-data" 複数のデータを送れる-->
    <div>
      <textarea name="caption" placeholder="キャプション（140文字以下）" id="caption" class="textArea" rows="10"></textarea>
    </div>
    <br>
    <div class="file_up">
      <input type="hidden" name="MAX_FILE_SIZE" value="1048576"><!-- ファイルのマックスサイズをHIDDENで記載　１MB -->
      <input name="img" type="file" accept="image/*" class="file">
    </div>
    <!-- nameの値でPHP側で取得する -->
    <div class="submit">
      <input type="submit" value="GO" class="btn inputSubmit">
    </div>
    <br>
    <hr>
  </form>
  <?php foreach ($files as $file) : ?>
    <div class="listPic">
      <p><?php echo h($file['description']) ;?></p>
      <img src="<?php echo $file['file_path'];?>" alt="">
      <div class="fileDelete"><a href="file_delete.php?id=<?php echo $file['id']; ?>">DELETE</a></div>
    </div>
    <hr>
  <?php endforeach ?>
</body>
</html>