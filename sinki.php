<?php

ini_set('display_errors', 0);

session_start();

// 関数ファイルの読み込み
include("functions.php");
check_session_id();

require_once('TwitterAppOAuth.php');
// Consumer Key (API Key) を設定
$consumer_key = '';
// Consumer Secret (API Secret) を設定
$consumer_secret = '';
// アプリケーション認証実行
$connection = new TwitterAppOAuth($consumer_key, $consumer_secret);
// ツイート検索パラメータの設定、「q」は検索文字列

// var_dump($_POST["reply"]);

$params = array(
    'q' => $_POST["reply"]
);
// ツイート検索実行
$tweets_obj = $connection->get('search/tweets', $params);

// オブジェクトを配列に変換
$tweets_arr = json_decode($tweets_obj, true);

// var_dump($tweets_arr);
// exit();

// ツイートの表示
// $result = [];  // データの出力用変数（初期値は空文字）を設定
$output = "";
for ($i = 0; $i < count($tweets_arr['statuses']); $i++) {
    // foreach ($result as $tweets_arr) {
      $output .= "<form action='sinki_act.php' method='POST'>";
      $output .= "<tr>";
      $output .= "<td><input type='hidden' name='username'  value='{$tweets_arr['statuses'][$i]['user']['name']}'>{$tweets_arr['statuses'][$i]['user']['name']}</td>";
      $output .= "<td><input type='hidden' name='userid'  value='@{$tweets_arr['statuses'][$i]['user']['screen_name']}'>@{$tweets_arr['statuses'][$i]['user']['screen_name']}</td>";
      $output .= "<td><input type='hidden' name='detail' value='{$tweets_arr['statuses'][$i]['text']}'>{$tweets_arr['statuses'][$i]['text']}</td>";
      $output .= "<td><input type='submit' value='プロジェクト立ち上げ'></td>";
      $output .= "<td><input type='hidden' name='reply' value='{$_POST["reply"]}'></td>";
      $output .= "</tr>";
      $output .= "</form>";
    }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（一覧画面）</title>
  <link rel="stylesheet" href="style_user.css">
</head>

<body>
  <form action="sinki.php" method="POST">
    <fieldset>
      <legend>リプライ一覧</legend>
        <div>
          ユーザー名: <input type="text" name="reply" value="@">
          <button>submit</button> 
        </div>
    </fieldset>
  </form>
        <br>
  <!-- <form action="sinki_act.php" method="POST"> -->
    <fieldset>
      <table>
        <thead>
          <tr>
            <th>ユーザー名</th>
            <th>ユーザーID</th>
            <th>発言内容</th>
          </tr>
        </thead>
        <tbody>
          <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
          <?= $output ?>
        </tbody>
      </table>
    </fieldset>
  </form>


</body>

</html>