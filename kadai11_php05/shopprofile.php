<?php
ini_set('display_errors', 1);

require_once('model.php');
$id = $_GET['id'];  //ここで下記それぞれの$idの内容を定義する必要がある。URLのクエリパラメータから$idを取得。
$pdo=db_connect();
$result = get_all_posts($pdo,$id);  //$resultにget_all_postsの戻り値（結果）を代入

// ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

// ★MVCのVの部分↓
require_once('templates/list.php')
?>




