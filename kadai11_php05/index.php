<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>施設登録</title>
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
                <div class="navbar-header"><a class="navbar-brand" href="dashboard.php">施設一覧へ戻る</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="insert.php" enctype="multipart/form-data">
        <div class="jumbotron">
            <fieldset>
                <!-- <legend>フリーアンケート</legend> -->
                <!-- <label>名前：<input type="text" name="name"></label><br>
                <label>Email：<input type="text" name="email"></label><br>
                <label>年齢：<input type="text" name="age"></label><br>
                <label><textarea name="content" rows="4" cols="40" value=""></textarea></label><br>  -->

                <label>店舗名称：<input type="text" name="shopname"></label><br>
                <label>最寄駅：<input type="text" name="station"></label><br>
                <label>所在地：<input type="text" name="address"></label><br>
                <label>カテゴリ：<input type="text" name="category"></label><br>
                <label>開店時刻：<input type="text" name="openingtime"></label><br>
                <label>閉店時刻：<input type="text" name="closingtime"></label><br>
                <label>平均来店者数/日：<input type="text" name="averagevisitors"></label><br>
                <label>スピーカー設置タイプ：<input type="text" name="devicetype"></label><br>
                <label>客層1：<input type="text" name="segment1"></label><br>
                <label>客層2：<input type="text" name="segment2"></label><br>
                <label>客層3：<input type="text" name="segment3"></label><br>
                <label>タグ1：<input type="text" name="tag1"></label><br>
                <label>タグ2：<input type="text" name="tag2"></label><br>
                <label>タグ3：<input type="text" name="tag3"></label><br>
                <label>画像アップロード：<input type="file" name="image"></label><br>
                <!-- <label><input type="radio" name="display_status" value="1">公開</label><br>
                <label><input type="radio" name="display_status" value="2" checked></label>下書き<br> -->
                <label><select name="display_status"></label><br>
                    <option value="publish">publish</option>
                    <option value="draft">draft</option>
                <label></select></label><br>
                

                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
<!-- 画面表示時から中身を入れておくためにはvalueを使う -->
<!-- ここまでできると、編集画面ができあがる -->
</body>

</html>
