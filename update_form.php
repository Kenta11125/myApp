<?php

require_once('../config/blog.php');
require_once('../config/dbc.php');

ini_set('display_errors', "On");

$blog = new Blog();
$result = $blog->getById($_GET['id']);//GET受け取った🆔からブログの内容を取ってくる


$id       = $result['id'];
$title    = $result['title'];
$content  = $result['content'];
$category = (int)$result['category'];//int型にすることで既存データを判別できるようにする
$publish  = (int)$result['publish'];//int型にすることで既存データを判別できるようにする

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Blog Update</title>
</head>
<body>
  <h2 class="topTitle">Blog Update</h2>
<form action="blog_update.php" method="POST">
  <label>
    <!-- これでidを渡せる -->
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <p>Blog Title</p>
    <input name="title" type="text" value="<?= $title ?>"  class="inputText">
    <p>Blog Text</p>
    <textarea name="content" id="content" cols="30" rows="10" class="textArea"><?= $content ?></textarea>
    <p>Category</p>
    <select name="category" class="category">
      <!-- 編集ページなので、元ある情報を載せておきたい if文で今のカテゴリーのデータを判別-->
      <option value="1" <?php if($category === 1) {echo "selected";} ?>>エブリデイ</option>
      <option value="2" <?php if($category === 2) {echo "selected";} ?>>プログラミング</option>
      <option value="3" <?php if($category === 3) {echo "selected";} ?>>アウトプット</option>
      <option value="4" <?php if($category === 4) {echo "selected";} ?>>ファミリー</option>
    </select>
    <br>
    <!-- 編集ページなので、元ある情報を載せておきたい if文で今の公開データを判別-->
    <input type="radio" name="publish" value="1" <?php if($publish === 1) echo "checked"; ?>>Open
    <input type="radio" name="publish" value="2" <?php if($publish === 2) echo "checked"; ?>>No Open
    <br>
    <input type="submit" value="Blog Update" class="inputSubmit">
  </label>
</form>
<div class="backHome">
  <a href="index.php">Go Home</a>
</div>
<div>
  
</div>
</body>
</html>