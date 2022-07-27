<?php

    namespace BlackMin\Menu;

    use BlackMin\Base\BaseInterface;
    use BlackMin\Database\Database;
    use BlackMin\Message\Message;

    final class Menu implements BaseInterface {

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

        public function __construct(Database $database, string $action, array $params) {
            $this->database = $database;
            $this->action = $action;
            $this->params = $params;

            $this->message = new Message();
        }

        public function parse() {
            switch ($this->action) {
                case 'add':
                    return $this->add();
                case 'get':
                    return $this->get();
                case 'del':
                    return $this->delete();
                case 'update':
                    return $this->update();
                case 'rename':
                    return $this->rename();
                default:
                    return false;
            }
        }

        public function get() {
            // get menu from bm_settings array table and return it

            $zap = $this->database->query("SELECT * FROM `_prefix_bm_meta` WHERE `bm_parent` LIKE 'menu'");

            if (!$zap) {
                return $this->message->format("error", "Wystąpił błąd podczas pobierania danych!");
            }

            if (!isset(BM_SETTINGS["bm_menu_structur"])) {
                return $this->message->format("error", "Nie znaleziono struktury menu!");
            }

            // remove num_rows from zap
            unset($zap["num_rows"]);

            $bm_menu_structur = [
                "bm_menu_structur" => $this->database->unserialize(BM_SETTINGS["bm_menu_structur"]),
                "bm_menu_items" => $zap
            ];

            return $bm_menu_structur;
        }

        public function update() {
            // update menu in bm_settings array table and return it
            if (!isset($this->params['bm_menu_structur'])) {
                // return error if no menu data
                return $this->message->format('error', 'Brak danych do zapisania');
            };

            $bm_menu_structur = $this->database->serialize($this->params['bm_menu_structur']);

            // save data menu to database
            if ($this->database->update("UPDATE `_prefix_bm_settings` SET `bm_value` = '$bm_menu_structur' WHERE `bm_name` = 'bm_menu_structur'")) {
                // return message
                return $this->message->format("success", "Menu Zostało zaktualizowane");
            }

            // return error message
            return $this->message->format("error", "Menu Nie zostało zaktualizowane");
        }

        public function add() {
            // add menu to bm_settings array table and return it
            if (!isset($this->params['url']) && !isset($this->params['title'])) {
                // return error if no menu data
                return $this->message->format('error', 'Brak danych do zapisania');
            };

            // get data from params
            $url = $this->params['url'];
            $title = $this->params['title'];

            // parse data usinx parse_url()
            $url_parsed = parse_url($url);

            // if all url is not valid
            if (!isset($url_parsed['host']) || !isset($url_parsed['path'])) {
                return $this->message->format('info', 'Nieprawidłowy adres URL');
            }

            // check if url is not sentized valid use FILTER_SANITIZE_URL
            if (filter_var($url, FILTER_VALIDATE_URL) !== $url) {
                return $this->message->format('info', 'Nie dozwolony znak w adresie URL');
            }

            // validate url
            $url = $this->database->valid($url);
            // validate title
            $title = $this->database->valid($title);

            // bulid menu item structure
            $bm_menu_item = json_encode([$title, $url, "link"]);

            // save data menu to database
            if ($this->database->insert("INSERT INTO `_prefix_bm_meta` (`id_meta`, `bm_parent`, `bm_name`, `bm_value`) VALUES (NULL, 'menu', 'new_menu_item', '$bm_menu_item')")) {
                // return message
                return $this->message->format("success", "Menu Zostało zaktualizowane");
            }

            // return error message
            return $this->message->format("error", "Menu Nie zostało zaktualizowane");
        }
        
        // rename menu item
        public function rename() {
            if (!isset($this->params['id']) || !isset($this->params['url']) || !isset($this->params['title'])) {
                // return error if no menu data
                return $this->message->format('error', 'Brak danych do zapisania');
            };

            // get data from params
            $id = $this->params['id'];
            $url = $this->params['url'];
            $title = $this->params['title'];

            // parse data usinx parse_url()
            $url_parsed = parse_url($url);

            // if all url is not valid
            if (!isset($url_parsed['host']) || !isset($url_parsed['path'])) {
                return $this->message->format('info', 'Nieprawidłowy adres URL');
            }

            // check if url is not sentized valid use FILTER_SANITIZE_URL
            if (filter_var($url, FILTER_VALIDATE_URL) !== $url) {
                return $this->message->format('info', 'Nie dozwolony znak w adresie URL');
            }

            // valid id
            $id = $this->database->valid($id);
            // valid url
            $url = $this->database->valid($url);
            // valid title
            $title = $this->database->valid($title);

            // bulid menu item structure
            $bm_menu_item = json_encode([$title, $url, "link"]);

            // save data menu to database
            if ($this->database->update("UPDATE `_prefix_bm_meta` SET `bm_value` = '$bm_menu_item' WHERE `id_meta` = '$id'")) {
                // return message
                return $this->message->format("success", "Przedmiot Menu Został zaktualizowany");
            }

            // return error message
            return $this->message->format("error", "Przedmiot Menu Nie został zaktualizowany!");
        }

        // delete menu item
        public function delete() {
            if (!isset($this->params['id'])) {
                // return error if no menu data
                return $this->message->format('war', 'Brak danych do usunięcia');
            };

            // get data from params
            $id = $this->params['id'];

            // valid id
            $id = $this->database->valid($id);

            // save data menu to database
            if ($this->database->delete("DELETE FROM `_prefix_bm_meta` WHERE `id_meta` = '$id'")) {
                // return message
                return $this->message->format("success", "Przedmiot Menu Został usunięty");
            }

            // return error message
            return $this->message->format("error", "Przedmiot Menu Nie został usunięty!");
        }
    }
