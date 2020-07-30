<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="login_admin_style.css">
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>被害者ログイン</title>
</head>
<body>

<div id="container">
        <div class="animate-title inview">
            <span class="char">倍</span>
            <span class="char">返</span>
            <span class="char">し</span>
            <span class="char">×</span>
            <span class="char">恩</span>
            <span class="char">返</span>
            <span class="char">し</span>
        </div>
</div>

    <div id="login">
        <h3 class="text-center text-white pt-5">被害者ログイン</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="login_higai_act.php" method="post">
                            <h3 class="text-center text-success">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-success">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-success">Password:</label><br>
                                <input type="text" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-success"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-success btn-md " value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="login.php" class="text-success">ユーザーログインはこちら</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>