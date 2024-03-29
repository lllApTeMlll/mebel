<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Характеристики</a></li>
        <li><a href="#tab_2" data-toggle="tab">Добавление фото</a></li>
        <li><a href="#tab_3" data-toggle="tab">Seo</a></li>
    </ul>
    <form role="form" id="mainForm" method="POST" action="<?=$current['action']?>">
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="box-body">
                    <div class="form-group col-lg-6">
                        <label for="Title">Название</label>
                        <input class="form-control" id="Title" data_type="required" name="Title" value="<?= $current['mas']["Title"] ?>"  type="text">
                    <input name="LastTitle" value="<?= $current['mas']["EnglishTitle"] ?>" type="hidden">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="EnglishTitle">Seo название</label>
                        <input class="form-control" id="EnglishTitle" data_type="required" name="EnglishTitle" value="<?= $current['mas']["EnglishTitle"] ?>"  type="text">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="Articl">Артикул</label>
                        <input class="form-control" id="Articl" data_type="required" name="Articl" value="<?= $current['mas']["Articl"] ?>"  type="text">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="Price">Цена</label>
                        <input class="form-control" id="Price" data_type="required" name="Price" value="<?= $current['mas']["Price"] ?>"  type="text">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="Cat">Категория</label>
                        <select name='Cat'>
                            <?=$current['cat'] ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="SostavStandart">СОСТАВ СТАНДАРТНОЙ КОМПЛЕКТАЦИИ</label>
                        <input class="form-control" id="SostavStandart"  name="SostavStandart" value="<?= $current['mas']["SostavStandart"] ?>"  type="text">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="PriceText">Текст под ценой</label>
                        <textarea class="form-control ckedit" id="PriceText" name="PriceText" ><?= $current['mas']["PriceText"] ?></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="Description">Описание</label>
                        <textarea class="form-control ckedit" id="Description" name="Description" ><?= $current['mas']["Description"] ?></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="Sostav">Состав</label>
                        <textarea class="form-control ckedit" id="Sostav" name="Sostav"><?= $current['mas']["Sostav"] ?></textarea>
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
                        <label for="rigthPhoto">Фото справо</label>
                        <input id="rigthPhoto" class="loadImage" type="file" multiple name="files[]">
                    </div>
                    <div class="form-group col-lg-12">
                        <ul class="photoActiv">
                            <?= $current['rigthPhoto'] ?>
                        </ul>
                    </div>
                </div>
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
                <div class="box-body">
                    <div class="form-group col-lg-12">
                        <label for="itemFasad">Загрузка фото фасадов</label>
                        <input id="itemFasad" class="loadImage" type="file" multiple name="files[]">
                    </div>
                    <div class="form-group col-lg-12">
                        <ul class="photoActiv">
                            <?= $current['itemFasad'] ?>
                        </ul>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group col-lg-12">
                        <label for="itemColor">Загрузка фото цветов</label>
                        <input id="itemColor" class="loadImage" type="file" multiple name="files[]">
                    </div>
                    <div class="form-group col-lg-12">
                        <ul class="photoActiv">
                            <?= $current['itemColor'] ?>
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
                        <input class="form-control" id="SeoTitle" name="SeoTitle" value="<?=$Seo['SeoTitle']?>"  type="text">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="SeoDescription">Seo Description</label>
                        <textarea class="form-control" id="SeoDescription" name="SeoDescription"><?=$Seo['SeoDescription']?></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="SeoKeyword">Seo Keyword</label>
                        <textarea class="form-control" id="SeoKeyword" name="SeoKeyword"><?=$Seo['SeoKeyword']?></textarea>
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

