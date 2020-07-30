<?php
session_start();
include("functions.php");
check_session_adminid();
// ユーザ名取得
$id = $_GET["id"];

// DB接続
$pdo = connect_to_db();
// いいね数カウント
// データ取得SQL作成
// $sql = "SELECT * FROM project_table";
$sql = 'SELECT * FROM project_table LEFT OUTER JOIN (SELECT p_id, SUM(money) AS summoney FROM yell_table GROUP BY p_id) AS moneys ON project_table.id = moneys.p_id WHERE budget<summoney AND id=:id';
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
    $output .= "<td>{$record["higai_name"]}さんへのTwitter上での不適切発言について</td>";
    $output .= "<td><input type='hidden' id='tweetTextArea' value='{$record["kagai_name"]}さま。あなたが{$record["higai_name"]}さんへ行ったコメントは、個人への誹謗中傷として最大”{$record["jidan_money"]}円”の賠償を請求される恐れがあります。また、この発言を看過できない方々から”{$record["summoney"]}円”の応援資金が集まり、{$record["higai_name"]}さんはあなたと戦う準備をしています。'>
                {$record["kagai_name"]}さま"."<br/>"."あなたが{$record["higai_name"]}さんへ行った”{$record["detail"]}”というコメントは、個人への誹謗中傷として最大”{$record["jidan_money"]}円”の賠償を請求される恐れがあります。
                また、この発言を看過できない方々から”{$record["summoney"]}円”の応援資金が集まり、{$record["higai_name"]}さんはあなたと戦う準備をしています。</td>";
    // $output .= "<td><a href='kagaisya.php?id={$record["id"]}'>加害者へ通知</a></td>";
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
  <title>加害者通知文</title>
</head>
<body>
  <fieldset>
    <legend>加害者通知文</legend>
    <a href="admin_index2.php">達成一覧に戻る</a>
    <a href="logout.php">logout</a>
    <table>
      <thead>
        <tr>
          <th>件名</th>
          <th>本文</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
    <button id="tweetButton">加害者に連絡</button>
  </fieldset>



<script>
  document.querySelector('#tweetButton').addEventListener('click', () => {
  // ツイート内容を取得
  let tweetText = document.querySelector('#tweetTextArea').value;
  // 半角スペースと #JavaScriptをツイート文言に追加する

  // エンコードする
  const encodedText = encodeURIComponent(tweetText);
  // ツイート用リンクを作成する
  const tweetURL =
    `https://twitter.com/intent/tweet?text=${encodedText}`;
  // ツイート用リンクを開く
  window.open(tweetURL);
});
</script>


</body>
</html>