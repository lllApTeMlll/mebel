<table class="table table-hover">
    <tbody><tr>
            <th>ID</th>
            <th>Категория</th>
            <th>Заголовок</th>
            <th>Цена</th>
            <th>Артикул</th>
            <th>Действие</th>
        </tr>
        <?php foreach ($content as $v) { ?>
            <tr>
                <td><?= $v['id'] ?></td>
                <td><?= $v['Cat'] ?></td>
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

