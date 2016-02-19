<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Характеристики</a></li>
        <li><a href="#tab_2" data-toggle="tab">Добавление фото</a></li>
        <li><a href="#tab_3" data-toggle="tab">Seo</a></li>
    </ul>
    <form role="form" id="mainForm" method="POST"  action="<?=$current['action']?>">
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="box-body">
                    <div class="form-group col-lg-6">
                        <label for="Title">Название</label>
                        <input class="form-control" id="Title" data_type="required" name="Title" value="<?= $current['mas']["Title"] ?>"  type="text">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="EnglishTitle">Seo название</label>
                        <input class="form-control" id="EnglishTitle" data_type="required" name="EnglishTitle" value="<?= $current['mas']["EnglishTitle"] ?>"  type="text">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="Date">Дата</label>
                        <input class="form-control datepicker" id="Date" name="Date" value="<?= $current['mas']["Date"] ?>"  type="text">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="Type">Тип</label>
                        <select name='Type'>
                            <?=$current['cat'] ?>
                        </select>
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="Description">Описание</label>
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
            <div class="tab-pane" id="tab_2">
                <div class="box-body">
                    <div class="form-group col-lg-12">
                        <label for="loadImage">Загрузка фото</label>
                        <input id="loadImage" class="loadImage" type="file" multiple name="files[]">
                    </div>
                    <div class="form-group col-lg-12">
                        <ul class="photoActiv">
                            <?= $current['image'] ?>
                        </ul>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <?php if ($current['type']==="edit"){?>
                    <button type="submit" class="btn btn-success ajax">Применить</button>
                    <?php }?>
                    <a href="/fasadm/<?= $this->router->fetch_class() ?>/" class="btn btn-danger">Отмена</a>
                </div>
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
                <div class="box-body">
                    <div class="form-group col-lg-12">
                        <label for="SeoTitle">Seo title</label>
                        <input class="form-control" id="SeoTitle" name="SeoTitle" value="<?= $Seo['SeoTitle'] ?>"  type="text">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="SeoDescription">Seo Description</label>
                        <textarea class="form-control" id="SeoDescription" name="SeoDescription"><?= $Seo['SeoDescription'] ?></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="SeoKeyword">Seo Keyword</label>
                        <textarea class="form-control" id="SeoKeyword" name="SeoKeyword"><?= $Seo['SeoKeyword'] ?></textarea>
                    </div>
                </div><!-- /.box-body -->

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

