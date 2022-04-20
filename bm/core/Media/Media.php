<?php
    namespace BlackMin\Media;

    use BlackMin\Base\BaseInterface;
    use BlackMin\Database\Database;
    use BlackMin\Message\Message;

    class Media implements BaseInterface {

        private $database;
        private $action;
        private $parm;

        protected $message;

        public function __construct (Database $database ,string $action, array $params) {
            $this->database = $database;
            $this->action = $action;
            $this->parm = $params;

            $this->message = new Message();
        }

        public function parse() {
            switch ($this->action) {
                case 'get':
                    return $this->get();
                case 'set':
                    return $this->set();
                case 'del':
                    return $this->del();
                case 'rename':
                    return $this->rename();
                case 'upload':
                    return $this->upload();
                default:
                    return false;
            }
        }
   
        public function get() {
            if (isset ($this->parm['roszerzenie'])){
                $roszerzenie = $this->parm['roszerzenie'];
            }else{
                $roszerzenie = "all";
            }
            
            if (isset ($this->parm['folder'])){
                $folder = $this->parm['folder'];
            }else {
                $folder = "";
            }
            
            if (isset ($this->parm['ile_load'])){
                $ile_load = $this->parm['ile_load'];
            }else {
                $ile_load = "25";
            }
            
            if (isset ($this->parm['szukaj'])){
                $szukaj = $this->parm['szukaj'];
            }else{
                $szukaj = "";
            }
        
            // filtrowanie danych
            
            $roszerzenie = $this->database->valid($roszerzenie);
            $folder = $this->database->valid($folder);
            $szukaj = $this->database->valid($szukaj);
            $ile_load = $this->database->valid($ile_load);
            
            $roszerzenie = ($roszerzenie === "all" ? "`bm_file_type` LIKE '%%'" : "`bm_file_type` LIKE '%". $roszerzenie ."%'");
            $folder = (strlen($folder) === 0 ? "`bm_folder` LIKE '%%'" : "`bm_folder` LIKE '%". $folder ."%'");
            $szukaj = (strlen($szukaj) === 0 ? "(`bm_name` LIKE '%%' OR `bm_name_orginal` LIKE '%%' OR `bm_description` LIKE '%%')" : "(`bm_name` LIKE '%". $szukaj ."%' OR `bm_name_orginal` LIKE '%". $szukaj ."%' OR `bm_description` LIKE '%". $szukaj ."%')");
            $ile_load = ($ile_load < 0 ? 0 : $ile_load);
            // zapytanie do db
            $zap = $this->database->query2("SELECT `|prefix|bm_files`.*, `|prefix|bm_files`.`|prefix|bm_author` as 'id_author' , `|prefix|bm_users`.`nick` as 'autor' FROM `bm_files` LEFT JOIN `|prefix|bm_users` ON `|prefix|bm_files`.`bm_author` = `|prefix|bm_users`.`id` WHERE $roszerzenie AND $folder AND $szukaj ORDER BY `id` DESC LIMIT $ile_load");
            return $zap;
        }

        public function set() {
            return $this->message->format("info", "TODO");
        }
        
        public function del() {
            if (isset($this->parm["name"])) {
                if ($this->parm["name"] === "dysk") {
                    if (isset($this->parm["content"])) {
                        // sprawdzanie czy dane są do usunięcja
                        $t = count($this->parm["content"]);
                        if ($t === 0) {
                            return $this->message->format("info", "Brak danych do usunięcja.");
                        }else {
                            $a = $this->database->parse($this->parm["content"]);
                            $a = $this->database->valid($a);
        
                            if ($x = $this->database->query("SELECT `id_file`, `bm_path`, `bm_thumbnail`, `bm_name` FROM `|prefix|bm_files` WHERE `id_file` IN (". $a .")")) {
                                if ($x["num_rows"] != 0) {
                                    $is_ok = true;
                                    $count_check_sum = 0;
                                    $error_del = "";
                                    
                                    // główna ścieżka
                                    $real_path = realpath("../../../") . "/bm-content//";
                                    
                                    for($i = 0; $i < $t; $i++){
                                        // validate
                                        $path_file = $this->database->valid(str_replace(BM_SETTINGS["url_server"], $real_path, $x[$i]["bm_path"]));
                                        $path_thumbnail =$this->database->valid(str_replace(BM_SETTINGS["url_server"], $real_path, $x[$i]["bm_thumbnail"]));
                                        
                                        if(file_exists($path_file)){
                                            if(@unlink($path_file)){
                                                // sprawdzanie czy miniaturka istnieje
                                                if($x[$i]["bm_thumbnail"] !== "null"){
                                                    if(file_exists($path_thumbnail)){
                                                        @unlink($path_thumbnail);
                                                    }else{
                                                        $error_del .= $x[$i]["bm_name"] . " ,";
                                                        $is_ok = false;
                                                    }
                                                }
                                            }else{
                                                $error_del .= $x[$i]["bm_name"] . " ,";
                                                $is_ok = false;
                                            }
                                            
                                            // check sum count
                                            $count_check_sum++;
                                        }else{
                                            $is_ok = false;
                                        }
                                    }
        
                                    // sprawdzanie czy nie ma błlędów pod czas usuwania plików
                                    if($is_ok === true){
                                        // usuwanie danych
                                        if ($this->database->delete("DELETE FROM `_prefix_bm_files` WHERE `id_file` IN (". $a .")")) {
                                            return $this->message->format("success_del", "Usunięto '. $t .' plik(ów) poprawnie!");
                                        }else {
                                            return $this->message->format("error", "Wystąpił błąd pod czas usuwania danych.");
                                        }
                                    }else{
                                        // sprawdzanie czy suma kontrolna wynosi zero
                                        if($count_check_sum === 0){
                                            // sprawdzanie czy usunięto już dane
                                            if($this->database->query("SELECT `id_file` FROM `_prefix_bm_files` WHERE `id_file` IN (". $a .")")["num_rows"] != 0){
                                                if($this->database->delete("DELETE FROM `_prefix_bm_files` WHERE `id_file` IN (". $a .")")){
                                                    return $this->message->format("success_del", "Usunięto '. $t .' plik(ów) poprawnie!");
                                                }else{
                                                    return $this->message->format("error", "Wystąpił błąd pod czas usuwania danych.");
                                                }
                                            }else{
                                                return $this->message->format("info", "Plik(i) zostały już usunięte!");
                                            }
                                        }else{
                                            return $this->message->format("error", "Kod błędu: [ERROR_DELETE_FILE] - Błąd podczas usuwania plik(ów)!");
                                        }
                                    }
                                } else {
                                    return $this->message->format("info", "Brak danych do usunięcja..");
                                }
                            } else {
                                return $this->message->format("error", "Wystąpił błąd pod czas zapytania do bazy danych.");
                            }
                        }
                    }else{
                        return $this->message->format("info", "Brak danych do usunięcja...");
                    }
                }else{
                    return $this->message->format("error", "Błędne danye wejśćiowye.");
                }
            } else {
                return $this->message->format("error", "Brak danych wejśćiowych.");
            }
        }

        public function rename() {
            if (isset($this->parm["name"])) {
                if (isset($this->parm["content"])) {
                    // sprawdzanie czy dane są do usunięcja
                    $t = count($this->parm["content"]);
                    if ($t === 0) {
                        return $this->message->format("info", "Brak danych do zmiany.");
                    }else {
                        $a = $this->database->parse($this->parm["content"]);
                        $a = $this->database->valid($a);
                        $nazwa_folderu = $this->database->valid($this->parm["rename"]);
                    
                        // ustawienie odpowiedniej daty do zapisu
                        $datetime = date('Y-m-d H:i:s"');
                        // usuwanie danych
                        if ($this->database->update("UPDATE `|prefix|bm_files` SET `bm_folder`='$nazwa_folderu', `bm_datetime_changed` = '$datetime' WHERE `id_file` IN ($a)")) {
                            return $this->message->format("success", "Nazwa folderu pliku została poprawnie zmieniona!");
                        }else {
                            return $this->message->format("error", "Wystąpił Błąd podczas zmieniania nazwy folderu pliku.");
                        }
                    }
                }else{
                    return $this->message->format("info", "Brak danych do zmiany.");
                }
            } else {
                return $this->message->format("error", "Brak danych wejśćiowych.");
            }
        }

        public function upload() {
            return $this->message->format("war", "jest gitara");
        }

    }