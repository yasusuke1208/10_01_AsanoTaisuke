<?php
session_start();
include("functions.php");
check_session_id();

// ユーザ名取得
$user_id = $_SESSION['id'];

// DB接続
$pdo = connect_to_db();

// いいね数カウント


// データ取得SQL作成
// $sql = "SELECT * FROM project_table";
$sql = 'SELECT * FROM project_table LEFT OUTER JOIN (SELECT p_id, SUM(money) AS summoney FROM yell_table GROUP BY p_id) AS moneys ON project_table.id = moneys.p_id';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
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
    $output .= "<td>{$record["higai_name"]}</td>";
    $output .= "<td>{$record["kagai_name"]}</td>";
    $output .= "<td>{$record["detail"]}</td>";
    $output .= "<td>{$record["jidan_money"]}円</td>";
    $output .= "<td>{$record["budget"]}円</td>";
    $output .= "<td>{$record["summoney"]}円</td>";
    $output .= "<td><a href='yell.php?id={$record["id"]}'>応援する</a></td>";
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
  <title>応援リスト（一覧画面）</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="style_user.css">
</head>

<body>
  <fieldset>
    <legend>応援リスト（一覧画面）</legend>
    <a href="sinki.php">プロジェクトを立ち上げる</a>
    <a href="logout.php">logout</a>
    <table class="table table-bordered table-primary">
      <thead>
        <tr>
          <th>被害者</th>
          <th>加害者</th>
          <th>誹謗中傷発言内容</th>
          <th>想定示談金</th>
          <th>応援予算</th>
          <th>現時点の応援総額</th>
          <th>被害者を応援</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>

</body>

</html>