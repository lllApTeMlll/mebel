<div class="grayline-wrap breadcrumbs">
    <?=$Crumbs['Crumbs']?>
</div>
<div class="clear"></div>
<h2><?=$Crumbs['Title']?></h2>
<div class="catalog-content__catalog news">
    <?php foreach ($catList as $k => $v) { ?>
        <div class="catalog-row">
            <div class="catalog-row__item item-image" style="background: transparent url(<?=$v['photo']?>) no-repeat scroll left top;">
                <img src="<?=$v['photo']?>" alt="">
            </div>
            <div class="catalog-row__item item-caption">
                <div class="number"><?php echo date('d.m.Y', strtotime($v['Date'])) ?></div>
                <h3><?= $v['Title'] ?></h3>
                <div class="diskrNews"><?php echo word_limiter(strip_tags($v['Description'], "<p>"), 50) ?></div>
                <div class="btn need-help-btn review-more"><a href="/news/item/<?=$v['EnglishTitle']?>/">подробнее</a></div>
            </div>
        </div>
    <?php } ?>
</div>
<div class="clear"></div>
<div class="pager-wrap">
    <div class="cont">
    <?=$pagin?>
    </div>
</div>