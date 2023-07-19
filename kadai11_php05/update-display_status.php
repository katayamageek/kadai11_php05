<?php
ini_set('display_errors', 1);

// ３行を貼り付ける！
session_start(); 
require_once('funcs_login.php');
loginCheck();

//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//2. $id = $_POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

//データ取得（フォームで送られてくるものはこれで受け取りましょう）
$id = $_POST['id'];
$display_status = $_POST['display_status'];

// var_dump($_POST);
// exit();
// ↑バーダンプはうまくいっている！

// detail.phpの一部をコピペしてくる

try {
    $db_name = 'php05_kadai_db'; //データベース名
    $db_id   = 'root'; //アカウント名
    $db_pw   = ''; //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}


//３．データ登録SQL作成　★prepare内はコピペ元から消して書き直す

// 【更新時→】UPDATE テーブル名　SET カラム1 = 1に保存したいもの、カラム2 = 2に保存したいもの,,,, WHERE 条件 id = 送られてきたid
$stmt = $pdo->prepare('UPDATE php05_kadai_table SET display_status = :display_status 
                                                WHERE id = :id;');
$stmt->bindValue(':display_status', $display_status, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //数字はINT なので注意
$status = $stmt->execute(); //実行


// 以上の間、insert.phpからコピペしてきて一部改変



// 以下新たな学び　select.phpの「//３．データ表示」からコピペしてくる

$result = '';
// エラーがあれば
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    // エラーがなければ遷移させる↓
    header('Location: dashboard.php');
    exit();
}

