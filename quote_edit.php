<?php
// 送信データのチェック
// var_dump($_GET);
// exit();
session_start();

// 関数ファイルの読み込み
include("functions.php");
check_session_id();

$id = $_GET["id"];

$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM project_table WHERE id=:id';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は指定の11レコードを取得
  // fetch()関数でSQLで取得したレコードを取得できる
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>想定示談金と応援予算（編集画面）</title>
  <link rel="stylesheet" href="style_admin.css">
</head>

<body>
  <form action="quote_update.php" method="POST">
    <fieldset>
      <legend>想定示談金と応援予算（編集画面）</legend>
      <a href="admin_index.php">一覧画面</a>
      <div>
        想定示談金: <input type="number" name="jidan_money" step="10000" min="10000" value="<?= $record["jidan_money"] ?>">
      </div>
      <div>
        応援予算: <input type="number" name="budget" step="10000" min="10000" value="<?= $record["budget"] ?>">
      </div>
      <div>
        <button>submit</button>
      </div>
      <input type="hidden" name="id" value="<?= $record["id"] ?>">
    </fieldset>
  </form>


<script>

function num_check2(str){
	var ok = true;
	var wresult = "";
	var wcheck = true;
	var wnum = str.value;
	wresult = /[^\d-.]/.test(wnum);
	if (wresult){
		ok=false;
		setTimeout(function(){str.focus();}, 0);
		alert("半角数字以外入力不可です。");}
};

</script>
</body>

</html>