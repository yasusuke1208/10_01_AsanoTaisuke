<?php

function connect_to_db(){

    $dbn = 'mysql:dbname=iloveme;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = '';

    try {
      // ここでDB接続処理を実行する.returnで関数外に結果を出力できる
      return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
      // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
      echo json_encode(["db error" => "{$e->getMessage()}"]);
      exit();
    }
}

// ログイン状態のチェック関数
function check_session_id()
{
  if (!isset($_SESSION['session_id']) || $_SESSION['session_id']!=session_id() ){
  header('Location: login.php');
  } else {
  session_regenerate_id(true);
  $_SESSION['session_id'] = session_id();
  }
}

// 非管理者は入れない挙動   $_SESSION['is_admin']!=1 
function check_session_adminid()
{
  if (!isset($_SESSION['session_id']) || $_SESSION['session_id']!=session_id() || $_SESSION['is_admin']!=1 ){
  header('Location: login_admin.php');
  } else {
  session_regenerate_id(true);
  $_SESSION['session_id'] = session_id();
  }
}
