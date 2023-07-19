<?php
ini_set('display_errors', 1);

//funcs.phpを読み込む
require_once('funcs.php');

//【重要】
/**
 * DB接続のための関数をfuncs.phpに用意
 * require_onceでfuncs.phpを取得
 * 関数を使えるようにする。
 */
try {
    $db_name = 'php05_kadai_db';    //データベース名
    $db_id   = 'root';      //アカウント名
    $db_pw   = '';      //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

//２．データ登録SQL作成
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
        // 公開/非公開
        if ($result['display_status'] === 'publish') { // 'display_status' は、データの表示状態を格納するカラム名を使用します
        // 
            $view .= '<div class="dataset">';
                $view .= '<div class="container">';
                    $view .= '<div class="grid">';
                        $view .= '<div class="item0">';
                            $view .= '<input type="checkbox" class="numberCheckbox" value="' . $result['averagevisitors'] . '" onchange="calculateSum()">' . '</td>';
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
                    $view .= '</div>';
                $view .= '</div>';
            $view .= '</div>';
        }
    }
}




?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" ff="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>フリーアンケート表示</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* div {
            padding: 10px;
            font-size: 16px;
        } */
        
    </style>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body id="main">
    <!-- Head[Start] -->
    <!-- <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">データ登録</a>
                </div>
            </div>
        </nav>
    </header> -->

    <header class="header">
        <!-- <h1><a href="dashboard.php">施設一覧</a></h1> -->
        <h1>受付中の施設一覧（サイト訪問者用）</a></h1>

        <nav>
            <ul class="gnav-navi-1">
                <!-- <li><a href="index.php">追加する</a></li>
                <li><a href="select.php">プレビューを見る</a></li> -->
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

    <footer class = "footer">
    <div>
    合計リーチ数：<spam id=sum></spam>
    </div>
    <!-- <div class="shinseibtn">
    <button>申請する</button>
    </div> -->
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

    </footer>


</body>

</html>
