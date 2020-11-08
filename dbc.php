<?php
require_once('env.php');//これだけGitにはあげないのがありがちなパターン

// 詳細ページを表示する流れ
// 1:一覧画面からブログのidをおくる
// GETリクエストでidをURLにつけて送る

// 2:詳細ページでidを受け取る
// PHPの$_GETでidを取得

// 3:idをもとにデータベースから記事を取得
// SELECT文でプレースホルダーを使う

// 4:詳細ページに表示
// HTMLにPHPを埋め込んで表示


//関数一つに一つの機能のみを持たせる
//1:データベース接続
//2:データを取得
//3:カテゴリー名を表示

// 1 フォームから値を渡す
// 2 フォームから値を受け取る
// 3 バリデーションする
// 4 トランザクション開始
// 5 データをdbに登録する


Class Dbc//クラス内で別の関数を使うところには$this->をつける
{

  protected $table_name;


  // function __construct($table_name) {//例えば、別ページでnew Dbc('blog_app')としたときに__construct($table_name)のtable_nameのところにblog_appと言うテーブル名が入ってくる
  //   //なぜか new Dbcしたときに必ず__constructが1番初めに実行されるから　　sql実行文などに使うと汎用的なメソッドになる
  //   $this->table_name = $table_name;
  // }


//1:データベース接続
//引数　なし
//返り値　接続結果
  protected function dbConnect () {

    $host   = DB_HOST;
    $dbname = DB_NAME;
    $user   = DB_USER;
    $pass   = DB_PASS;
//  $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    //MySQLのホスト名；データベースの名前；文字コード
    // $user = 'kenta'; //phpmyadminで自分で決めたもの
    // $pass = 'Kenta1125';//phpmyadminで自分で決めたもの
    
    try { //↓に通常処理を書く、問題なければ次へ  データベースに接続
      $pdo  = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //opt,配列で指定（他のオプションもある）今回はエラーモードを例外で出力する、基本これ
        ]); 
        return $pdo;
      //↑あらかじめ決められたPHP標準で用意されているもの。
    } catch (PDOException $e) { //↓に例外（エラー）が出た時の処理。$eのなかにエラーを入れる
      echo '接続失敗'. $e->getMessage();//$e->getMessage()とすることでエラーメッセージを出力できる
      exit();
    }
    

  }//dbConnectの閉じタグ


  //2:データを取得
  // 引数　なし
  // 返り値　取得したデータ

  public function getAll () {

    $pdo = $this->dbConnect();//SQL文を実行するときにはデータベースに接続する必要があるので上で作った関数を呼び出し 接続結果が$pdoに入る

    //1:sqlの準備
    $sql = "SELECT * FROM $this->table_name";//['SELECT * FROM データベース名.テーブル名']
    //2:sqlの実行
    $stmt = $pdo->query($sql);// PDOを使ってqueryで問い合わせるイメージ
    //3:結果を受け取る
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);//PDO::FETCH_ASSOC　配列と添字取得したい

    return $result;

    $pdo = null;
  }



  //引数 $id
  //返り値 $result
  public function getById ($id) {
    if (empty($id)) {//取得したidが空の場合（empty）はexit()する
      exit('IDが不正');
    }//空じゃなければ続行
    
    
    // SQLの準備。実行
    
    $pdo = $this->dbConnect();
    
    //SQL準備　プレースホルダーを使うときは違う　$dbh->prepare()の（）内にSQL文を書く
    $stmt = $pdo->prepare("SELECT * FROM $this->table_name WHERE id = :id");//id = :id プレースホルダーを使う
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);//プレースホルダーを設定するには$stmt->bindValueを使う　3つ引数が必要
    // $stmt->bindValue('設定した値, 入れたい値, データ型');(int)$idデータ型をきちんと指定しないといけない
    //SQL実行
    $stmt->execute();
    //結果を取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);//PDO::FETCH_ASSOC　配列と添字取得したい fetch->一つ取得したいのでallは全て取得
    
    
    if (!$result) {//$resultがfalseで返ってきたら
      exit('ブログがありません');
    }//$resultがtrueなら続行

    return $result;
  }//getBlogの閉じタグ

  public function delete($id) {
    if (empty($id)) {//取得したidが空の場合（empty）はexit()する
      exit('IDが不正');
    }//空じゃなければ続行
    
    
    // SQLの準備。実行
    
    $pdo = $this->dbConnect();
    
    //SQL準備　プレースホルダーを使うときは違う　$dbh->prepare()の（）内にSQL文を書く
    $stmt = $pdo->prepare("DELETE FROM $this->table_name WHERE id = :id");//id = :id プレースホルダーを使う デリート文
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);//プレースホルダーを設定するには$stmt->bindValueを使う　3つ引数が必要
    // $stmt->bindValue('設定した値, 入れたい値, データ型');(int)$idデータ型をきちんと指定しないといけない
    //SQL実行
    $stmt->execute();//実行
    $result = $stmt;
    // echo 'ブログを削除しました';
    return $result;
  }//deleteの閉じタグ

  public function h ($str) {
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
  }//hの閉じタグ


}//Class Dbcの閉じタグ


