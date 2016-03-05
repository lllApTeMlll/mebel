<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Характеристики</a></li>
    </ul>
    <form role="form" id="mainForm" method="POST"  action="<?= $current['action'] ?>">
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="box-body">
                    <div class="form-group col-lg-6">
                        <label for="Email">Email</label>
                        <input class="form-control" id="Email" data_type="required" name="Email" value="<?= $current['mas']["Email"] ?>"  type="text">
                        <input name="LastEmail" value="<?= $current['mas']["Email"] ?>" type="hidden">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="Password">Пароль</label>
                        <input class="form-control" data_type="<?php echo $current['type']==="add" ? "required" : "" ?>" id="Password" name="Password" value=""  type="text">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="Description">Привилегии</label>
                    </div>
                    <?php foreach ($current['com'] as $v) { ?>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input name="Privilege[]" <?=$v['active']?> value="<?=$v['Name']?>" type="checkbox">
                                </span>
                                <input class="form-control" disabled="" value="<?=$v['Title']?>" type="text">
                            </div><!-- /input-group -->
                        </div>
                    <?php } ?>

                </div><!-- /.box-body -->
                <input type="hidden" name="type" value="<?= $current['type'] ?>">
                <input type="hidden" name="id" value="<?= $current['id'] ?>">
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <?php if ($current['type'] === "edit") { ?>
                        <button type="submit" class="btn btn-success ajax">Применить</button>
                    <?php } ?>
                    <a href="/fasadm/<?= $this->router->fetch_class() ?>/" class="btn btn-danger">Отмена</a>
                </div>

            </div><!-- /.tab-pane -->
        </div><!-- /.tab-pane -->
    </form>
</div>

