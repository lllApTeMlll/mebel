  <?php 
	
//	function chmod_r($path, $filemode, $dirmode) {
//    if (is_dir($path) ) {
//        if (!chmod($path, $dirmode)) {
//            $dirmode_str=decoct($dirmode);
//            print "Failed applying filemode '$dirmode_str' on directory '$path'\n";
//            print "  `-> the directory '$path' will be skipped from recursive chmod\n";
//            return;
//        }
//        $dh = opendir($path);
//        while (($file = readdir($dh)) !== false) {
//            if($file != '.' && $file != '..') {  // skip self and parent pointing directories
//                $fullpath = $path.'/'.$file;
//                chmod_R($fullpath, $filemode,$dirmode);
//            }
//        }
//        closedir($dh);
//    } else {
//        if (is_link($path)) {
//            print "link '$path' is skipped\n";
//            return;
//        }
//        if (!chmod($path, $filemode)) {
//            $filemode_str=decoct($filemode);
//            print "Failed applying filemode '$filemode_str' on file '$path'\n";
//            return;
//        }
//    }
//}
// 
////Пример использования, выставляем максимальные права для папок и файлов в определенной папке
////здесь "/home/site.ru/www/upload" путь к папке, 0777 - права на файлы, 0777 - права на папки
//chmod_r($_SERVER['DOCUMENT_ROOT']."/application/", 0777, 0777); 
//
//echo "ok";
