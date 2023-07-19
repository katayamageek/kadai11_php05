<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>アカウント登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div> -->
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="signup_insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>アカウント登録</legend>
                <label>名前：<input type="text" name="name"></label><br>
                <label>lid：<input type="text" name="lid"></label><br>
                <label>lpw：<input type="text" name="lpw"></label><br>
                <label>kanri_flg：<input type="text" name="kanri_flg"></label><br>
                <label>life_flg：<input type="text" name="life_flg"></label><br>

                <label>権限：<select name="roll"></label><br>
                    <option value="Administrator">Administrator</option>
                    <option value="Member">Member</option>
                <label></select></label><br>


                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->
</body>

</html>
