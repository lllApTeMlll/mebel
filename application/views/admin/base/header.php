<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Административная панель</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="/files/site/all/bootstrap/css/bootstrap.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/files/site/all/font-awesome/css/font-awesome.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/files/site/admin/dist/css/AdminLTE.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="/files/site/admin/css/admin.css">
        <link rel="stylesheet" href="/files/site/admin/dist/css/skins/_all-skins.min.css">
        <!-- jQuery 2.1.4 -->
        <script src="/files/site/all/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="/files/site/all/bootstrap/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/files/site/admin/dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="/files/site/admin/dist/js/demo.js"></script>
        <!--<script src='/files/site/all/ckeditor/ckeditor.js'></script>
        <script src='/files/site/all/AjexFileManager/ajex.js'></script>-->

        <script src='/files/site/admin/js/transfer.js'></script>
        <script src='/files/site/all/datapiker/js/jquery.datetimepicker.js'></script>
        <link rel="stylesheet" href="/files/site/all/datapiker/css/jquery.datetimepicker.css">
        
        <link rel="stylesheet" href="/files/site/all/codemirror/codemirror.min.css">
        <link rel="stylesheet" href="/files/site/all/floara/css/froala_editor.css">
        <link rel="stylesheet" href="/files/site/all/floara/css/froala_style.css">
        <link rel="stylesheet" href="/files/site/all/floara/css/plugins/code_view.css">
        <link rel="stylesheet" href="/files/site/all/floara/css/plugins/image_manager.css">
        <link rel="stylesheet" href="/files/site/all/floara/css/plugins/image.css">
        <link rel="stylesheet" href="/files/site/all/floara/css/plugins/line_breaker.css">
        <link rel="stylesheet" href="/files/site/all/floara/css/plugins/table.css">
        <link rel="stylesheet" href="/files/site/all/floara/css/plugins/char_counter.css">
        <link rel="stylesheet" href="/files/site/all/floara/css/plugins/video.css">
        <link rel="stylesheet" href="/files/site/all/floara/css/plugins/colors.css">
        <link rel="stylesheet" href="/files/site/all/floara/css/plugins/fullscreen.css">
        <!--<link rel="stylesheet" href="/files/site/all/floara/css/plugins/quick_insert.css">-->

<!--        <script type="text/javascript" src="/files/site/all/codemirror/codemirror.min.js"></script>
        <script type="text/javascript" src="/files/site/all/codemirror/xml.min.js"></script>-->
        <script type="text/javascript" src="/files/site/all/floara/js/froala_editor.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/align.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/code_beautifier.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/code_view.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/image.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/image_manager.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/link.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/lists.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/paragraph_format.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/paragraph_style.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/table.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/video.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/url.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/entities.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/colors.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/font_size.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/font_family.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/line_breaker.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/char_counter.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/inline_style.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/save.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/fullscreen.min.js"></script>
<!--        <script type="text/javascript" src="/files/site/all/floara/js/plugins/quote.min.js"></script>
        <script type="text/javascript" src="/files/site/all/floara/js/plugins/quick_insert.min.js"></script>-->
        <script type="text/javascript" src="/files/site/all/floara/js/languages/ru.js"></script>

        <script src='/files/site/all/drag/jquery.drag-drop.plugin.js'></script>
        <script src='/files/site/all/drag/drag.js'></script>
        <script src='/files/site/all/Translit.js'></script>
        <script src="/files/site/all/func.js"></script>
        
        <script src="/files/site/all/sort/jquery-ui.js"></script>
        <script src="/files/site/all/sort/jquery.mjs.nestedSortable.js"></script>
        
        <script src="/files/site/admin/js/loadImage.js"></script>
        <script src="/files/site/admin/js/forms.js"></script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="/fasadm/" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>Adm</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin panel</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="/files/site/admin/dist/img/avatar.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?= ($this->session->userdata('username')) ?></p>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <?php foreach ($com['Items'] as $v) { ?>
                            <li class="<?= $v['Act'] ?>">
                                <a href="<?= $v['Puth'] ?>">
                                    <i class="fa <?= $v['Icon'] ?>"></i>
                                    <span><?= $v['Title'] ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?= $com['Name'] ?> <small>Административная панель</small> 
                    </h1>
                    <ol class="breadcrumb">
                        <?= $com['Crumbs'] ?>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
