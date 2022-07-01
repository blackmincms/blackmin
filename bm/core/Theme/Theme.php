<?php
    namespace BlackMin\Theme;

    use BlackMin\Base\BaseInterface;
    use BlackMin\Database\Database;
    use BlackMin\Message\Message;
    use BlackMin\FileSystem\FileSystemBM;
    use BlackMin\FileSystem\FileSystemDB;
    
    final class Theme implements BaseInterface {
    
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
                case 'del':
                    return $this->del();
                case 'activation':
                    return $this->activation();
                default:
                    return false;
            }
        }
    
        public function get(){
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

            $FSBM = new FileSystemBM("bm-content/themes/");
            // check FSBM error
            if ($FSBM->intErrorCode() !== 0) {
                return $this->message->format("error", "Wystąpił nie znany bład!");
            }

            $scan = $FSBM->scan("{thumbnail,package}.{png,bmp,jpeg,jpg,gif,json}", "", 2, false, GLOB_BRACE);
            // check FSBM error
            if ($FSBM->intErrorCode() !== 0) {
                return $this->message->format("war", "Wystąpił błąd pod czas pobierania wgranych Motywów");
            }
            // add key active to active theme
            foreach ($scan as $key => $value) {
                if ($scan[$key]["name"] === $this->database->unvalid(BM_SETTINGS["bm_theme_active"])) {
                    $scan[$key]["active"] = true;
                }
            }
            return $scan;
        }
    
        public function del() {
            if (empty($this->parm["data"])) {
                return $this->message->format("error", "Brak danych wejśćiowych");
            }

            // sprawdzanie czy dane istnieją
            if (strlen($this->parm["data"]) === 0) {
                return $this->message->format("war", "Błędne dane wejśćiowe.");
            }

            // en: create new FileSystemBM object
            $FSBM = new FileSystemBM("bm-content/themes/");

            // check FSBM error
            if ($FSBM->intErrorCode() !== 0) {
                return $this->message->format("error", "Wystąpił nie znany bład!");
            }

            // en: check theme not is active
            if ($this->parm["data"] === $this->database->unvalid(BM_SETTINGS["bm_theme_active"])) {
                return $this->message->format("war", "Nie można usunąć aktywnego motywu.");
            }

            // en: check if theme is exist
            if (!$FSBM->isExistDir($this->parm["data"] . DIRECTORY_SEPARATOR)) {
                return $this->message->format("war", "Motyw nie istnieje.");
            }

            // en: delete theme and check error
            try {
                // check delete is success use function remove
                if ($FSBM->remove($this->parm["data"] . DIRECTORY_SEPARATOR, true, true, false)) {
                    // return success message
                    return $this->message->format("success", "Motyw został usunięty.");
                } else {
                    return $this->message->format("error", "Wystąpił błąd podczas usuwania motywu.");
                }
            } catch (\Exception $e) {
                return $this->message->format("error", "Wystąpił błąd podczas usuwania motywu. ");
            }

        }
    
        public function activation(){
            if (empty($this->parm["data"])) {
                return $this->message->format("error", "Brak danych wejśćiowych");
            }

            // sprawdzanie czy dane istnieją
            $t = strlen($this->parm["data"]);
            if ($t === 0) {
                return $this->message->format("war", "Błędne dane wejśćiowych.");
            }

            // valid this data
            (string) $a = $this->database->valid($this->parm["data"]);

            if ($this->database->update("UPDATE `bm_settings` SET `bm_value`= '". $a ."' WHERE `bm_name` LIKE 'bm_theme_active'")) {
                return $this->message->format("success", "Zaktulizowano dane!");
            } else {
               return $this->message->format("error", "Wystąpił błąd pod czas usuwania danych.");
            }
            
        }
        
    }
    