<?php

// 送信確認
// var_dump($_POST);
// exit();

session_start();

// 関数ファイルの読み込み
include('functions.php');

check_session_id ();

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
// if (
//   !isset($_POST['comment']) || $_POST['comment']=='' ||
//   !isset($_POST['hashtag']) || $_POST['hashtag']=='' ){
//   exit('ParamError');
// }

// 受け取ったデータを変数に入れる
$higai_name = $_POST['reply'];
$kagai_namae = $_POST['username'];
$kagai_name = $_POST['userid'];
$detail = $_POST['detail'];


$pdo = connect_to_db();

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO project_table(id, higai_name, kagai_namae, kagai_name, detail, jidan_money, budget) VALUES (NULL,:higai_name,:kagai_namae,:kagai_name,:detail,NULL,NULL)';



// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':higai_name', $higai_name, PDO::PARAM_STR);
$stmt->bindValue(':kagai_namae', $kagai_namae, PDO::PARAM_STR);
$stmt->bindValue(':kagai_name', $kagai_name, PDO::PARAM_STR);
$stmt->bindValue(':detail', $detail, PDO::PARAM_STR);
$status = $stmt->execute();


// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  // データ登録失敗次にエラーを表示
  exit('sqlError:'.$error[2]);

} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  header('Location:index.php');
}
