<?php
session_start();

// DB接続の設定
// DB名は`gsacf_x00_00`にする
include('functions.php');

$pdo = connect_to_db();

$username = $_POST["username"];
$password = $_POST["password"];


// 2.SQL準備&実行
$sql = 'SELECT * FROM users_table WHERE username=:username AND password=:password AND is_higai=1';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

var_dump($status);

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    // データ登録失敗次にエラーを表示
    exit('sqlError:'.$error[2]);
}

// 3.抽出データ数を取得
$val = $stmt->fetch();

// 4.該当レコードがあればSESSIONに値を代入
if( $val["id"] != ""){
    $_SESSION = array();
    $_SESSION["session_id"] = session_id();
    $_SESSION["is_higai"] = $val["is_higai"];
    $_SESSION["username"] = $val["username"];
    // 正常にSQLが実行された場合はhigai_index.phpに移動
    header('Location:higai_index.php');
}else {
    // NGの場合はlogin_higai.phpに移動
    header('Location:login_higai.php');
}

// 処理終了
exit();


?>