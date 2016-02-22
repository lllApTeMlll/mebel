<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Авторизация</title>
        <link rel="stylesheet" href="/files/site/all/font-awesome/css/font-awesome.min.css"  />
        <link rel="stylesheet" href="/files/site/all/bootstrap/css/bootstrap.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/files/site/all/font-awesome/css/font-awesome.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/files/site/admin/dist/css/AdminLTE.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="/files/site/all/growl/jquery.growl.css">
        <link rel="stylesheet" href="/files/site/admin/css/admin.css">
        <link rel="stylesheet" href="/files/site/admin/dist/css/skins/_all-skins.min.css">
    </head>
    <body>
        <div class="login-box">
            <div class="login-logo">
                <b>Admin</b>LTE</a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Введите ваш email и пароль</p>
                <form action="" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" data_type="required" name="name" class="form-control" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" data_type="required" name="password" class="form-control" placeholder="Пароль">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-flat">Авторизоваться</button>
                        </div><!-- /.col -->
                    </div>
                </form> 
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
        <script src="/files/site/all/jQuery-2.1.4.min.js"></script>
        <script type="text/javascript" src="/files/site/all/func.js"></script>
        <script type="text/javascript" src="/files/site/all/growl/jquery.growl.js"></script>
        <script src="/files/site/admin/js/avtoris.js"></script>
    </body>
</html>