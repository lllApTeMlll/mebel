<div class="">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Каталог товаров</a></li>
            <li><a href="#tab_2" data-toggle="tab">Категории</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="form-group col-lg-12">
                    <label for="Cat">Категория</label>
                    <select name='Cat' class="ajaxCat">
                        <?= $current['cat'] ?>
                    </select>
                </div>
                <div class="ajaxConten">
