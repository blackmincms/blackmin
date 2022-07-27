<?php

    namespace BlackMin\Widget;

    use BlackMin\Base\BaseInterface;
    use BlackMin\Database\Database;
    use BlackMin\Message\Message;

    final class Widget implements BaseInterface {

        /**
         * @var Database
          */
        private $database;
        /**
         * @var string
          */
        private $action;
        /**
         * @var array
          */
        private $params;
        /**
         * @var Message
          */
        private $message;

        // crate instance with action and params
        public function __construct(Database $database, string $action, array $params) {
            $this->database = $database;
            $this->action = $action;
            $this->params = $params;

            $this->message = new Message();
        }

        // parse action and params
        public function parse() {
            switch ($this->action) {
                case 'get':
                    return $this->get();
                case 'update':
                    return $this->update();
                default:
                    return false;
            }
        }

        // get widget
        public function get () {
            // get widget from bm_settings array table and return it

            $out = [
                "bm_top_widget" => (isset(BM_SETTINGS["bm_top_widget"]) ? $this->database->unserialize(BM_SETTINGS['bm_top_widget']) : NULL),
                "bm_left_widget" => (isset(BM_SETTINGS["bm_left_widget"]) ? $this->database->unserialize(BM_SETTINGS['bm_left_widget']) : NULL),
                "bm_right_widget" => (isset(BM_SETTINGS["bm_right_widget"]) ? $this->database->unserialize(BM_SETTINGS['bm_right_widget']) : NULL),
                "bm_bottom_widget" => (isset(BM_SETTINGS["bm_bottom_widget"]) ? $this->database->unserialize(BM_SETTINGS['bm_bottom_widget']) : NULL),
                "bm_footer_widget" => (isset(BM_SETTINGS["bm_footer_widget"]) ? $this->database->unserialize(BM_SETTINGS['bm_footer_widget']) : NULL),
            ];

            return $out;
    
        }

        // update widget
        public function update () {
            // check if all params are set
            if (!key_exists("bm_top_widget", $this->params) && !key_exists("bm_left_widget", $this->params) && !key_exists("bm_right_widget", $this->params) && !key_exists("bm_bottom_widget", $this->params) && !key_exists("bm_footer_widget", $this->params)) {
                // return error message
                return $this->message->format("war" ,"Nie wszystkie parametry są ustawione.");
            }

            // print data to variable and serialize it
            $bm_top_widget = $this->parseWidgetData("bm_top_widget");
            $bm_left_widget = $this->parseWidgetData("bm_left_widget");
            $bm_right_widget = $this->parseWidgetData("bm_right_widget");
            $bm_bottom_widget = $this->parseWidgetData("bm_bottom_widget");
            $bm_footer_widget = $this->parseWidgetData("bm_footer_widget");

            // serialize data to database
            $bm_top_widget = $this->database->serialize($bm_top_widget);
            $bm_left_widget = $this->database->serialize($bm_left_widget);
            $bm_right_widget = $this->database->serialize($bm_right_widget);
            $bm_bottom_widget = $this->database->serialize($bm_bottom_widget);
            $bm_footer_widget = $this->database->serialize($bm_footer_widget);                

            if ($this->database->update("UPDATE `_prefix_bm_settings` 
            SET `bm_value` = CASE `bm_name` 
            WHEN 'bm_top_widget' THEN '$bm_top_widget' 
            WHEN 'bm_left_widget' THEN '$bm_left_widget' 
            WHEN 'bm_right_widget' THEN '$bm_right_widget' 
            WHEN 'bm_bottom_widget' THEN '$bm_bottom_widget' 
            WHEN 'bm_footer_widget' THEN '$bm_footer_widget' 
            END WHERE `bm_name` IN ('bm_top_widget', 'bm_left_widget', 'bm_right_widget', 'bm_bottom_widget', 'bm_footer_widget')")) {
                // return success message
                return $this->message->format("success" ,"Widget został zaktualizowany.");
            } else {
                // return error message
                return $this->message->format("error" ,"Widget nie został zaktualizowany.");
            }            
    
        }

        // protected function parse_widget_data ($widget_data)
        protected function parseWidgetData (string $widget_name) {
            // parse widget data
            $widget1 = json_decode($this->params[$widget_name], true);
            $widget2 = json_decode($this->params[$widget_name . 2], true);
            
            $out = [];

            $ile = count($widget1);
            if($ile === 0){
                return [];
            }else{
                for($i = 0; $i < $ile; $i++){
                    // filtrowanie danych
                    $title = $this->database->valid($widget1[$i]["title"]);
                    $id = $this->database->valid($widget2[$i]["id"]);
                    // tablica przechowywująca dane o pluginie
                    $data = [
                        "name_full" => $title,
                        "name" => $id,
                    ];
                    // dodawanie danych do tablicy już pogrupowane
                    array_push($out, $data);
                }				
            }

            return $out;
        }

    }