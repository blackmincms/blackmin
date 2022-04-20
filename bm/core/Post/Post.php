<?php
namespace BlackMin\Post;

use BlackMin\Base\BaseInterface;
use BlackMin\Database\Database;
use BlackMin\Message\Message;

class Post implements BaseInterface {

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
            default:
                return false;
        }
    }

    public function get(){
        if (isset ($this->parm['typ'])){
            $typ = $this->parm['typ'];
        }else{
            $typ = "all";
        }

        if (isset ($this->parm['status'])){
            $status = $this->parm['status'];
        }else {
            $status = "all";
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

        // // filtrowanie danych

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

        return $zap;
    }

    public function del() {
        if (isset($this->parm["name"])) {
            if ($this->parm["name"] === "post") {
                if (isset($this->parm["content"])) {
                    // sprawdzanie czy dane są do usunięcja
                    $t = count($this->parm["content"]);
                    if ($t === 0) {
                        return $this->message->format("info", "Brak danych do usunięcja.");
                    }else {
                        $a = $this->database->parse($this->parm["content"]);
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

    public function set(){
        return $this->message->format("info", "TODO");
    }
}
