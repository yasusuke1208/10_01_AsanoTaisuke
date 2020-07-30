<?php

// 送信確認
// var_dump($_POST);
// exit();

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
  !isset($_POST['username']) || $_POST['username']=='' ||
  !isset($_POST['password']) || $_POST['password']=='' ){
  exit('ParamError');
}


// 受け取ったデータを変数に入れる
$username = $_POST['username'];
$password = $_POST['password'];


// DB接続の設定
// DB名は`gsacf_x00_00`にする
include('functions.php');

$pdo = connect_to_db();


// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO users_table(id, username, password, is_admin, is_deleted, is_higai, created_at, updated_at) VALUES (NULL,:username,:password,0,0,0,sysdate(),sysdate())';


// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
$stmt->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
$status = $stmt->execute();


// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  // データ登録失敗次にエラーを表示
  exit('sqlError:'.$error[2]);

} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  $output = '作成が完了しました。';
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アカウント作成</title>
</head>

<body>

  <div>
    <?= $output?>
    <a href="login.php">ログインする</a>
  </div>

</body>

</html>

