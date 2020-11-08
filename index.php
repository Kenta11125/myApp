<?php

require_once('../config/dbc.php');
require_once('../config/blog.php');
ini_set('display_errors', "On");


$blog = new Blog();//Dbcクラスのメソッドを使うには使いたい関数に$dbc->を頭につける↓
//継承クラスBlogからに変更　$blog = new Blog();

//取得したデータを表示している
$blogData = $blog->getAll(); //データベース接続後、SQL文実行した結果（$result）が入っている



?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Blog</title>
</head>
<body>
  <h2 class="topTitle">Blog</h2>
  <div class="list">
    <div class="newCreate"><p><a href="form.html">New Blog</a></p></div>
    <div class="mypage"><p><a href="../user/mypage.php">My Page</a></p></div>
    <div class="upload"><p><a href="../upload/upload_form.php">New File Upload</a></p></div>
    <div class="upload"><p><a href="../post/home.php">Message App</a></p></div>
  </div>
  <table>
    <tr>
      <th>Title</th><!--テーブルヘッダー -->
      <th>Category</th><!--テーブルヘッダー -->
      <th>Post</th><!--テーブルヘッダー -->
    </tr>
    <?php foreach ($blogData as $column): ?><!-- $blogDataにデータベースから取ってきたデータが入りテーブルのデータを一つずつ取り出す-->
    <tr>
      <td class="td"><?php echo $blog->h($column['title']) ?></td><!--テーブルデータ -->
      <td class="td"><?php echo $blog->h($blog->setCategoryName($column['category'])) ?></td><!--テーブルデータ -->
      <td class="td"><?php echo $blog->h($column['post_at']) ?></td><!--テーブルデータ -->
      <td class="detail"><a href="detail.php?id=<?php echo $column['id'] ?>">Detail</a></td> <!-- クエリストリング　?id=とするとphp側でidを受け取れる-->
      <td class="update"><a href="update_form.php?id=<?php echo $column['id'] ?>">Update</a></td> <!-- クエリストリング　?id=とするとphp側でidを受け取れる-->
      <td class="delete"><a href="blog_delete.php?id=<?php echo $column['id'] ?>">Delete</a></td> <!-- クエリストリング　?id=とするとphp側でidを受け取れる-->
      <!-- <td></td>
      <td></td> -->
    </tr>
    <?php endforeach; ?>
  </table>
  <div class="newCreate_under"><a href="form.html">New Blog</a></div>
</body>
</html>