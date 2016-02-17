<div class="wrapper">
    <?php foreach ($catList as $k => $v) { ?>
        <div class="catalog-row">
            <div class="catalog-row__item item-image">
                <div class="cart-slider projects-slider flexslider" id="js-projects-slider">
                    <ul class="slides">
                        <?php if (!empty($v["photo"])) foreach ($v["photo"] as $v1) { ?>
                        <li class="cart-slider__item" style="background: transparent url(<?= $v1['Puth'] ?>big/<?= $v1['Name'] ?>) no-repeat scroll left top;"><img src="<?= $v1['Puth'] ?>big/<?= $v1['Name'] ?>" alt=""></li>
                            <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="catalog-row__item item-caption">
                <div class="number"><?php echo ($k + 1) ?></div>
                <h3><?= $v['Title'] ?><span class="sep">/</span><a href="">смотреть</a></h3>
                <?php echo word_limiter($v['Description'], 50) ?>
                <hr>
                <div class="reviews__title"><h3>Отзыв клиента</h3></div>
                <div class="review"><?php echo word_limiter($v['Review'], 50) ?>
                    <!--<span><a href="">читать весь отзыв</a></span>-->
                </div>
                <div class="review__author">Иван Ивановский, Иркутск, 26 л.</div>
                <!--<div class="btn need-help-btn review-more"><a href="">подробнее</a></div>-->
            </div>
        </div>
    <?php } ?>
</div>
<div class="clear"></div>
<div class="wrapper">
    <div class="pager-wrap projects-pager">
        <?= $pagin ?>
    </div>
</div>