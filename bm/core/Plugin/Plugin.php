<?php
    // Path: bm\core\Plugins\Plugin.php

    namespace BlackMin\Plugin;

    use BlackMin\Base\BaseInterface;
    use BlackMin\Database\Database;
    use BlackMin\Message\Message;
    use BlackMin\FileSystem\FileSystemBM;

    final class Plugin implements BaseInterface {

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
                case 'add':
                    return $this->add();
                case 'get':
                    return $this->get();
                case 'del':
                    return $this->delete();
                case 'activation':
                    return $this->activate();
                case 'deactivation':
                    return $this->deactivate();
                default:
                    return false;
            }
        }

        // add plugin
        public function add() {
            // add plugin to bm_settings array table and return it

            $zap = $this->database->query("SELECT * FROM `_prefix_bm_meta` WHERE `bm_parent` LIKE 'plugin'");

            if (!$zap) {
                return $this->message->format("error", "Wystąpił błąd podczas pobierania danych!");
            }
        }

        // get plugin
        public function get() {
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

            $FSBM = new FileSystemBM("bm-content/plugins/");
            // check FSBM error
            if ($FSBM->intErrorCode() !== 0) {
                return $this->message->format("error", "Wystąpił nie znany bład!");
            }

            $scan = $FSBM->scan("{thumbnail,package}.{png,bmp,jpeg,jpg,gif,json}", "", 2, false, GLOB_BRACE);
            // check FSBM error
            if ($FSBM->intErrorCode() !== 0) {
                return $this->message->format("war", "Wystąpił błąd pod czas pobierania wgranych Motywów");
            }

            // get bm_plugin from bm_settings array table and return it
            $bm_plugin = (isset(BM_SETTINGS["bm_plugin"])) ? BM_SETTINGS["bm_plugin"] : null;

            // if plugin not found
            if (is_null($bm_plugin)) {
                return $this->message->format("error", "Nie znaleziono struktury pluginu!");
            }

            // unserialize plugin
            $bm_plugin = $this->database->unserialize($bm_plugin);

            // if plugin not unserialized
            if (!is_array($bm_plugin)) {
                return $this->message->format("error", "Nie udało się odczytać struktury pluginu!");
            }

            // add key active to active theme
            foreach ($scan as $key => $value) {
                // if plugin is active
                foreach ($bm_plugin as $key2 => $value2) {
                    if ($this->database->unvalid($value2["name"]) === $this->database->unvalid($value["name"])) {
                        $scan[$key]["active"] = true;
                    }
                }
            }
            return $scan;

        }

        // delete plugin
        public function delete() {
            // delete plugin from bm_settings array table and return it
            
            try {
                if (is_array($this->deactivate())) {
                    $FSBM = new FileSystemBM("bm-content/plugins/");
                    // check FSBM error
                    if ($FSBM->intErrorCode() !== 0) {
                        return $this->message->format("error", "Wystąpił nie znany bład!");
                    }

                     // check delete is success use function remove
                    if ($FSBM->remove($this->params["data"] . DIRECTORY_SEPARATOR, true, true, false)) {
                        // return success message
                        return $this->message->format("success", "Motyw został usunięty.");
                    } else {
                        return $this->message->format("error", "Wystąpił błąd podczas usuwania pluginu.");
                    }
                }

                // return error message
                return $this->message->format("error", "Nie udało się usunąć pluginu!");
            } catch (\Throwable $th) {
                throw $th;
            }
            
        }

        // activate plugin
        public function activate() {
            // activate plugin in bm_settings array table and return it

            // check data is set
            if (!isset($this->params['data'])) {
                return $this->message->format("info", "Nie podano nazwy pluginu!");
            }

            // valid name
            $name = $this->database->valid($this->params['data']);

            // get bm_plugin from bm_settings array table and return it
            $bm_plugin = (isset(BM_SETTINGS["bm_plugin"])) ? BM_SETTINGS["bm_plugin"] : null;

            // if plugin not found
            if (is_null($bm_plugin)) {
                return $this->message->format("error", "Nie znaleziono struktury pluginu!");
            }

            // unserialize plugin
            $bm_plugin = $this->database->unserialize($bm_plugin);

            // if plugin not unserialized
            if (!is_array($bm_plugin)) {
                return $this->message->format("error", "Nie udało się odczytać struktury pluginu!");
            }

            // check if plugin is already active
            foreach ($bm_plugin as $key => $value) {
                if ($value["name"] == $name) {
                    return $this->message->format("info", "Plugin jest już aktywny!");
                }
            }

            // add key active to bm_plugin
            array_push($bm_plugin, array("name" => $name));

            // serialize bm_plugin
            $bm_plugin = $this->database->serialize($bm_plugin);

            // update bm_plugin in bm_settings array table and return it
            $zap = $this->database->update("UPDATE `_prefix_bm_settings` SET `bm_value` = '$bm_plugin' WHERE `bm_name` LIKE 'bm_plugin'");

            // check if update was successful and error
            if (!$zap) {
                return $this->message->format("error", "Wystąpił błąd podczas aktualizacji danych!");
            }

            return $this->message->format("success", "Plugin został aktywowany!");
        }

        // deactivate plugin
        public function deactivate() {
            // deactivate plugin in bm_settings array table and return it

            // check data is set
            if (!isset($this->params['data'])) {
                return $this->message->format("info", "Nie podano nazwy pluginu!");
            }

            // valid name
            $name = $this->database->valid($this->params['data']);

            // get bm_plugin from bm_settings array table and return it
            $bm_plugin = (isset(BM_SETTINGS["bm_plugin"])) ? BM_SETTINGS["bm_plugin"] : null;

            // if plugin not found
            if (is_null($bm_plugin)) {
                return $this->message->format("error", "Nie znaleziono struktury pluginu!");
            }

            // unserialize plugin
            $bm_plugin = $this->database->unserialize($bm_plugin);

            // if plugin not unserialized
            if (!is_array($bm_plugin)) {
                return $this->message->format("error", "Nie udało się odczytać struktury pluginu!");
            }

            // check if plugin is already active
            foreach ($bm_plugin as $key => $value) {
                if ($value["name"] == $name) {
                    unset($bm_plugin[$key]);
                }
            }

            // serialize bm_plugin
            $bm_plugin = $this->database->serialize($bm_plugin);

            // update bm_plugin in bm_settings array table and return it
            $zap = $this->database->update("UPDATE `_prefix_bm_settings` SET `bm_value` = '$bm_plugin' WHERE `bm_name` LIKE 'bm_plugin'");

            // check if update was successful and error
            if (!$zap) {
                return $this->message->format("error", "Wystąpił błąd podczas aktualizacji danych!");

            // if plugin not found
            } elseif (is_null($bm_plugin)) {
                return $this->message->format("error", "Nie znaleziono struktury pluginu!");
            }

            return $this->message->format("success", "Plugin został deaktywowany!");

        }

    }
