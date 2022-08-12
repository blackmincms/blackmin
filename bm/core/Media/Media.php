<?php
    namespace BlackMin\Media;

    use BlackMin\Base\BaseInterface;
    use BlackMin\Database\Database;
    use BlackMin\Message\Message;
    use BlackMin\FileSystem\FileSystemBM;

    final class Media implements BaseInterface {

        private $database;
        private $action;
        private $params;

        protected $message;

        public function __construct (Database $database , string $action, array $params) {
            $this->database = $database;
            $this->action = $action;
            $this->params = $params;

            $this->message = new Message();
        }

        public function parse(){
            switch ($this->action) {
                case 'get':
                    return $this->get();
                case 'del':
                    return $this->del();
                case 'rename':
                    return $this->rename();
                case 'upload':
                    return $this->upload();
                case 'update':
                    return $this->edit();
                default:
                    return false;
            } 
        }
   
        public function get(){
            if (isset($this->params['id'])) {          
                // filtrowanie danych
                $id = $this->database->valid($this->params['id']);

                // check param is int

                if ((is_int($id)) || (is_string($id))) {
                    // zapytanie do db
                    $zap = $this->database->query("SELECT `|prefix|bm_files`.*, `|prefix|bm_files`.`|prefix|bm_author` as 'id_author' , `|prefix|bm_users`.`nick` as 'autor' FROM `bm_files` LEFT JOIN `|prefix|bm_users` ON `|prefix|bm_files`.`bm_author` = `|prefix|bm_users`.`id` WHERE `id_file` = '$id' LIMIT 1");
                } else {
                    $zap = $this->message->format("war", "Wprowadzone dane nie są liczbą");
                }
            } else {
                if (isset ($this->params['roszerzenie'])){
                    $roszerzenie = $this->params['roszerzenie'];
                }else{
                    $roszerzenie = "all";
                }
                
                if (isset ($this->params['folder'])){
                    $folder = $this->params['folder'];
                }else {
                    $folder = "";
                }
                
                if (isset ($this->params['ile_load'])){
                    $ile_load = $this->params['ile_load'];
                }else {
                    $ile_load = "25";
                }
                
                if (isset ($this->params['szukaj'])){
                    $szukaj = $this->params['szukaj'];
                }else{
                    $szukaj = "";
                }
            
                // filtrowanie danych
                
                $roszerzenie = $this->database->valid($roszerzenie);
                $folder = $this->database->valid($folder);
                $szukaj = $this->database->valid($szukaj);
                $ile_load = $this->database->valid($ile_load);
                
                $roszerzenie = ($roszerzenie == "all" ? "`bm_file_type` LIKE '%%'" : "`bm_file_type` LIKE '%". $roszerzenie ."%'");
                $folder = (strlen($folder) === 0 ? "`bm_folder` LIKE '%%'" : "`bm_folder` LIKE '%". $folder ."%'");
                $szukaj = (strlen($szukaj) === 0 ? "(`bm_name` LIKE '%%' OR `bm_name_orginal` LIKE '%%' OR `bm_description` LIKE '%%')" : "(`bm_name` LIKE '%". $szukaj ."%' OR `bm_name_orginal` LIKE '%". $szukaj ."%' OR `bm_description` LIKE '%". $szukaj ."%')");
                $ile_load = ($ile_load < 0 ? 0 : $ile_load);
                // zapytanie do db
                $zap = $this->database->query2("SELECT `|prefix|bm_files`.*, `|prefix|bm_files`.`|prefix|bm_author` as 'id_author' , `|prefix|bm_users`.`nick` as 'autor' FROM `bm_files` LEFT JOIN `|prefix|bm_users` ON `|prefix|bm_files`.`bm_author` = `|prefix|bm_users`.`id` WHERE $roszerzenie AND $folder AND $szukaj ORDER BY `id_file` DESC LIMIT $ile_load");
            }
            return $zap;
        }
        
        public function del(){
            if (isset($this->params["name"])) {
                if ($this->params["name"] === "media") {
                    if (isset($this->params["content"])) {
                        $content = $this->params["content"];
                        // sprawdzanie czy dane są do usunięcja
                        $ile = count($content);
                        if ($ile == 0) {
                            return $this->message->format("info", "Brak danych do usunięcja.");
                            exit();
                        }

                        $count_check_sum = 0;

                        for ($i=0; $i < $ile; $i++) { 
                            // id valid
                            $id = $this->database->valid($content[$i]);
                            // check param is int
                            if (!is_string($id)) {
                                return $this->message->format("war", "Wprowadzone dane nie są liczbą");
                                exit();
                            }

                            // get data from db
                            $zap = $this->database->query("SELECT `id_file`, `bm_path`, `bm_thumbnail`, `bm_name` FROM `_prefix_bm_files` WHERE `id_file` = '$id' LIMIT 1");
                            if ($zap["num_rows"] === 0) {
                                return $this->message->format("war", "Nie znaleziono danych do usunięcia");
                                exit();
                            }
                            if ($zap === false) {
                                return $this->message->format("error", "Wystąpił błąd pod czas szukania danych do usunięcia");
                                exit();
                            }

                            // set path
                            $path = $zap[0]['bm_path'];
                            $thumbnail = $zap[0]['bm_thumbnail'];

                            $path = str_replace(BM_SETTINGS["url_server"], "", $path);
                            $thumbnail = str_replace(BM_SETTINGS["url_server"], "", $thumbnail);

                            $error_sum = 0;
                            // set FSBM
                            $FSBM = new FileSystemBM();
                            // check if file exists
                            if (!$FSBM->isExistFile($path)) {
                                $error_sum++;
                            }
                            // check if file exists
                            if (!$FSBM->isExistFile($thumbnail)) {
                                $error_sum++;
                            }

                            if (isset($error_sum) && $error_sum === 2) {
                                return $this->message->format("war", "Nie znaleziono pliku do usunięcia.");
                                exit();
                            }

                            // set check sum
                            $check_sum = 0;
                            // delete file
                            if ($FSBM->removeFile($path)) {
                                $check_sum++;
                            }
                            if ($FSBM->removeFile($thumbnail)) {
                                $check_sum++;
                            }

                            // remove from db
                            if ($this->database->delete("DELETE FROM `_prefix_bm_files` WHERE `id_file` = '$id'")) {
                                $check_sum++;
                            }
                            
                            // check if all is ok
                            if ($check_sum !== 3) {
                                return $this->message->format("war", "Nie udało się usunąć pliku: ". $zap[0]['bm_name']);
                                break;
                            }

                            // add check sum
                            $count_check_sum++;
                        }

                        // return message
                        if (isset($this->params["multiply"])) {
                            if ($count_check_sum === $ile) {
                            return $this->message->format("success", "Usunięto ". $count_check_sum ." plik(ów).");
                            }
                        }
                        
                        if ($count_check_sum === $ile) {
                            return $this->message->format("success_del", "Usunięto ". $count_check_sum ." plik(ów).");
                        } else {
                            return $this->message->format("error", "Wystąpił błąd podczas usuwania plik(ów).");
                        }
                    }else{
                        return $this->message->format("info", "Brak danych do usunięcja...");	
                        exit();
                    }
                }else{
                    return $this->message->format("error", "Błędne danye wejśćiowye.");	
                    exit();
                }
            } else {
                return $this->message->format("error", "Brak danych wejśćiowych.");	
                exit();
            }	
        }

        public function rename(){
            if (isset($this->params["name"])) {
                if (isset($this->params["content"])) {
                    // sprawdzanie czy dane są do usunięcja
                    $t = count($this->params["content"]);
                    if ($t === 0) {
                        return $this->message->format("info", "Brak danych do zmiany.");	
                        exit();
                    }else {
                        $a = $this->database->parse($this->params["content"]);
                        $a = $this->database->valid($a);
                        $nazwa_folderu = $this->database->valid($this->params["rename"]);

                        if (strlen($nazwa_folderu) === 0) {
                            $nazwa_folderu = "default";
                        }
                    
                        // ustawienie odpowiedniej daty do zapisu
                        $datetime = date('Y-m-d H:i:s"');
                        // usuwanie danych
                        if ($this->database->update("UPDATE `|prefix|bm_files` SET `bm_folder`='$nazwa_folderu', `bm_datetime_changed` = '$datetime' WHERE `id_file` IN ($a)")) {
                            return $this->message->format("success", "Nazwa folderu pliku została poprawnie zmieniona!");	
                            exit();
                        }else {
                            return $this->message->format("error", "Wystąpił Błąd podczas zmieniania nazwy folderu pliku.");	
                            exit();
                        }
                    }
                }else{
                    return $this->message->format("info", "Brak danych do zmiany.");	
                    exit();
                }
            } else {
                return $this->message->format("error", "Brak danych wejśćiowych.");	
                exit();
            }
        }

        public function upload(int $size = 4000000, string $roszerzenie = "audio/*,video/*,image/*", int $permission = 0755, int $quality = 75) {
            try {

                // check data i  not empty
                if (!isset($this->params["file"])) {
                    return ["result" => "error", "message" => "Brak danych wejśćiowych."];
                }

                // check user is logged
                if (!isset($_SESSION["id"]) && $_SESSION["id"] === 0) {
                    return ["result" => "error", "message" => "Nie jesteś zalogowany."];
                }

                // set file
                $file = $this->params["file"];
                // set temp path
                $temp_path = $file["tmp_name"];

                // check file is upload
                if (!is_uploaded_file($temp_path)) {
                    return ["result" => "error", "message" => "Plik nie został wysłany poprawnie!"];
                }

                // check file error
                if ($file["error"] > 0) {	
                    return ["result" => "error", "message" => "Wystąpił błąd podczas wysyłania pliku!"];
                }

                // set path to save
                $path = "bm-content" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
                $pathWWW = "bm-content/uploads/";

                // set filesystembm
                $FSBM = new FileSystemBM($path);
                // check FSBM error
                if ($FSBM->intErrorCode() !== 0) {
                    return ["result" => "error", "message" => "Wystąpił nie znany bład!"];
                }
                // check if folder exist
                if (!$FSBM->isDir("")) {
                    // return error
                    return ["result" => "error", "message" => "Folder główny nie istnieje!"];
                }
                // createStructure
                if (!$savePath = $FSBM->createStructure("", $permission, "Y", "m", "d", false)) {
                    // return error
                    return ["result" => "error", "message" => "Nie można utworzyć struktury folderu!"];
                }

                // get mime type
                $mime = mime_content_type($temp_path);

                // set pathinfo
                $pathinfo = pathinfo($temp_path, PATHINFO_ALL);
                // set file name
                $filename = $pathinfo["filename"];
                // set file extension
                $extension = $pathinfo["extension"];
                // set file basename
                $basename = $pathinfo["basename"];
                // set file dirname
                $dirname = $pathinfo["dirname"];

                // set name file upload
                $name = basename($file["name"]);

                // check file extension
                if (!$FSBM->isExtension($temp_path, $roszerzenie, true)) {
                    // return error
                    return ["result" => "error", "message" => "Nieprawidłowe rozszerzenie pliku!"];
                }
                // check file size
                if (!$FSBM->isSize($temp_path, $size, true)) {
                    // return error
                    return ["result" => "error", "message" => "Plik jest za duży!"];
                }

                $pathT = str_replace(DIRECTORY_SEPARATOR, "/", $savePath[0]);
                $pathThumbnail = str_replace(DIRECTORY_SEPARATOR, "/", $savePath[1]);

                // set error info
                $addIsSet = 0;

                // crate file createMiniaturs
                $Thumbnail = $FSBM->createMiniaturs($pathThumbnail, $temp_path, $name, 250, 170, $quality);
                if ($Thumbnail === false) {
                    // return error
                    return ["result" => "error", "message" => "Nie można utworzyć miniaturki! ->". $name];
                };
                
                // check if file exist
                if (!$FSBM->isExistFile($pathT . $name)) {
                    // save file
                    if (!$FSBM->saveUploadFile($pathT, $temp_path, $name)) {
                        // return error
                        return ["result" => "error", "message" => "Nie można zapisać pliku! -> ". $name];
                    }
                } else {
                    $addIsSet++;
                }

                // check if file exit in database
                $checkDB = $this->database->query("SELECT `id_file` FROM `|prefix|bm_files` WHERE `bm_name_orginal` = '$name'");
                if (!$checkDB) {
                    // return error
                    return ["result" => "error", "message" => "Nie można sprawdzić czy plik istnieje w bazie danych! -> ". $name];
                }
                if ($checkDB["num_rows"] > 0) {
                    $addIsSet++;
                }
                
                if (isset($addIsSet) && $addIsSet === 2) {
                    // return error
                    return ["result" => "error", "message" => "Plik już istnieje! -> ". $name];
                }

                // set data
                $datetime = date('Y-m-d H:i:s');
                // name cut
                $nameCut = substr($name, 0, -strlen($extension) - 1);

                $pathThumb = (is_null($Thumbnail) ? "null" : BM_SETTINGS["url_server"] . $pathWWW . $pathThumbnail. $name);

                // add file to database
                if ($this->database->insert("INSERT INTO `|prefix|bm_files` (`id_file`, `bm_author`, `bm_name`, `bm_name_orginal`, `bm_description`, `bm_file_type`, `bm_thumbnail`, `bm_folder`, `bm_path`, `bm_datetime_upload`, `bm_datetime_changed`) VALUES (NULL , '". $_SESSION["id"] ."', '$nameCut', '$name', '','$mime', '". $pathThumb ."', 'default', '". BM_SETTINGS["url_server"] . $pathWWW . $pathT . $name ."', '$datetime', '$datetime')")) {
                    // return success
                    return ["result" => "success", "message" => "Plik został zapisany poprawnie! -> ". $name];  
                }

                // return error upload
                return ["result" => "error", "message" => "Wystąpił błąd pod czas zapisywania pliku!"];

            } catch (\Throwable $th) {
                // throw $th;
                return ["result" => "error", "message" => "Wystąpił nie znany bład!"];
            }
        }

        public function edit (){
            if (isset($this->params["tytul"])) {
                // ustawienie odpowiedniej daty do zapisu
                $datetime = date('Y-m-d H:i');

                // zmianna raportująca o błędach
                $ad_ok = true;
                if (isset ($this->params['tytul'])){
                    $nazwa = $this->params['tytul'];
                }else{
                    $ad_ok = false;
                }
                
                if (isset ($this->params['folder'])){
                    $folder =$this->params['folder'];
                }else{
                    $ad_ok = false;
                }
                
                if (isset ($this->params['opis'])){
                    $opis = $this->params['opis'];
                }else{
                    $ad_ok = false;
                }
                
                if (isset ($this->params['id'])){
                    $id = $this->params['id'];
                }else{
                    $ad_ok = false;
                }
        
                if ($ad_ok) {
                    if ((strlen($nazwa)<1) || (strlen($nazwa)>4096))
                    {
                        $ad_ok = false;
                    }
                    
                    if (strlen($folder)>4096)
                    {
                        $ad_ok = false;
                    }
                    
                    if ((strlen($opis )<0) || (strlen($opis )>4096))
                    {
                        $ad_ok = false;
                    }
                    
                    if (strlen($id )<0)
                    {
                        $ad_ok = false;
                    }
        
                    if ($ad_ok) {
                        $nazwa = $this->database->valid($nazwa);
                        $folder = $this->database->valid($folder);
                        $opis = $this->database->valid($opis);
        
                        $zap = $this->database->query("SELECT * FROM `|prefix|bm_files` WHERE `bm_name` LIKE '$nazwa' AND `bm_description` LIKE '$opis' AND `bm_folder` LIKE '$folder'");
                        if ($zap["num_rows"] === 0) {

                            if (strlen($folder) === 0) {
                                $folder = "default";
                            }

                            // usuwanie danych
                            if ($this->database->update("UPDATE `|prefix|bm_files` SET `bm_name`= '$nazwa', `bm_description`= '$opis',`bm_folder`= '$folder', `bm_datetime_changed`= '$datetime' WHERE `id_file`= $id")) {
                                return $this->message->format("success_update", "Dane zostały edytowane!");
                                exit();
                            }else {
                                return $this->message->format("error", "Wystąpił błąd pod czas edytowania danych.");
                                exit();
                            }
                        } else {
                            return $this->message->format("info", "Dane są takie same!");
                            exit();
                        }
                    } else {
                        return $this->message->format("info", "Wprowadzone dane są za krótkie lub długie.");
                        exit();
                    }
                    
                }else{
                    return $this->message->format("info", "Brak danych do edytowania.");
                    exit();
                }
            } else {
                return $this->message->format("error", "Brak danych wejśćiowych.");
                exit();
            }
        }        

    }