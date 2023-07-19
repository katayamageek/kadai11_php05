<?php
ini_set('display_errors', 1);

//1. POSTデータ取得
$name   = $_POST['name'];
$lid  = $_POST['lid'];
$lpw = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg']; 
$life_flg = $_POST['life_flg']; 
$roll = $_POST['roll']; 


//2. DB接続します
require_once('funcs_login.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare(
    'INSERT INTO php05_kadai_user_table(
                                        name,
                                        lid,
                                        lpw,
                                        kanri_flg,
                                        life_flg,
                                        roll
                                        )
    VALUES(
                                        :name,
                                        :lid,
                                        :lpw,
                                        :kanri_flg,
                                        :life_flg,
                                        :roll);'
                                        );

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);
$stmt->bindValue(':roll', $roll, PDO::PARAM_STR);

$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('signup_index.php');
}
