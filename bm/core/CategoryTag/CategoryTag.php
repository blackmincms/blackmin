<?php
    namespace BlackMin\CategoryTag;

    use BlackMin\Message\Message;

    class CategoryTag {

        private $database;
        private $action;
        private $parm;

        protected $Message;

        public function __construct (object $d ,String $a, array $t) {
            $this->database = $d;
            $this->action = $a;
            $this->parm = $t;

            $this->Message = new Message();
            
            return CategoryTag::parse();
        }

        public function parse(){
            if ($this->action == "get") {
                return CategoryTag::get();
            }elseif ($this->action == "del") {
                return CategoryTag::del();
            }else {
                return false;
            }           
        }
   
        public function get(){
            if (isset ($this->parm['KT'])){
                $KT = $this->parm['KT'];
            }else{
                $KT = "all";
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
            
            $KT = $this->database->valid($KT);
            $szukaj = $this->database->valid($szukaj);
            $ile_load = $this->database->valid($ile_load);
            
            $KT = ($KT == "all" ? "`bm_type` LIKE '%%'" : "`bm_type` LIKE '%". $KT ."%'");
            $szukaj = (strlen($szukaj) === 0 ? "(`bm_name` LIKE '%%' OR `bm_short_name` LIKE '%%' OR `bm_description` LIKE '%%')" : "(`bm_name` LIKE '%". $szukaj ."%' OR `bm_short_name` LIKE '%". $szukaj ."%' OR `bm_description` LIKE '%". $szukaj ."%')");
            $ile_load = ($ile_load < 0 ? 0 : $ile_load);
            // zapytanie do db
            $zap = $this->database->query2("SELECT * FROM `|prefix|bm_postmeta` WHERE $szukaj AND $KT ORDER BY `id_postmeta` DESC LIMIT $ile_load");

            return $zap;
        }

        public function del() {
            if (isset($this->parm["name"])) {
                if ($this->parm["name"] == "categorytag") {
                    if (isset($this->parm["content"])) {
                        // sprawdzanie czy dane są do usunięcja
                        $t = count($this->parm["content"]);
                        if ($t === 0) {
                            return $this->Message->format("info", "Brak danych do usunięcja.");
                                exit();
                        }else {
                            $a = $this->database->parse($this->parm["content"]);
                            $a = $this->database->valid($a);
                            // usuwanie danych
                            if ($this->database->delete("DELETE FROM `|prefix|bm_postmeta` WHERE `id_postmeta` IN (". $a .")")) {
                                return $this->Message->format("success", "Dane zostały usunięte!");
                                exit();
                            }else {
                                return $this->Message->format("error", "Wystąpił błąd pod czas usuwania danych.");
                                exit();
                            }
                        }
                    }else{
                        return $this->Message->format("info", "Brak danych do usunięcja.");
                        exit();
                    }
                }else{
                    return $this->Message->format("error", "Błędne danye wejśćiowye.");
                    exit();
                }
            } else {
                return $this->Message->format("war", "Brak danych wejśćiowych.");
                exit();
            }
        }

        public function set(){
            # code...
        }
        
    }
