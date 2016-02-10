  <?php 
    ini_set('display_errors', 1);
error_reporting(E_ALL);
echo $_SERVER['DOCUMENT_ROOT']." ";
$zip = new ZipArchive();
if ($zip->open($_SERVER['DOCUMENT_ROOT']."/files.zip") === true) {
		$zip->extractTo($_SERVER['DOCUMENT_ROOT']); //Извлекаем файлы в указанную директорию
		$zip->close(); //Завершаем работу с архивом
  }
  else {
	  echo " don't extend!"; //Выводим уведомление об ошибке
	  die();
  }    
	$zip->close();    
