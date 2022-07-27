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
        private $params;
    
        protected $message;
    
        public function __construct (Database $database ,string $action, array $params) {
            $this->database = $database;
            $this->action = $action;
            $this->params = $params;
    
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
                case 'update':
                    return $this->update();
                default:
                    return false;
            }
        }
    
        public function get(){
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
            if (empty($this->params["data"])) {
                return $this->message->format("error", "Brak danych wejśćiowych");
            }

            // sprawdzanie czy dane istnieją
            if (strlen($this->params["data"]) === 0) {
                return $this->message->format("war", "Błędne dane wejśćiowe.");
            }

            // en: create new FileSystemBM object
            $FSBM = new FileSystemBM("bm-content/themes/");

            // check FSBM error
            if ($FSBM->intErrorCode() !== 0) {
                return $this->message->format("error", "Wystąpił nie znany bład!");
            }

            // en: check theme not is active
            if ($this->params["data"] === $this->database->unvalid(BM_SETTINGS["bm_theme_active"])) {
                return $this->message->format("war", "Nie można usunąć aktywnego motywu.");
            }

            // en: check if theme is exist
            if (!$FSBM->isExistDir($this->params["data"] . DIRECTORY_SEPARATOR)) {
                return $this->message->format("war", "Motyw nie istnieje.");
            }

            // en: delete theme and check error
            try {
                // check delete is success use function remove
                if ($FSBM->remove($this->params["data"] . DIRECTORY_SEPARATOR, true, true, false)) {
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
            if (empty($this->params["data"])) {
                return $this->message->format("error", "Brak danych wejśćiowych");
            }

            // sprawdzanie czy dane istnieją
            $t = strlen($this->params["data"]);
            if ($t === 0) {
                return $this->message->format("war", "Błędne dane wejśćiowych.");
            }

            // valid this data
            (string) $a = $this->database->valid($this->params["data"]);

            if ($this->database->update("UPDATE `_prefix_bm_settings` SET `bm_value`= '". $a ."' WHERE `bm_name` LIKE 'bm_theme_active'")) {
                return $this->message->format("success", "Zaktulizowano dane!");
            } else {
               return $this->message->format("error", "Wystąpił błąd pod czas aktualizowania danych.");
            }
            
        }

        // en: update costumize theme 
        public function update(){
            // check data is empty
            if ((empty($this->params["background-theme"])) || (empty($this->params["color-font-theme"])) || (empty($this->params["color-font-link-theme"])) || (empty($this->params["color-font-link-hover-theme"])) || (empty($this->params["color-font-link-active-theme"])) || (empty($this->params["color-font-link-visited-theme"]))) {
                return $this->message->format("error", "Brak danych wejśćiowych");
            }
            // check data is string
            if ((!is_string($this->params["background-theme"])) || (!is_string($this->params["color-font-theme"])) || (!is_string($this->params["color-font-link-theme"])) || (!is_string($this->params["color-font-link-hover-theme"])) || (!is_string($this->params["color-font-link-active-theme"])) || (!is_string($this->params["color-font-link-visited-theme"]))) {
                return $this->message->format("war", "Błędny format danych.");
            }
            
            // check data is not strlen 0
            if ((strlen($this->params["background-theme"]) === 0) || (strlen($this->params["color-font-theme"]) === 0) || (strlen($this->params["color-font-link-theme"]) === 0) || (strlen($this->params["color-font-link-hover-theme"]) === 0) || (strlen($this->params["color-font-link-active-theme"]) === 0) || (strlen($this->params["color-font-link-visited-theme"]) === 0)) {
                return $this->message->format("war", "Podane dane są puste.");
            }

            // set data to variables
            (string) $background_theme = $this->params["background-theme"];
            (string) $color_font_theme = $this->params["color-font-theme"];
            (string) $color_font_link_theme = $this->params["color-font-link-theme"];
            (string) $color_font_link_hover_theme = $this->params["color-font-link-hover-theme"];
            (string) $color_font_link_active_theme = $this->params["color-font-link-active-theme"];
            (string) $color_font_link_visited_theme = $this->params["color-font-link-visited-theme"];

            // valid data
            (string) $background_theme = $this->database->valid($background_theme);
            (string) $color_font_theme = $this->database->valid($color_font_theme);
            (string) $color_font_link_theme = $this->database->valid($color_font_link_theme);
            (string) $color_font_link_hover_theme = $this->database->valid($color_font_link_hover_theme);
            (string) $color_font_link_active_theme = $this->database->valid($color_font_link_active_theme);
            (string) $color_font_link_visited_theme = $this->database->valid($color_font_link_visited_theme);

            // set data to object and serialize it
            $data = [
                "background-theme" => $background_theme,
                "color-font-theme" => $color_font_theme,
                "color-font-link-theme" => $color_font_link_theme,
                "color-font-link-hover-theme" => $color_font_link_hover_theme,
                "color-font-link-active-theme" => $color_font_link_active_theme,
                "color-font-link-visited-theme" => $color_font_link_visited_theme
            ];
            $data = $this->database->serialize($data);

            // set dataFile to file
            $dataFile = 
            '
/**
*	"Black Min" 
*	
*	For the full copyright and license information, please view the LICENSE
*	file that was distributed with this source code.
*
*	@package BlackMin
*	
*	#plik: 2.0
*
*	This file is designed to be used with BlackMin CMS.
*/
            
    html, body {
        background-color: '. $background_theme .';
        color: '. $color_font_theme .';
    }
    
    a {
        color: '. $color_font_link_theme .';
    }
    
    a::visited  {
        color: '. $color_font_link_visited_theme .';
    }

    a::active  {
        color: '. $color_font_link_active_theme .';
    }

    a::hover {
        color: '. $color_font_link_hover_theme .';
    }	
            ';


            // en: create new FileSystemBM object
            $FSBM = new FileSystemBM("bm-content/themes/");

            // save data to file
            if ($FSBM->saveFile("", "default-style-theme-blackmin.css", $dataFile, true)) {
                if ($this->database->update("UPDATE `_prefix_bm_settings` SET `bm_value`= '". $data ."' WHERE `bm_name` LIKE 'bm_customize_menu_style'")) {
                    return $this->message->format("success", "Zapisano dane poprawnie!");
                } else {
                   return $this->message->format("error", "Wystąpił błąd podczas zapisywania danych.");
                }
            } else {
                return $this->message->format("error", "Wystąpił błąd podczas zapisywania danych.");
            }
        }
    }
    