<div class="overlay">
    <div class="wrapper">
        <div class="popup-form">
            <div class="popup-form-slider">
                <div class="cart-slider-wrap">
                    <div class="cart-slider flexslider" id="js-catalog-slider">
                        <ul class="slides">
                            <?php if (!empty($cat["photo"])) foreach ($cat["photo"] as $v) { ?>
                            <li class="popup-slider__item" style="background: transparent url(<?= $v['Puth'] ?>big/<?= $v['Name'] ?>) no-repeat scroll left top;">
                                <img src="<?=$v['Puth']?>big/<?=$v['Name']?>" alt="">
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="cart-slider-thumbnail thumbnail-slider flexslider" id="js-catalog-slider-thumbnail">
                    <ul class="slides">
                        <?php if (!empty($cat["photo"])) foreach ($cat["photo"] as $v) { ?>
                        <li class="cart-slider__item"><a href="">
                                <img src="<?=$v['Puth']?>small/<?=$v['Name']?>" alt="">
                                <div class="cart-slider__item-hover"></div></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="popup-form-sidebar">
                <h4><?=$cat['Title']?></h4>
                <p><?=$cat['Description']?></p>
                <div class="learn-more-btn">
                    <div class="btn"><a href="<?="/catalog/item/" . $cat["EnglishTitle"] . "/"?>">Узнать подробнее</a></div>
                </div>
                <div class="need-help-btn-wrap">
                    <div class="btn need-help-btn popup-show">Получить консультацию</div>
                </div>
            </div> 
            <div class="close-catalog-popup"></div>
        </div>
    </div>
</div>