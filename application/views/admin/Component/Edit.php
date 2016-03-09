<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Характеристики</a></li>
    </ul>
    <form role="form" id="mainForm" method="POST"  action="<?=$current['action']?>">
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="box-body">
                    <div class="form-group col-lg-6">
                        <label for="Title">Заголовок</label>
                        <input class="form-control" id="Title" data_type="required" name="Title" value="<?= $current['mas']["Title"] ?>"  type="text">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="Name">Название</label>
                        <input class="form-control" id="Name" data_type="required" name="Name" value="<?= $current['mas']["Name"] ?>"  type="text">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="Icon">Иконка</label>
                        <input class="form-control" id="Icon" data_type="required" name="Icon" value="<?= $current['mas']["Icon"] ?>"  type="text">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="Puth">Путь</label>
                        <input class="form-control" id="Puth" data_type="required" name="Puth" value="<?= $current['mas']["Puth"] ?>"  type="text">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="Show">Показывать для пользователей</label>
                        <select name='Show'>
                            <?=$current['Show'] ?>
                        </select>
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

