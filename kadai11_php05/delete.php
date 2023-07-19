<?php
ini_set('display_errors', 1);

// ３行を貼り付ける！
session_start(); 
require_once('funcs_login.php');
loginCheck();

// 削除デリートはutlで送られてくるので、getで受け取ること
//データ取得（フォームで送られてくるものはこれで受け取りましょう）
$id = $_GET['id'];

// ■■■■■以下はupdete.phpからコピペ■■■■

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

// // ■■■■■ここはupdate.phpからコピペ後に編集する■■■■
// UPDATE テーブル名　SET カラム1 = 1に保存したいもの、カラム2 = 2に保存したいもの,,,, WHERE 条件 id = 送られてきたid
$stmt = $pdo->prepare('DELETE FROM php05_kadai_table WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //数字はINT なので注意

$status = $stmt->execute(); //実行

// 以上の間、insert.phpからコピペしてきて一部改変



// 以下新たな学び　select.phpの「//３．データ表示」からコピペしてくる


// エラーがあれば
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    // エラーがなければ遷移させる↓
    header('Location: dashboard.php');
    exit();
}

