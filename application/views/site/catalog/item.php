<section class="content content-in">
    <div id="anchor1"></div>
    <div class="wrapper">
        <div class="grayline-wrap breadcrumbs">
            <?=$Crumbs['Crumbs']?>
        </div>
        <div class="clear"></div>
        <div class="cart">
            <div class="cart-col-image">
                <div class="cart-slider-wrap">
                    <div class="cart-slider flexslider" id="js-cart-slider">
                        <ul class="slides slides-radius">
                            <?php if (!empty($item["photo"])) foreach ($item["photo"] as $v) { ?>
                            <li class="cart-slider__item" style="background: transparent url(<?= $v['Puth'] ?>big/<?= $v['Name'] ?>) no-repeat scroll left top;">
                                <img src="<?=$v['Puth']?>big/<?=$v['Name']?>" alt="">
                                <div class="cart-slider__item-hover fancyimage" data-fancybox-href='<?=$v['Puth']?>big/<?=$v['Name']?>' data-fancybox-group='cart'></div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="cart-slider-thumbnail thumbnail-slider flexslider" id="js-cart-slider-thumbnail">
                    <ul class="slides slides-radius">
                        <?php if (!empty($item["photo"])) foreach ($item["photo"] as $v) { ?>
                            <li class="cart-slider__item">
                                <a href=""><img src="<?=$v['Puth']?>small/<?=$v['Name']?>" alt="">
                                <div class="cart-slider__item-hover"></div></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="cart-slider-title hr"><div class="cart-slider-title__title">фасады</div></div>
                <div class="thumbnail-slider flexslider" id="js-cart-faces-slider">
                    <ul class="slides slides-faces">
                        <?php if (!empty($item["itemFasad"])) foreach ($item["itemFasad"] as $v) { ?>
                            <li class="cart-slider__item">
                                <a href="<?=$v['Puth']?>big/<?=$v['Name']?>" class="fancyimage"><img src="<?=$v['Puth']?>small/<?=$v['Name']?>" alt="">
                                <div class="cart-slider__item-hover"></div></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="cart-slider-title hr"><div class="cart-slider-title__title cart-color">Цвета</div></div>
                <div class="thumbnail-slider flexslider" id="js-cart-color-slider">
                    <ul class="slides slides-radius">
                        <?php if (!empty($item["itemColor"])) foreach ($item["itemColor"] as $v) { ?>
                            <li class="cart-slider__item">
                                <img src="<?=$v['Puth']?>small/<?=$v['Name']?>" alt="">
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="cart-col-caption">
                <h2><?=$item['Title']?></h2>
                <div class="articul-wrap hr"><div class="articul">Артикул:  <span><?=$item['Articl']?></span></div></div>
                <div class="price-block">
                    <div class="col_6 col-image">
                        <a href="
                            <?php if (!empty($item["photo"])){ echo $item["photo"][0]['Puth']."big/".$item["photo"][0]['Name'];}else echo"";?>"
                        class="fancyimage"><img src="
                            <?php if (!empty($item["photo"])){echo $item["photo"][0]['Puth']."small/".$item["photo"][0]['Name'];}else echo"";?>"" alt="">
                            <div class="cart-slider__item-hover"></div></a>
                    </div>
                    <div class="col_6 col-price">
                        <div class="price-field"><?=$item['Price']?> <span>руб.</span></div>
                        <p>Цена указана за стандартную
                            комплектацию.  Доступен заказ
                            в гипермаркетах
                        </p>
                        <div class="btn popup-show">заказать бесплатный<i><br></i> замер</div>
                    </div>
                </div>
                <?=$item['Description']?>
                <h5>Состав стандартной  комплектации</h5>
                <div class="cart-description-table">  
                    <?=$item['Sostav']?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clear"></div>