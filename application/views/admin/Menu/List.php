<div class="">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_2" data-toggle="tab">Меню</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_2">
                <form role="form" id="menu" action="/fasadm/<?= $this->router->fetch_class() ?>/addCat/" method="POST">
                    <div class="box-body">
                        <div class="form-group col-lg-12">
<?= $cat ?>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <button type="submit" class="btn btn-success ajax">Применить</button>
                    </div>
                </form>
            </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->
</div>
