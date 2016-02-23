<div class="main-gallery">
    <ul class="main-gallery__slider js-main-gallery">

        <?php foreach ($slider as $k => $v) { ?>
            <li class="main-gallery__slider-item">
                <div class="item-fon" style="background: url(<?= $v["photo"] ?>) center center no-repeat;"></div>
                <div class="item-wrap">
                    <div class="wrapper"> 
                        <div class="main-gallery__slider-item-caption">
                            <h4><?= $v["Title"] ?></h4>
                            <div class="diskrNews"><?php echo word_limiter(strip_tags($v['Description'], "<p>"), 50) ?></div>
                            <a href="<?= $v["Url"] ?>" class="learn-more">узнать подробнее</a>
                        </div>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>  
    <div id="main-gallery__pager" class="bx-pager">
        <?php foreach ($slider as $k => $v) { ?>
        <a href="" data-slide-index="<?=$k?>">
            <div class="img-wrap">
                <img src="<?= $v["photo"] ?>" alt="">
            </div>
        </a>
        <?php } ?>
    </div>  
</div>
<div class="clear"></div>
<div class="grayline">
    <div class="wrapper">
        <div class="copy">Разработка сайта P&P</div>
        <div class="grayline-wrap">
            <?=$vstavka[1]['Description']?>
            <div class="grayline-facebook"><div class="facebook-icon"><a href=""></a></div></div>
        </div>
    </div>
</div>
<div class="mouse-wrap">
    <div class="wrapper ">
        <div class="animate-mouse">
            <div class="mouse"></div>
            <a href="#anchor1"></a>
        </div>
    </div>
</div>
</section>
<div class="clear"></div>
<section class="content">
    <div id="anchor1"></div>
    <div class="catalog">
        <h1>НАША ПРОДУКЦИЯ</h1>
        <div class="wrapper">
            <?php foreach ($block as $k => $v) { ?>
                <div class="catalog-row js-catalog-row">
                    <div class="catalog-row__item item-image js-item-image">
                        <div class="item-image-arrow"></div>
                        <a href="<?= $v["Url"] ?>"><img src="<?= $v["photo"] ?>" alt=""></a>
                    </div>
                    <div class="catalog-row__item item-caption js-item-caption">
                        <h3><?= $v["Title"] ?><span class="sep">/</span><a href="<?= $v["Url"] ?>">смотреть</a></h3>
                        <div class="diskrNews"><?php echo word_limiter(strip_tags($v['Description'], "<p>"), 50) ?></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section> 
<div class="clear"></div>
<section class="footer"> 
    <div class="footer-wrap">
        <div class="contacts">
            <div class="contacts-wrap">
                <div class="contacts-title">
                    Как с нами связаться
                </div>
                <div class="contacts-field">
                    <div class="wrapper">
                        <?=$contact['Description']?>
                        <div class="social-block">
                            <div class="social-block__button vk-icon"><a href=""></a></div>
                            <div class="social-block__button twitter-icon"><a href=""></a></div>
                            <div class="social-block__button facebook-icon"><a href=""></a></div>
                        </div>
                    </div>
                    <div class="map-canvas">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>     
        <div class="footer-block">
            <div class="wrapper">
                <div class="copy">Разработка сайта P&P</div>
                <div class="grayline-wrap">
                    <?=$vstavka[2]['Description']?>
                    <div class="grayline-facebook"><div class="facebook-icon"><a href=""></a></div></div>
                </div>
            </div>
            <div class="back-button-wrap"><div class="back-button"><a href="#anchor2">наверх</a></div></div>
        </div>
    </div>
</section> 
</body>
</html>