<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Административная панель</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php require_once 'froalaAdmin.php'; ?>

<!--        <script src='/files/site/all/drag/jquery.drag-drop.plugin.js'></script>
        <script src='/files/site/all/drag/drag.js'></script>-->
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
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="">
                                <a href="#" class="logout">
                                    <i class="fa fa-sign-out"></i>
                                    Выход
                                </a>
                            </li>
                        </ul>
                    </div>
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
