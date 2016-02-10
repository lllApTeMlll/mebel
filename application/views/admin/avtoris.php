<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Авторизация</title>
        <link rel="stylesheet" href="/files/site/all/font-awesome/css/font-awesome.min.css"  />
        <link rel="stylesheet" href="/files/site/admin/css/avtor.css" />
        <link rel='stylesheet' href='/files/site/all/modal1/css/style.css' type='text/css' />
    </head>
    <body>
        <form id='avtor'>
            <div class="comment-box">
                <div class="comment-head">
                    <h1 class="comment-name">Авторизация</h1>
                </div>
                <div class="comment-content">
                    <div class="grup">
                        <label>
                            Имя пользователя
                        </label>
                        <input class='inp nam' data-type="required" type="text" name="name" value="">	
                    </div>
                    <div class="grup">
                        <label>
                            Пароль
                        </label>
                        <input class='inp nam' data-type="required" type="password" name="password" value="">
                    </div>
                    <div class="grup">
                        <input type="hidden" name='action' value="add">
                        <input type="button" class="button" value="Авторизоваться" >
                    </div>
                </div>
            </div>
        </form>
        <div class='modal' id='messM'>
            <div class='close'>&times;</div>
            <div >
                <h2 class='hed'>
                </h2>
            </div>
            <div class='grup'>
                <p class='texxt'></p>
            </div>
        </div>
        <script src="/files/site/all/jQuery-2.1.4.min.js"></script>
        <script type="text/javascript" src="/files/site/all/func.js"></script>
        <script type='text/javascript' src='/files/site/all/modal1/js/script.js'></script>
        <script src="/files/site/admin/js/avtoris.js"></script>
    </body>
</html>