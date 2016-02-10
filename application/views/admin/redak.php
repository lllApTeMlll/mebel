 <!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Редактирование</title>
	<link rel="stylesheet" href="/files/site/assets/css/font-awesome.min.css"  />
	<link rel="stylesheet" href="/files/site/assets/fonts/awards/awards.css"  />
	<link rel="stylesheet" href="/files/site/admin/css/redak.css" />
	
	
</head>
<body>
	<form id='avtor' method='POST'>
		<div class="comment-box">
			<div class="comment-head">
				<h6 class="comment-name">Добавление описания</h6>
			</div>
                        <img src="<?=$film['newImg']?>">
			<div class="comment-content">
				<div class="grup">
					<label>
						Название
					</label>
					<p><?=$film['name']?></p>
				</div>
				<div class="grup">
					<label>
						Описание
					</label>
					<p><?=$film['text']?></p>
				</div>
				<div class="grup">
					<label>
						Новое описание
					</label>
                                    <textarea name='newText' ></textarea>
				</div>
				<div class="grup">
					<input type="hidden" name='idd' value="<?=$film['id']?>">
					<input type="submit" class="button" value="Добавить" >
				</div>
			</div>
		</div>
	</form>
<script src="/files/site/assets/js/library/jquery.2.1.1.min.js"></script>

<script src="/files/site/admin/js/avtoris.js"></script>
</body>
</html>