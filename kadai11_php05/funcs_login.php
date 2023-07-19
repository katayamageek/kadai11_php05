<?php

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn()
{
    try {
        $db_name = 'php05_kadai_db';    //データベース名
        $db_id   = 'root';      //アカウント名
        $db_pw   = '';      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = 'localhost'; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
    header('Location: ' . $file_name);
    exit();
}


// ログインチェク処理 loginCheck()
// 今後「loginCheck();」と書くだけで呼び出せるようになります
function loginCheck(){
    if($_SESSION['chk_ssid'] !== session_id()){
        exit('LOGIN ERROR ログインしないとみられませんよ〜');
    // ↑これにより、ログインしてないとselect.phpは表示できないようになる
    // 試しにプライベートブラウザでselect.phpを直打ちするとLOGIN ERRORを出す
    }else{
    session_regenerate_id(true);
        //↑鍵（文字列）を再発行して
    $_SESSION['chk_ssid'] = session_id(); 
        //▼▼▼　chatGPT解説　▼▼▼ 
        //↑「$_SESSION['chk_ssid'] = session_id(); 」は「現在のセッションIDを取得し、それをセッション変数$_SESSION['chk_ssid']に保存する」という
        // 操作を行っています。この値は、後でセッションIDを確認したいときなどに使用できます。 
        // session_id()は現在のセッションIDを返すPHPの関数（規定の関数）です。
    }
}