<div class="">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Каталог товаров</a></li>
            <li><a href="#tab_2" data-toggle="tab">Категории</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <table class="table table-hover">
                    <tbody><tr>
                            <th>ID</th>
                            <th>Заголовок</th>
                            <th>Цена</th>
                            <th>Артикль</th>
                            <th>Действие</th>
                        </tr>
                        <?php foreach ($catalog as $v) { ?>
                            <tr>
                                <td><?= $v['id'] ?></td>
                                <td><?= $v['Title'] ?></td>
                                <td><?= $v['Price'] ?></td>
                                <td><?= $v['Articl'] ?></td>
                                <td>
                                    <a href="/fasadm/<?= $this->router->fetch_class() ?>/edit/<?= $v['id'] ?>/" class="btn btn-social-icon btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                    <a onclick="if (!confirm('Удалить')) {
                                                return false;
                                            }" href="/fasadm/<?= $this->router->fetch_class() ?>/delite/<?= $v['id'] ?>/" class="btn btn-social-icon btn-danger btn-xs"><i class="fa fa-close"></i></a>
                                </td>
                            </tr>
<?php } ?>
                    </tbody>
                </table>
                <div class="box-footer clearfix">
                    <a href="/fasadm/<?= $this->router->fetch_class() ?>/add/" class="btn bg-olive pull-left">Добавить</a>
                    <ul class="pagination pagination-sm no-margin pull-right">
<?= $pagin ?>
                    </ul>
                </div>
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                <form role="form" id="" action="/fasadm/<?= $this->router->fetch_class() ?>/addCat/" method="POST">
                    <div class="box-body">
                        <div class="form-group col-lg-12">
<?= $cat ?>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div><!-- /.tab-pane -->

        </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->
</div>
