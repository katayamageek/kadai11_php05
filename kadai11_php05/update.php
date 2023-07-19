<?php
ini_set('display_errors', 1);

//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//2. $id = $_POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

//データ取得（フォームで送られてくるものはこれで受け取りましょう）
// $name = $_POST['name'];
// $email = $_POST['email'];
// $age = $_POST['age'];
// $content = $_POST['content'];  
$id = $_POST['id'];

$shopname = $_POST['shopname'];
$station = $_POST['station'];
$address = $_POST['address'];
$category = $_POST['category'];
$openingtime = $_POST['openingtime'];
$closingtime = $_POST['closingtime'];
$averagevisitors = $_POST['averagevisitors'];
$devicetype = $_POST['devicetype'];
$segment1 = $_POST['segment1'];
$segment2 = $_POST['segment2'];
$segment3 = $_POST['segment3'];
$tag1 = $_POST['tag1'];
$tag2 = $_POST['tag2'];
$tag3 = $_POST['tag3'];
$display_status = $_POST['display_status'];

// var_dump($_POST);
// exit();
// ↑バーダンプはうまくいっている！

// detail.phpの一部をコピペしてくる

try {
    $db_name = 'php05_kadai_db'; //データベース名
    $db_id   = 'root'; //アカウント名
    $db_pw   = ''; //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}


// 2.5 画像ファイルのアップロード処理
$upload_dir = 'upload/'; // 画像のアップロード先ディレクトリ

// アップロードされたファイルの情報を取得
$uploaded_file = $_FILES['image']['tmp_name'];
$filename = $_FILES['image']['name'];
$file_path = $upload_dir . $filename;

// ファイルを指定のディレクトリに移動
if (move_uploaded_file($uploaded_file, $file_path)) {
  // 移動成功した場合の処理
  echo 'ファイルをアップロードしました。';
} else {
  // 移動失敗した場合の処理
  echo 'ファイルのアップロードが失敗しました。';
}


//３．データ登録SQL作成　★prepare内はコピペ元から消して書き直す

// 【更新時→】UPDATE テーブル名　SET カラム1 = 1に保存したいもの、カラム2 = 2に保存したいもの,,,, WHERE 条件 id = 送られてきたid
$stmt = $pdo->prepare('UPDATE php05_kadai_table SET 
                                                    -- name = :name, 
                                                    -- email = :email, 
                                                    -- age = :age, 
                                                    -- content = :content, 
                                                    -- indate = sysdate(), 
                                                    shopname = :shopname, 
                                                    station = :station, 
                                                    address = :address, 
                                                    category = :category, 
                                                    openingtime = :openingtime, 
                                                    closingtime = :closingtime, 
                                                    averagevisitors = :averagevisitors, 
                                                    devicetype = :devicetype, 
                                                    segment1 = :segment1, 
                                                    segment2 = :segment2, 
                                                    segment3 = :segment3, 
                                                    tag1 = :tag1, 
                                                    tag2 = :tag2, 
                                                    tag3 = :tag3, 
                                                    image = :image,
                                                    display_status = :display_status 
                                                WHERE id = :id;');

// $stmt->bindValue(':name', $name, PDO::PARAM_STR); //数字はINT なので注意
// $stmt->bindValue(':email', $email, PDO::PARAM_STR); //数字はINT なので注意
// $stmt->bindValue(':age', $age, PDO::PARAM_INT); //数字はINT なので注意
// $stmt->bindValue(':content', $content, PDO::PARAM_STR); //数字はINT なので注意


$stmt->bindValue(':shopname', $shopname, PDO::PARAM_STR);
$stmt->bindValue(':station', $station, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':category', $category, PDO::PARAM_STR);
$stmt->bindValue(':openingtime', $openingtime, PDO::PARAM_STR);
$stmt->bindValue(':closingtime', $closingtime, PDO::PARAM_STR);
$stmt->bindValue(':averagevisitors', $averagevisitors, PDO::PARAM_INT);
$stmt->bindValue(':devicetype', $devicetype, PDO::PARAM_STR);
$stmt->bindValue(':segment1', $segment1, PDO::PARAM_STR);
$stmt->bindValue(':segment2', $segment2, PDO::PARAM_STR);
$stmt->bindValue(':segment3', $segment3, PDO::PARAM_STR);
$stmt->bindValue(':tag1', $tag1, PDO::PARAM_STR);
$stmt->bindValue(':tag2', $tag2, PDO::PARAM_STR);
$stmt->bindValue(':tag3', $tag3, PDO::PARAM_STR);
$stmt->bindValue(':image', $file_path, PDO::PARAM_STR);
$stmt->bindValue(':display_status', $display_status, PDO::PARAM_STR);

$stmt->bindValue(':id', $id, PDO::PARAM_INT); //数字はINT なので注意

$status = $stmt->execute(); //実行


// 以上の間、insert.phpからコピペしてきて一部改変



// 以下新たな学び　select.phpの「//３．データ表示」からコピペしてくる

$result = '';
// エラーがあれば
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    // エラーがなければ遷移させる↓
    header('Location: dashboard.php');
    exit();
}

