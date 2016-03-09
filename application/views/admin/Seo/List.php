<div class="">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab"><?= $com['Name'] ?></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <?php foreach ($content as $k => $v) { ?>
                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a class="" aria-expanded="false" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?= $k ?>">
                                        id = '<?= $v['id'] ?>' Заголовок = '<?= $v['SeoTitle'] ?>' Путь = '<?= $v['Psevdonime'] ?>'
                                    </a>
                                </h4>
                            </div>
                            <div style="" aria-expanded="false" id="collapseOne<?= $k ?>" class="panel-collapse collapse">
                                <div class="box-body">
                                    <form role="form" id="mainForm" method="POST"  action="/fasadm/<?= $this->router->fetch_class() ?>/edit/<?= $v['id'] ?>/">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                <div class="box-body">
                                                    <div class="form-group col-lg-6">
                                                        <label for="Psevdonime">Путь</label>
                                                        <input class="form-control" data_type="required" id="Psevdonime" name="Psevdonime" value="<?= $v['Psevdonime'] ?>"  type="text">
                                                        <input name="LastPsevdonime" value="<?= $v['Psevdonime'] ?>"  type="hidden">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="SeoTitle">Seo title</label>
                                                        <input class="form-control" data_type="required" id="SeoTitle" name="SeoTitle" value="<?= $v['SeoTitle'] ?>"  type="text">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="SeoDescription">Seo Description</label>
                                                        <textarea class="form-control" id="SeoDescription" name="SeoDescription"><?= $v['SeoDescription'] ?></textarea>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label for="SeoKeyword">Seo Keyword</label>
                                                        <textarea class="form-control" id="SeoKeyword" name="SeoKeyword"><?= $v['SeoKeyword'] ?></textarea>
                                                    </div>
                                                </div><!-- /.box-body -->
                                                <input type="hidden" name="type" value="edit">
                                                <input type="hidden" name="id" value="<?= $v['id'] ?>">
                                                <div class="box-footer">
                                                    <button type="submit" class="btn btn-success ajax">Сохранить</button>
                                                    <a onclick="if (!confirm('Удалить')) {
                                                                    return false;
                                                                }" href="/fasadm/<?= $this->router->fetch_class() ?>/delite/<?= $v['id'] ?>/" class="btn btn-danger">Удалить</a>

                                                </div>
                                            </div><!-- /.tab-pane -->
                                        </div><!-- /.tab-content -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="box-footer clearfix">
                    <a href="/fasadm/<?= $this->router->fetch_class() ?>/add/" class="btn bg-olive pull-left">Добавить</a>
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?= $pagin ?>
                    </ul>
                </div>
            </div><!-- /.tab-pane -->

        </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->
</div>
