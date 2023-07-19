<?php

/**
 * [ここでやりたいこと]
 * 1. クエリパラメータの確認 = GETで取得している内容を確認する
 * 2. select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * 3. SQL部分にwhereを追加
 * 4. データ取得の箇所を修正。
 */

function db_connect(){

// $id = $_GET['id'];

// 以下の間、insert.phpからコピペしてくる

//2. DB接続します
//*** function化する！  *****************
try {
    $db_name = 'php05_kadai_db'; //データベース名
    $db_id   = 'root'; //アカウント名
    $db_pw   = ''; //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
return $pdo;
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}
}


function get_all_posts($pdo,$id)
{

    
//３．データ登録SQL作成　★prepare内はコピペ元から消して書き直す
// $stmt = $pdo->prepare('');
$stmt = $pdo->prepare('SELECT * FROM php05_kadai_table where id = :id;');

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //数字はINT なので注意
$status = $stmt->execute(); //実行

// 以上の間、insert.phpからコピペしてきて一部改変


// 以下新たな学び　select.phpの「//３．データ表示」からコピペしてくる

$result = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();
}

return $result; // 結果を戻り値として返す	// vardumpでいったん確認！コンソールログ的な確認。
}	

$id = $_GET['id']; // $id を取得	// var_dump($result);
$pdo = db_connect(); // DB接続	
$result = get_all_posts($pdo, $id); // 結果を取得





