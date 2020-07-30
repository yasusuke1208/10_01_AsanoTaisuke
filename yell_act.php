<?php

// 送信データのチェック
// var_dump($_POST);
// exit();

session_start();

// 関数ファイルの読み込み
include('functions.php');

check_session_id ();

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
    !isset($_POST['message']) || $_POST['message']=='' ||
    !isset($_POST['money']) || $_POST['money']=='' ){
    exit('ParamError');
  }

// 受け取ったデータを変数に入れる
$message = $_POST['message'];
$money = $_POST['money'];

// 送信データ受け取り
$id = $_POST['id'];

$pdo = connect_to_db();

// データ登録SQL作成
$sql = 'INSERT INTO yell_table(p_id, username, message, money) VALUES (:p_id,:username,:message,:money)';



// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $_SESSION["username"], PDO::PARAM_STR);
$stmt->bindValue(':message', $message, PDO::PARAM_STR);
$stmt->bindValue(':money', $money, PDO::PARAM_STR);
$stmt->bindValue(':p_id', $id, PDO::PARAM_INT);
$status = $stmt->execute();



// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
  header("Location:index.php");
  exit();
}
