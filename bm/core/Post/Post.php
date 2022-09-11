<?php
    namespace BlackMin\Post;

    use BlackMin\Base\BaseInterface;
    use BlackMin\Database\Database;
    use BlackMin\Message\Message;
    
    final class Post implements BaseInterface {
    
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
                case 'add':
                    return $this->add();
                case 'update':
                    return $this->edit();
                default:
                    return false;
            }
        }
    
        public function get(){
            if ((isset($this->params['id'])) || isset($this->params['url'])) {          
                // filtrowanie danych
                if (isset($this->params['id'])) {
                    $id = "`id_post` = '". $this->database->valid($this->params['id']) ."'";
                }
                if (isset($this->params['url'])) {
                    $id = "`url` = '". $this->database->valid($this->params['url']) ."'";
                }
                

                // check param is int

                if ((is_int($id)) || (is_string($id))) {
                    // zapytanie do db
                    $zap = $this->database->query("SELECT `|prefix|bm_posts`.*, `|prefix|bm_posts`.`|prefix|author` as 'id_author' , `|prefix|bm_users`.`nick` as 'authores' FROM `|prefix|bm_posts` LEFT JOIN `|prefix|bm_users` ON `|prefix|bm_posts`.`author` = `|prefix|bm_users`.`id` WHERE $id LIMIT 1");
                    if ($zap["num_rows"] !== 0) {
                        $zap[0]["thumbnail"] = $this->database->unserialize($zap[0]["thumbnail"]);
                       $zap[0]["content"] = $this->database->unvalid($zap[0]["content"]);
                    }
                } else {
                    $zap = $this->Message->format("war", "Wprowadzone dane nie są liczbą");
                }

                return $zap;
            }

            if (isset ($this->params['typ'])){
                $typ = $this->params['typ'];
            }else{
                $typ = "all";
            }
    
            if (isset ($this->params['status'])){
                $status = $this->params['status'];
            }else {
                $status = "all";
            }
    
            if (isset ($this->params['ile_load'])){
                $ile_load = $this->params['ile_load'];
            }else if (isset ($this->params['max'])){
                $ile_load = $this->params['max'];
            }else {
                $ile_load = "25";
            }
    
            if (isset ($this->params['szukaj'])){
                $szukaj = $this->params['szukaj'];
            }else{
                $szukaj = "";
            }

            if (isset($this->params['search'])) {
                $search = $this->params['search'];
            }
    
            // filtrowanie danych
    
            $typ = $this->database->valid($typ);
            $status = $this->database->valid($status);
            $szukaj = $this->database->valid($szukaj);
            $ile_load = $this->database->valid($ile_load);
    
            $typ = ($typ === "all" ? "`type` LIKE '%%'" : "`type` LIKE '%". $typ ."%'");
            $status = ($status === "all" ? "(`status`LIKE 'public' OR `status`LIKE 'protect_password' OR `status`LIKE 'private')" : "`status` LIKE '%". $status ."%'");
            $szukaj = (strlen($szukaj) === 0 ? "(`title` LIKE '%%' OR `url` LIKE '%%')" : "(`title` LIKE '%". $szukaj ."%' OR `url` LIKE '%". $szukaj ."%')");
            $ile_load = ($ile_load < 0 ? 0 : $ile_load);
            // zapytanie do db
            $zap = $this->database->query2("SELECT `|prefix|bm_posts`.*, `|prefix|bm_posts`.`|prefix|author` as 'id_author' , `|prefix|bm_users`.`nick` as 'authores' FROM `|prefix|bm_posts` LEFT JOIN `|prefix|bm_users` ON `|prefix|bm_posts`.`author` = `|prefix|bm_users`.`id` WHERE $szukaj AND $typ AND $status ORDER BY `id_post` DESC LIMIT $ile_load");

            for ($i=0; $i < $zap["num_rows"]; $i++) { 
                $zap[$i]["thumbnail"] = (($zap[$i]["thumbnail"] === "null") ? $zap[$i]["thumbnail"] : $this->database->unserialize($zap[$i]["thumbnail"]));
                $zap[$i]["content"] = $this->database->unvalid($zap[$i]["content"]);
            }
    
            return $zap;
        }
    
        public function del() {
            if (isset($this->params["name"])) {
                if ($this->params["name"] === "post") {
                    if (isset($this->params["content"])) {
                        // sprawdzanie czy dane są do usunięcja
                        $t = count($this->params["content"]);
                        if ($t === 0) {
                            return $this->message->format("info", "Brak danych do usunięcja.");
                        }else {
                            $a = $this->database->parse($this->params["content"]);
                            $a = $this->database->valid($a);
                            // usuwanie danych
                            if ($this->database->delete("DELETE FROM `|prefix|bm_posts` WHERE `id_post` IN (". $a .")")) {
                                return $this->message->format("success", "Dane zostały usunięte!");
                            }else {
                                return $this->message->format("error", "Wystąpił błąd pod czas usuwania danych.");
                            }
                        }
                    }else{
                        return $this->message->format("info", "Brak danych do usunięcja.");
                    }
                }else{
                    return $this->message->format("error", "Błędne danye wejśćiowye.");
                }
            } else {
                return $this->message->format("war", "Brak danych wejśćiowych.");
            }
        }
    
        public function add(){
            // heck if is params
            if (!isset($this->params) || count($this->params) === 0) {
                return $this->message->format("error", "Brak danych wejśćiowych!");
            }
            // check if all params
            if (count($this->params) <= 12) {
                return $this->message->format("war", "Brak wymaganych danych!");
            }

            // get data from params
            $title = $this->params["title"];
            $url = $this->params["url"];
            $status = $this->params["status"];
            $password = $this->params["password"];
            $type = $this->params["type"];
            $category = $this->params["category"];
            $tag = $this->params["tag"];
            $aquay_formatted = $this->params["aquay_formatted"];
            $src = $this->params["src"];
            $src_orginal = $this->params["src-orginal"];
            $titleM = $this->params["titleM"];
            $title_orginal = $this->params["title-orginal"];

            // valid data
            $title = $this->database->valid($title);
            $url = $this->database->valid($url);
            $status = $this->database->valid($status);
            $password = $this->database->valid($password);
            $type = $this->database->valid($type);
            $category = $this->database->valid($category);
            $tag = $this->database->valid($tag);
            $aquay_formatted = $this->database->valid($aquay_formatted);
            $src = $this->database->valid($src);
            $src_orginal = $this->database->valid($src_orginal);
            $titleM = $this->database->valid($titleM);
            $title_orginal = $this->database->valid($title_orginal);

            // check data is corrent
            if (strlen($title) <= 3) {
                return $this->message->format("info", "Tytuł musi być dłuższy (min 4)");
            }
            if (strlen($url) <= 3) {
                return $this->message->format("info", "Url musi być dłuższy (min 4)");
            }
            if (strlen($status) <= 3) {
                return $this->message->format("info", "Status musi być dłuższy (min 4)");
            }
            if($status !== "protect_password") {
                $haslo = "";
            }
            if (strlen($type) <= 1) {
                return $this->message->format("info", "Typ musi być dłuższy (min 1)");
            }
            if (strlen($category) === 0) {
                $category = "default";
            }
            if (strlen($aquay_formatted) <= 0) {
                return $this->message->format("info", "Kontent musi być dłuższy!");
            }
            // check aquay_formatted
            if (!strpos($aquay_formatted, "aquay_formatted")) {
                return $this->message->format("error", "Kontent został uszkodzony!");
            }

            // Remove all illegal characters from a url
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // check url
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                // return $this->message->format("war", "URL zawiera niedozwolone znaki!");
            }

            // replace litter
            $url = str_replace(" ", "-", $url);

            // check url is not exits
            if ($url_check = $this->database->query2(sprintf("SELECT * FROM `_prefix_bm_posts` WHERE `url` LIKE '%s'", $url))) {
                if ($url_check["num_rows"] > 0) {
                    return $this->message->format("info", "Podane URL już istnieje!");
                }
            }

            $thunbail = $this->database->serialize(["src" => $src, "src_orginal" => $src_orginal, "title" => $titleM, "title_orginal" => $title_orginal]);

            // get datetime
            $datetime = date("Y-m-d H:i");

            // add post to db
            if ($this->database->insert("INSERT INTO `|prefix|bm_posts`(`id_post`, `author`, `title`, `url`, `content`, `type`, `category`, `status`, `tag`, `password`, `editing`, `visit`, `comment`, `thumbnail`, `datetime`, `datetime_change`) VALUES (NULL, '". $_SESSION["id"] ."', '$title', '$url', '$aquay_formatted', '$type', '$category', '$status', '$tag', '$password', 0, 0, 'false', '$thunbail', '$datetime', '$datetime')")) {
                return $this->message->format("success", "Post został dodany poprawnie!");
            }

            return $this->message->format("error", "Wystąpił błąd pod czas dodawanie posta!");
        }
        
        public function edit(){
            // heck if is params
            if (!isset($this->params) || count($this->params) === 0) {
                return $this->message->format("error", "Brak danych wejśćiowych!");
            }
            // check if all params
            if (count($this->params) <= 13) {
                return $this->message->format("war", "Brak wymaganych danych!");
            }

            if (!isset ($this->params['id'])){
                return $this->message->format("war", "Brak id objektu do edycji!");
            }

            // get data from params
            $title = $this->params["title"];
            $url = $this->params["url"];
            $status = $this->params["status"];
            $password = $this->params["password"];
            $type = $this->params["type"];
            $category = $this->params["category"];
            $tag = $this->params["tag"];
            $aquay_formatted = $this->params["aquay_formatted"];
            $src = $this->params["src"];
            $src_orginal = $this->params["src-orginal"];
            $titleM = $this->params["titleM"];
            $title_orginal = $this->params["title-orginal"];
            $id = $this->params['id'];
            

            // valid data
            $title = $this->database->valid($title);
            $url = $this->database->valid($url);
            $status = $this->database->valid($status);
            $password = $this->database->valid($password);
            $type = $this->database->valid($type);
            $category = $this->database->valid($category);
            $tag = $this->database->valid($tag);
            $aquay_formatted = $this->database->valid($aquay_formatted);
            $src = $this->database->valid($src);
            $src_orginal = $this->database->valid($src_orginal);
            $titleM = $this->database->valid($titleM);
            $title_orginal = $this->database->valid($title_orginal);
            $id = $this->database->valid($id);

            // check data is corrent
            if (strlen($title) <= 3) {
                return $this->message->format("info", "Tytuł musi być dłuższy (min 4)");
            }
            if (strlen($url) <= 3) {
                return $this->message->format("info", "Url musi być dłuższy (min 4)");
            }
            if (strlen($status) <= 3) {
                return $this->message->format("info", "Status musi być dłuższy (min 4)");
            }
            if($status !== "protect_password") {
                $haslo = "";
            }
            if (strlen($type) <= 1) {
                return $this->message->format("info", "Typ musi być dłuższy (min 1)");
            }
            if (strlen($category) === 0) {
                $category = "default";
            }
            if (strlen($aquay_formatted) <= 0) {
                return $this->message->format("info", "Kontent musi być dłuższy!");
            }
            // check aquay_formatted
            if (!strpos($aquay_formatted, "aquay_formatted")) {
                return $this->message->format("error", "Kontent został uszkodzony!");
            }

            // Remove all illegal characters from a url
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // check url
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                // return $this->message->format("war", "URL zawiera niedozwolone znaki!");
            }

            // replace litter
            $url = str_replace(" ", "-", $url);

            // get post data
            $post_data = $this->database->query(sprintf("SELECT `title`,`url`,`id_post` FROM `|prefix|bm_posts` WHERE `id_post` = %d LIMIT 1", $id));
            if ($post_data["num_rows"] !== 1) {
                return $this->message->format("error", "Brak posta do edycji!");
            }

            // check if same url
            if ($post_data[0]["url"] !== $url) {
                // check url is not exits
                if ($url_check = $this->database->query2(sprintf("SELECT * FROM `_prefix_bm_posts` WHERE `url` LIKE '%s'", $url))) {
                    if ($url_check["num_rows"] > 0) {
                        return $this->message->format("info", "Podane URL już istnieje!");
                    }
                }
            }

            $thunbail = $this->database->serialize(["src" => $src, "src_orginal" => $src_orginal, "title" => $titleM, "title_orginal" => $title_orginal]);

            // check if data not changet
            if ($is_same = $this->database->query2("SELECT `title`, `url`, `content`, `type`, `category`, `status`, `tag`, `password`, `thumbnail` FROM `|prefix|bm_posts` WHERE `title` LIKE '$title' AND `url` LIKE '$url' AND `content` LIKE '$aquay_formatted' AND `type` LIKE '$type' AND `category` LIKE '$category' AND `status` LIKE '$status' AND `tag` LIKE '$tag' AND `password` LIKE '$password' AND `thumbnail` LIKE '$thunbail'")) {
                if ($is_same["num_rows"] >= 1) {
                    return $this->message->format("info", "dane się nie zmieniły!");
                }
            }

            // get datetime
            $datetime = date("Y-m-d H:i");

            // add post to db
            if ($this->database->update("UPDATE `|prefix|bm_posts` SET `author`= '". $_SESSION['id'] ."', `title` = '$title', `url` = '$url', `content` = '$aquay_formatted', `type` = '$type', `category` = '$category', `status` = '$status', `tag` = '$tag', `password` = '$password', `editing`= `editing` + 1 , `thumbnail`= '$thunbail', `datetime_change`= '$datetime' WHERE `id_post` = $id")) {
                return $this->message->format("success", "Post został edytowany poprawnie!");
            }

            return $this->message->format("error", "Wystąpił błąd pod czas edytowania posta!");
        }
    }
    