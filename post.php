<?php

require_once('../config/dbc.php');

Class Post extends Dbc
{

    protected $table_name = 'main_app.list_app';


    public function postCreate($posts) 
    {
        $sql = "INSERT INTO 
                    $this->table_name (name, text)
                VALUES
                    (:name, :text)";

        $pdo = $this->dbConnect();

        $pdo->beginTransaction();

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('name', $posts['name'], PDO::PARAM_STR);
            $stmt->bindValue('text', $posts['text'], PDO::PARAM_STR);
            $stmt->execute();
            $pdo->commit();
        }catch (PDOExeption $e) {
            $pdo->rollback();
            exit($e);
        }
    }

    public function postValidate($posts) 
    {

        if(empty($posts['name'])) {
            exit('nameに名前を入力してください');
        }

        if(empty($posts['text'])) {
            exit('textを入力してください');
        }

        if(mb_strlen($posts['text']) > 100) {
            exit('textは100文字以内で入力してください');
        }
    }

    public function getPost()
    {
        $pdo = $this->dbConnect();

        $sql = "SELECT * FROM $this->table_name";

        $stmt = $pdo->query($sql);

        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $result;
        $pdo = null;
    }


    public function postDelete($id)
    {
        if(empty($id)) {
            exit('IDが不正');
        }

        $pdo = $this->dbConnect();

        $sql = "DELETE FROM $this->table_name WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

        $result = $stmt->execute();
        return $result;
    }

}



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
    
</body>
</html>