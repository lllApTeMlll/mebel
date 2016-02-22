<section class="content content-in">
    <div class="bg-1"></div>
    <div id="anchor1"></div>
    <div class="wrapper">
        <div class="catalog-wrap iner">
            <div class="catalog-sidebar ">
                <?= $cat ?>
                <div class="clear"></div>

                <div class="need-help">
                    <div class="need-help__title">Нужна помощь<br>в выборе кухни?</div>
                    <div class="manager-call">Наш менеджер проконсультирует<br>Вас по всем вопросам</div>
                    <div class="btn need-help-btn popup-show">Получить консультацию</div>
                </div>
            </div>
            <div class="catalog-content "> 
                <div class="grayline-wrap breadcrumbs">
                    <?= $Crumbs['Crumbs'] ?>
                </div>
                <div class="clear"></div>
                <h2><?= $Crumbs['Title'] ?></h2>
                <div class="catalog-content__catalog ">
                    <?= $content['Description'] ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</section>