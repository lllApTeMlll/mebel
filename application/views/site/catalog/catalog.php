<div class="grayline-wrap breadcrumbs">
    <?=$Crumbs['Crumbs']?>
</div>
<div class="clear"></div>
<h2><?=$Crumbs['Title']?></h2>
<div class="catalog-content__catalog justifyfix">
    <?php foreach ($catList as $v) { ?>
    <div class="catalog-content__catalog-item" style="background: url(<?=$v['photo']?>) left top no-repeat;">
        <div class="catalog-item__caption">
            <a href="<?="/catalog/item/" . $v["EnglishTitle"] . "/"?>" class="catalog-item__caption-link"><?=$v['Title']?></a>
        </div>
        <div class="catalog-item__caption-hover catalog-popup-show" data-id="<?=$v['id']?>">
            <div class="hover-icon"><a href="">посмотреть</a></div>
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