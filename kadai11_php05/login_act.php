<?php

//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値を受け取る
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];


//1.  DB接続します
require_once('funcs_login.php');
$pdo = db_conn();

//2. データ登録SQL作成
// gs_user_tableに、IDとWPがあるか確認する。
$stmt = $pdo->prepare('SELECT * FROM php05_kadai_user_table WHERE lid = :lid AND lpw = :lpw');
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status === false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
// （訳：テーブルのユーザー情報に接続fetchします）
$val = $stmt->fetch();

// （訳：fetchした結果が・・・）
//if(password_verify($lpw, $val['lpw'])){ //* PasswordがHash化の場合はこっちのIFを使う
    // もしカラじゃなければ・・・↓
if( $val['id'] != ''){
    //Login成功時 該当レコードがあればSESSIONに値を代入（この後使うから一旦入れる）
$_SESSION['chk_ssid'] = session_id();
// $_SESSION['kanri_flg'] = $val['kanri_flg'];
$_SESSION['roll'] = $val['roll'];


header('Location: dashboard.php');
}else{
    //Login失敗時(Logout経由)
    header('Location: login.php');
}

exit();
