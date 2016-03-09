<div class="">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab"><?= $com['Name'] ?></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <form role="form"  action="/fasadm/<?= $this->router->fetch_class() ?>/addCat/" method="POST">
                    <table id="table-1" class="table table-hover">
                        <tbody><tr>
                                <th>ID</th>
                                <th>Порядок</th>
                                <th>Заголовок</th>
                                <th>Отображать для всех</th>
                                <th>Действие</th>
                            </tr>
                            <?php foreach ($content as $v) { ?>
                                <tr>
                                    <td><?= $v['id'] ?></td>
                                    <td><?= $v['Order'] ?></td>
                                    <td><?= $v['Title'] ?></td>
                                    <td><?= $v['Show'] ?></td>
                                    <td>
                                        <a href="/fasadm/<?= $this->router->fetch_class() ?>/edit/<?= $v['id'] ?>/" class="btn btn-social-icon btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                        <a onclick="if (!confirm('Удалить')) {
                                                        return false;
                                                    }" href="/fasadm/<?= $this->router->fetch_class() ?>/delite/<?= $v['id'] ?>/" class="btn btn-social-icon btn-danger btn-xs"><i class="fa fa-close"></i></a>
                                        <input type="hidden" name="id[]" value="<?= $v['id'] ?>">
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <div class="box-footer clearfix">
                        <a href="/fasadm/<?= $this->router->fetch_class() ?>/add/" class="btn bg-olive pull-left" style="margin-right: 5px;">Добавить</a>
                        <button type="submit" class="btn btn-primary">Сохранить порядок</button>
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <?= $pagin ?>
                        </ul>
                    </div>
                </form>
            </div><!-- /.tab-pane -->

        </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->
</div>
