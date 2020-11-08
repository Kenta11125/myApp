<?php 

ini_set('display_errors', "On");

require_once('../config/env.php');
require_once('./dbc_upload.php');


$result = fileDelete($_GET['id']);



?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>New File Upload</title>
</head>
<body>
  <h2 class="topTitle">New File Upload</h2>
  <div class="backHome"><a href="upload_form.php">Go Home</a></div>
</body>
</html>