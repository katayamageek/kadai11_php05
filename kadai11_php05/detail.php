<?php
ini_set('display_errors', 1);

// ３行を貼り付ける！
session_start(); 
require_once('funcs_login.php');
loginCheck();

/**
 * [ここでやりたいこと]
 * 1. クエリパラメータの確認 = GETで取得している内容を確認する
 * 2. select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * 3. SQL部分にwhereを追加
 * 4. データ取得の箇所を修正。
 */

$id = $_GET['id'];

// 以下の間、insert.phpからコピペしてくる

//2. DB接続します
//*** function化する！  *****************
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
// $stmt = $pdo->prepare('');
$stmt = $pdo->prepare('SELECT * FROM php05_kadai_table WHERE id = :id;');

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

// vardumpでいったん確認！コンソールログ的な確認。
// var_dump($result);

?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
        <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="dashboard.php">管理画面へ戻る</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="update.php" enctype="multipart/form-data">
        <div class="jumbotron">
            <fieldset>
                <!-- <legend>フリーアンケート</legend>
                <label>名前：<input type="text" name="name" value="<?= $result['name'] ?>"></label><br>
                <label>Email：<input type="text" name="email" value="<?= $result['email'] ?>"></label><br>
                <label>年齢：<input type="text" name="age" value="<?= $result['age'] ?>"></label><br>
                <label><textarea name="content" rows="4" cols="40" value="<?= $result['content'] ?>"></textarea></label><br>  -->
                <!-- hiddenのinputを追加する。hiddenは画面に表示されないが存在はする -->
                <input type="hidden" name='id' value="<?= $result['id'] ?>">


                <label>店舗名称：<input type="text" name="shopname" value="<?= $result['shopname'] ?>"></label><br>
                <label>最寄駅：<input type="text" name="station" value="<?= $result['station'] ?>"></label><br>
                <label>所在地：<input type="text" name="address" value="<?= $result['address'] ?>"></label><br>
                <label>カテゴリ：<input type="text" name="category" value="<?= $result['category'] ?>"></label><br>
                <label>開店時刻：<input type="text" name="openingtime" value="<?= $result['openingtime'] ?>"></label><br>
                <label>閉店時刻：<input type="text" name="closingtime" value="<?= $result['closingtime']?>"></label><br>
                <label>平均来店者数/日：<input type="text" name="averagevisitors" value="<?= $result['averagevisitors'] ?>"></label><br>
                <label>スピーカー設置タイプ：<input type="text" name="devicetype" value="<?= $result['devicetype'] ?>"></label><br>
                <label>客層1：<input type="text" name="segment1" value="<?= $result['segment1'] ?>"></label><br>
                <label>客層2：<input type="text" name="segment2" value="<?= $result['segment2'] ?>"></label><br>
                <label>客層3：<input type="text" name="segment3" value="<?= $result['segment3'] ?>"></label><br>
                <label>タグ1：<input type="text" name="tag1" value="<?= $result['tag1'] ?>"></label><br>
                <label>タグ2：<input type="text" name="tag2" value="<?= $result['tag2'] ?>"></label><br>
                <label>タグ3：<input type="text" name="tag3" value="<?= $result['tag3'] ?>"></label><br>
                <label>画像アップロード：<input type="file" name="image" value=""><?= $result['image'] ?></label><br>
                <label><select name="display_status"></label><br>
                    <option value="publish">publish</option>
                    <option value="draft">draft</option>
                    <option value="" selected hidden><?=$result['display_status'] ?> </option>
                <label></select></label><br>

                <input type="submit" value="更新">
            </fieldset>
        </div>
    </form>
<!-- 画面表示時から中身を入れておくためにはvalueを使う -->
<!-- ここまでできると、編集画面ができあがる -->
</body>

</html>
