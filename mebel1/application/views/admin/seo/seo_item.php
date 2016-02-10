<div class="templatemo-content-wrapper">
    <object class="uppod_style_video" id="films5323" uid="films5323" type="application/x-shockwave-flash" data="/templates/kinogo/player/player.swf" height="408" width="640">
	<param name="bgcolor" value="#000000">
	<param name="wmode" value="transparent">
	<param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always">
	<param name="movie" value="/templates/kinogo/player/player.swf">
<param name="flashvars" value="vast_preroll=http://kinogo.net/engine/modules/video.php&amp;comment=Фокус (2015)&amp;st=http://kinogo.net/templates/kinogo/player/films_nem.txt&amp;file=2iob3gRLvctM31EMtQYM0joZkHm=2xmLkasB05wbv1Eatg45tgoHOQAlUatVkg95tQyhtgG5tQ3NkgActaEztdTcvc9h0QnLk5480ftL2iENvakL2cw1vQnVtQYBk5Wa&amp;poster=http://kinogo.net/templates/kinogo/uppod/preview.jpg">
</object>
    <div class="templatemo-content">
      <ol class="breadcrumb">
        <li><a href='/fasadm/'>Административная панель</a></li>
        <li ><a href='/fasadm/seo/'>SEO модуль</a></li>
        <li class="active">SEO модуль добавление</li>
      </ol>
        <div class="content">
            <div class="windowForm">
                    <div class='tab'>
                        <div class='h1 active'>
                            <div class="headerForm">
                                <h2>Характеристи товара</h2>
                                <a class="slide"></a>
                            </div>
                        </div>
                    </div>
                    <form method='post' action='/fasadm/seo/add' id='main' enctype="multipart/form-data">
                    <div class='slide'>
                        
                        <div class="mainForm">
                                <div class="grup">
                                    <label>
                                        url
                                    </label>
                                    <input data-type="required" class='inp nam' type="text" name="url" value="<?=$list['url']?>">
                                </div>
                                <div class="grup">
                                    <label>
                                        h1
                                    </label>
                                    <input data-type="required" class='inp nam' type="text" name="h1" value="<?=$list['h1']?>">
                                </div>
                                <div class="grup">
                                    <label>
                                        title
                                    </label>
                                    <input data-type="required" class='inp nam' type="text" name="title" value="<?=$list['title']?>">
                                </div>
                                <div class="grup">
                                    <label>
                                        kywords
                                    </label>
                                    <input data-type="required" class='inp nam' type="text" name="kywords" value="<?=$list['kywords']?>">
                                </div>
                                <div class="grup">
                                    <label>
                                        description
                                    </label>
                                    <textarea data-type="required" name='description' ><?=$list['description']?></textarea>
                                </div>
                                <div class="grup">
                                    <label>
                                        Описание
                                    </label>
                                    <textarea data-type="required" name='arricl' id="editor"><?=$list['arricl']?></textarea>
                                </div>
                                <div class='pos'>
                                </div>
                        </div>
                    </div>
                        <input type="hidden" name='type' value='<?=$type?>'>
                        <input type="hidden" name='id' value='<?=$list['id']?>'>
                    <div class="futerForm">
                            <div class="grup">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <a href='/fasadm/seo/' class="btn btn-default">Отмена</a>    
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
