<?php

require_once('dbc.php');


Class Blog extends Dbc
{

  protected $table_name = 'main_app.blog_app';//Dbcクラスの$table_nameに'main_app.blog_app'が入りmain_app.blog_appテーブルからデータを取ってくる    違うテーブル名を入れれば違うテーブルからデータを取ってくることができる
  
    //3:カテゴリー名を表示
  // 引数　数字
  // 返り値　カテゴリーの文字列
  public function setCategoryName($category) {
    if($category === '1') {
      // もしカテゴリーの値が1なら
      return 'エブリデイ';
    } else if ($category === '2') {
      // もしカテゴリーの値が2なら
      return 'プログラミング';
    } else if ($category === '3') {
      // もしカテゴリーの値が3なら
      return 'アウトプット';
    } else if ($category === '4') {
      // もしカテゴリーの値が4なら
      return 'ファミリー';
    } else {
      // もし上記以外なら
      return 'その他';
    }
  } //setCategoryNameの閉じタグ

  public function blogCreate ($blogs) {
    $sql = "INSERT INTO 
          $this->table_name(title, content, category, publish)
        VALUES
          (:title, :content, :category, :publish)";//プレースホルダーを使って
      // 'INSERT INTO 実際のデータをINSERT INTOで入れる
      // blog_app(title,content, category, publish)ブログテーブルに入れたいデータ
      // VALUES
      // (:title, :content, :category, :publish)';実際の値をプレースホルダーで入れる

    $pdo = $this->dbConnect();

    $pdo->beginTransaction();//処理が行われる(開始)最初に必ず行う　データを入れるときはトランザクションをする

    try {//データを入れるときは必ずtry、catchをする
      $stmt = $pdo->prepare($sql);//プレースホルダーを使うときはprepare（sql）で実行
      $stmt->bindValue('title',$blogs['title'], PDO::PARAM_STR);//プレースホルダーを使いたい 引数3つ　設定した値　入れたい値　データ型
      $stmt->bindValue('content',$blogs['content'], PDO::PARAM_STR);//プレースホルダーを使いたい 引数3つ　設定した値　入れたい値　データ型
      $stmt->bindValue('category',$blogs['category'], PDO::PARAM_INT);//プレースホルダーを使いたい 引数3つ　設定した値　入れたい値　データ型
      $stmt->bindValue('publish',$blogs['publish'], PDO::PARAM_INT);//プレースホルダーを使いたい 引数3つ　設定した値　入れたい値　データ型
      $stmt->execute();
      $pdo->commit();//データベースに登録　trueなら
      // echo 'ブログを投稿しました';
    } catch(PDOException $e) {
      $pdo->rollBack();//もとに戻す　falseなら
      exit($e);
    }
  }//blogCreateの閉じタグ

  public function blogUpdate($blogs) {
    $sql = "UPDATE $this->table_name SET 
        title = :title, content = :content, category = :category, publish = :publish
    WHERE
        id = :id";
    //     "UPDATE $this->table_name SET アップデート（今の値を新規の値に）するsql文をプレースホルダーを使って
    //     title = :title, content = :content, category = :category, publish = :publish
    // WHERE
    //     id = :id";

    $pdo = $this->dbConnect();

    $pdo->beginTransaction();//処理が行われる(開始)最初に必ず行う　データを入れるときはトランザクションをする

    try {//データを入れるときは必ずtry、catchをする
    $stmt = $pdo->prepare($sql);//プレースホルダーを使うときはprepare（sql）で実行
    $stmt->bindValue(':title',$blogs['title'], PDO::PARAM_STR);//プレースホルダーを使いたい 引数3つ　設定した値　入れたい値　データ型
    $stmt->bindValue(':content',$blogs['content'], PDO::PARAM_STR);//プレースホルダーを使いたい 引数3つ　設定した値　入れたい値　データ型
    $stmt->bindValue(':category',$blogs['category'], PDO::PARAM_INT);//プレースホルダーを使いたい 引数3つ　設定した値　入れたい値　データ型
    $stmt->bindValue(':publish',$blogs['publish'], PDO::PARAM_INT);//プレースホルダーを使いたい 引数3つ　設定した値　入れたい値　データ型
    $stmt->bindValue(':id',$blogs['id'], PDO::PARAM_INT);//プレースホルダーを使いたい 引数3つ　設定した値　入れたい値　データ型
    $stmt->execute();
    $pdo->commit();//データベースに登録　trueなら
    // echo 'ブログを更新しました';
    } catch(PDOException $e) {
    $pdo->rollBack();//もとに戻す　falseなら
    exit($e);
    }


  }//blogUpdateの閉じタグ

  public function blogValidate($blogs) {//ブログのバリデーション


    if (empty($blogs['title'])) {//タイトルが空ならエラー
      exit('タイトルを入力して下さい');
    }
  
    if (mb_strlen($blogs['title']) > 191) {//mb_strlen 文字数の制限をかける
      exit('タイトルは191文字以下にして下さい');
    }
  
    if (empty($blogs['content'])) {//本文が空ならエラー
      exit('本文を入力して下さい');
    }
  
    if (empty($blogs['category'])) {//カテゴリーが空ならエラー
      exit('カテゴリーを選択して下さい');
    }
  
    if (empty($blogs['publish'])) {//公開ステータスが空ならエラー
      exit('公開ステータスを選択してください');
    }
  }//blogValidateの閉じタグ
  

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>blog</title>
</head>
<body>
  
</body>
</html>

