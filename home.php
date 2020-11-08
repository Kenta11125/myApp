<?php   


require_once('../config/post.php');

$newPost = new Post();
$posts = $newPost->getPost();




?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Message App</title>
</head>
<body>
    <header>
        <h2 class="topTitle">Message App</h2>
    </header>
    <nav>
        <ul class="appList">
            <li>
                <div class="newCreatePost"><a href="./post_form.php">New Message</a></div>
            </li>
            <li>
                <div class="newCreatePost"><a href="../user/mypage.php">My Page</a></div>
            </li>
            <li>
                <div class="newCreatePost"><a href="../upload/upload_form.php">New File Upload</a></div>
            </li>
            <li>
                <div class="newCreatePost"><a href="../blog/index.php">New Blog</a></div>
            </li>
            <li>
                <div class="newCreatePost"><a href="../study/study.php">New Study</a></div>
            </li>
        </ul>
    </nav>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li class="postBlock">
                <p class="postName"><?php echo $newPost->h($post['name']);?><!--名前--></p>
                <div class="postDelete"><a href="post_delete.php?id=<?php echo $post['id'] ?>">DELETE</a></div>
                <p class="postTime"><?php echo $newPost->h($post['post_at']);?><!--投稿日時--></p>
                <p class="postText"><?php echo $newPost->h($post['text']);?><!--本文--></p>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="newCreatePost"><a href="./post_form.php">New Message</a></div>
</body>
</html>