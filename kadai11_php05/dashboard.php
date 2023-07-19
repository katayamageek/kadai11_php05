<?php
ini_set('display_errors', 1);

// ★ログインにまつわる関数群の読み込み
session_start(); 
require_once('funcs_login.php');
loginCheck();

//funcs.phpを読み込む
require_once('funcs.php');

//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare('SELECT * FROM php05_kadai_table;');
$status = $stmt->execute();

//３．データ表示　→viewという変数に入れる

// ■■■■以下は課題用■■■■■
$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $view .= '<div class="dataset">';
                $view .= '<div class="container">';
                    $view .= '<div class="grid">';
                        $view .= '<div class="item0">';
                            // $view .= '<input type="checkbox" class="numberCheckbox" value="' . $result['averagevisitors'] . '" onchange="calculateSum()">' . '</td>';
                        $view .= '</div>';            
                        $view .= '<div class="item1">';
                        // $view .= '<p>' . 'ここに画像が入る' . '</p>';               
                            $view .= '<img src="' . $result['image'] . '" alt="写真" class = "image">';
                        $view .= '</div class="item1">';               
                        $view .= '</>';
                        $view .= '<div class="item2">';
                            $view .= '<a href="shopprofile.php?id=' . $result['id'] . '">' . $result['shopname'] . '</a>';
                        $view .= '</div>';
                        $view .= '<div class="item3">';
                            $view .= $result['averagevisitors'];
                        $view .= '</div>';
                        $view .= '<div class="item4">';
                            $view .= $result['address'];
                        $view .= '</div>';
                        $view .= '<div class="item5">';
                            $view .= $result['station'];
                        $view .= '</div>';
                        // dashboard.phpにのみ追加↓（更新ボタン）
                        $view .= '<div class="item6">';
                            $view .= '<button><a href="detail.php?id=' . $result['id'] . '">更新</a></button>';
                        $view .= '</div>';
                        // dashboard.phpにのみ追加↓（削除ボタン）
                        $view .= '<div class="item7">';
                            $view .= '<button><a href="delete.php?id=' . $result['id'] . '">削除</a></button>';
                        $view .= '</div>';
                        // dashboard.phpにのみここにも公開・非公開ボタン
                        // $view .= '<div class="item8">';
                        //     $view .= '<form method="POST" action="update.php" enctype="multipart/form-data">';
                        //         $view .= '<label><select></label><br>';
                        //             $view .= '<option value="publish">publish</option>';
                        //             $view .= '<option value="draft">draft</option>';
                        //             $view .= '<option value="" selected hidden>'  . $result['display_status'] . '</option>';
                        //         $view .= '<label></select></label><br>';

                    // もしkanri_flgが１なら下記（フォーム）を表示する
                    // if($_SESSION['kanri_flg'] === 1){
                    if($_SESSION['roll'] === 'Administrator'){
                        $view .= '<form method="POST" action="update-display_status.php" enctype="multipart/form-data">';
                            $view .= '<label><select name="display_status"></label><br>';
                                $view .= '<option value="publish">publish</option>';
                                $view .= '<option value="draft">draft</option>';
                                $view .= '<option value="" selected hidden>' . $result['display_status'] . '</option>';
                            $view .= '<label></select></label><br>';
                            // <!-- hiddenのinputを追加する。hiddenは画面に表示されないが存在はする -->
                            $view .= '<input type="hidden" name="id" value="' . $result['id'] . '">';
                            // 更新ボタン↓
                            $view .= '<input type="submit" value="公開状態を更新">';
                        $view .= '</form>';    
                    }                           
                        $view .= '</div>';
                    $view .= '</div>';
                $view .= '</div>';
            $view .= '</div>';
        
    }
}




?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" ff="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理画面</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* div {
            padding: 10px;
            font-size: 16px;
        } */
        
    </style>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body id="main">
    <!-- Head[Start] -->
    <!-- <header> -->
        <!-- <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">データ登録</a>
                </div>
            </div>
        </nav> -->
    <!-- </header> -->
    <header class="header">
        <!-- <h1><a href="dashboard.php">管理画面</a></h1> -->
        <h1 class="header-title">管理画面（管理者用）</h1>
        <nav>
            <ul class="gnav-navi-1">
                <li><a href="index.php">追加する</a></li>
                <li><a href="select.php">プレビューを見る</a></li>
                <li><a href="logout.php">ログアウト</a></div>
</li>
            </ul>
        </nav>
    </header>


    <!-- Head[End] -->
    <!-- Main[Start] -->
    <main>

    <div class = "datasetarea"><?= $view ?></div>

    <div class = "footerback"></div>
    </main>
    <!-- Main[End] -->


    <!-- <footer class = "footer">
    <div>
    合計リーチ数：<spam id=sum></spam>
    </div>

    <div class="btn-area">
        <p>
        <span class="btn"><input type="submit" value="確認" /></span>
        </p>
    </div>


<script>
    function calculateSum() {
        var checkboxes = document.getElementsByClassName('numberCheckbox');
        var sum = 0;
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                sum += parseInt(checkboxes[i].value, 10);
            }
        }
        document.getElementById('sum').innerHTML = sum;
    }
    </script>

    </footer> -->


</body>

</html>
