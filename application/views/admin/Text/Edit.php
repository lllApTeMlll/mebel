<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Характеристики</a></li>
    </ul>
    <form role="form" id="mainForm" method="POST"  action="<?=$current['action']?>">
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="box-body">
                    <div class="form-group col-lg-6">
                        <label for="Title">Название</label>
                        <input class="form-control" id="Title" data_type="required" name="Title" value="<?= $current['mas']["Title"] ?>"  type="text">
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="Description">Наполнение</label>
                        <textarea class="form-control ckedit" id="Description" name="Description" ><?= $current['mas']["Description"] ?></textarea>
                    </div>
                </div><!-- /.box-body -->
                <input type="hidden" name="type" value="<?= $current['type'] ?>">
                <input type="hidden" name="id" value="<?= $current['id'] ?>">
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <?php if ($current['type']==="edit"){?>
                    <button type="submit" class="btn btn-success ajax">Применить</button>
                    <?php }?>
                    <a href="/fasadm/<?= $this->router->fetch_class() ?>/" class="btn btn-danger">Отмена</a>
                </div>

            </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
    </form>
</div>

