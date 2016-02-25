            </div>
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                <form role="form" id="" action="/fasadm/<?= $this->router->fetch_class() ?>/addCat/" method="POST">
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