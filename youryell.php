<?php

session_start();

// 関数ファイルの読み込み
include('functions.php');

check_session_id ();
// idの受け取り
$id = $_GET['id'];

// DB接続
$pdo = connect_to_db();


// データ取得SQL作成
$sql = 'SELECT message,money FROM yell_table  WHERE p_id=:id ORDER BY money DESC';


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
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $output = "";
  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td class='fs{$record["money"]}' >{$record["message"]}</td>";
    // 画像出力を追加しよう
    // $output .= "<td><img src='{$record["image"]}' height=150px></td>";
    $output .= "</tr>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($value);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>あなたへの応援メッセージ</title>
  <link rel="stylesheet" href="./fs.css">
  <link rel="stylesheet" href="style_admin.css">
</head>

<body>
  <form action="yell_act.php" method="POST">
  <fieldset>
    <legend>あなたへの応援メッセージ</legend>
    <a href="higai_index.php">あなたへの応援プロジェクトに戻る</a>
    <table>
      <thead>
        <tr>
          <th class="red">あなたへの応援メッセージ</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
      
      <input type="hidden" name="id" value="<?= $record['id'] ?>">
  </fieldset>
  </form>

  <div>
      <button class="btn slide-bg">闘う</button>
  </div>
</body>

</html>