<?php
session_start();

// SESSION初期化
$_SESSION = array();

// Coookieに保存していたらSESSIONIDの保存期間を過去にして破棄
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(),'',time()-42000,'/');
}

// SESSION座標
session_destroy();
header('Location:login.php');
exit();


?>