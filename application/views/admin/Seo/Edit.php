<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Характеристики</a></li>
    </ul>
    <form role="form" id="mainForm" method="POST"  action="<?=$current['action']?>">
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="box-body">
                    <div class="form-group col-lg-6">
                        <label for="Psevdonime">Путь</label>
                        <input class="form-control" data_type="required" id="Psevdonime" name="Psevdonime" value="<?=$current['mas']['Psevdonime']?>"  type="text">
                        <input name="LastPsevdonime" value="<?=$current['mas']['Psevdonime']?>"  type="hidden">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="SeoTitle">Seo title</label>
                        <input class="form-control" data_type="required" id="SeoTitle" name="SeoTitle" value="<?=$current['mas']['SeoTitle']?>"  type="text">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="SeoDescription">Seo Description</label>
                        <textarea class="form-control" id="SeoDescription" name="SeoDescription"><?=$current['mas']['SeoDescription']?></textarea>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="SeoKeyword">Seo Keyword</label>
                        <textarea class="form-control" id="SeoKeyword" name="SeoKeyword"><?=$current['mas']['SeoKeyword']?></textarea>
                    </div>
                </div><!-- /.box-body -->
                <input type="hidden" name="type1" value="<?= $current['type'] ?>">
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

