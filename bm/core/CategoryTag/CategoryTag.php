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
        }

        public function parse(){
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
            if (isset($this->parm['id'])) {          
                // filtrowanie danych
                $id = $this->database->valid($this->parm['id']);

                // check param is int

                if ((is_int($id)) || (is_string($id))) {
                    // zapytanie do db
                    $zap = $this->database->query("SELECT * FROM `|prefix|bm_postmeta` WHERE `id_postmeta` = '$id' LIMIT 1");
                } else {
                    $zap = $this->Message->format("war", "Wprowadzone dane nie są liczbą");
                }
            } else {
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
            }
            
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

        public function add(){
            if (isset($this->parm["tytul"])) {
                // zmianna raportująca o błędach
                $ad_ok = true;
                if (isset ($this->parm['tytul'])){
                    $tytul = $this->parm['tytul'];
                }else{
                    $ad_ok = false;
                }
                
                if (isset ($this->parm['tytul_skrucony'])){
                    $tytul_skrucony = $this->parm['tytul_skrucony'];
                }else {
                    $ad_ok = false;
                }
                
                if (isset ($this->parm['kategoria'])){
                    $kategoria =$this->parm['kategoria'];
                }else{
                    $ad_ok = false;
                }
                
                if (isset ($this->parm['opis'])){
                    $opis = $this->parm['opis'];
                }else{
                    $ad_ok = false;
                }
        
                if ($ad_ok) {
                    if ((strlen($tytul)<1) || (strlen($tytul)>4096))
                    {
                        $ad_ok = false;
                    }
                    
                    if ((strlen($tytul_skrucony )<1) || (strlen($tytul_skrucony )>4096))
                    {
                        $ad_ok = false;
                    }
                    
                    if ((strlen($kategoria)<1) || (strlen($kategoria)>4096))
                    {
                        $ad_ok = false;
                    }
                    
                    if ((strlen($opis )<0) || (strlen($opis )>4096))
                    {
                        $ad_ok = false;
                    }
        
                    if ($ad_ok) {
                        $tytul = $this->database->valid($tytul);
                        $tytul_skrucony = $this->database->valid($tytul_skrucony);
                        $kategoria = $this->database->valid($kategoria);
                        $opis = $this->database->valid($opis);
        
                        $zap = $this->database->query("SELECT * FROM `|prefix|bm_postmeta` WHERE `bm_name` LIKE '$tytul' AND `bm_short_name` LIKE '$tytul_skrucony' AND `bm_description` LIKE '$opis' AND `bm_type` LIKE '$kategoria'");
                        // var_dump($zap);
                        if ($zap["num_rows"] === 0) {
                            // usuwanie danych
                            if ($this->database->insert("INSERT INTO `|prefix|bm_postmeta` VALUES (NULL, '$tytul', '$tytul_skrucony', '$opis', '$kategoria')")) {
                                return $this->Message->format("success", "Dane zostały dodane!");
                                exit();
                            }else {
                                return $this->Message->format("error", "Wystąpił błąd pod czas dodawania danych.");
                                exit();
                            }
                        } else {
                            return $this->Message->format("info", "Takie dane już istnieją!");
                            exit();
                        }
                    } else {
                        return $this->Message->format("info", "Wprowadzone dane są za krótkie lub długie.");
                        exit();
                    }
                    
                }else{
                    return $this->Message->format("info", "Brak danych do dodania.");
                    exit();
                }
            } else {
                return $this->Message->format("error", "Brak danych wejśćiowych.");
                exit();
            }
        }
        
        public function edit (){
            if (isset($this->parm["tytul"])) {
                // zmianna raportująca o błędach
                $ad_ok = true;
                if (isset ($this->parm['tytul'])){
                    $tytul = $this->parm['tytul'];
                }else{
                    $ad_ok = false;
                }
                
                if (isset ($this->parm['tytul_skrucony'])){
                    $tytul_skrucony = $this->parm['tytul_skrucony'];
                }else {
                    $ad_ok = false;
                }
                
                if (isset ($this->parm['kategoria'])){
                    $kategoria =$this->parm['kategoria'];
                }else{
                    $ad_ok = false;
                }
                
                if (isset ($this->parm['opis'])){
                    $opis = $this->parm['opis'];
                }else{
                    $ad_ok = false;
                }
                
                if (isset ($this->parm['id'])){
                    $id = $this->parm['id'];
                }else{
                    $ad_ok = false;
                }
        
                if ($ad_ok) {
                    if ((strlen($tytul)<1) || (strlen($tytul)>4096))
                    {
                        $ad_ok = false;
                    }
                    
                    if ((strlen($tytul_skrucony )<1) || (strlen($tytul_skrucony )>4096))
                    {
                        $ad_ok = false;
                    }
                    
                    if ((strlen($kategoria)<1) || (strlen($kategoria)>4096))
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
                        $tytul = $this->database->valid($tytul);
                        $tytul_skrucony = $this->database->valid($tytul_skrucony);
                        $kategoria = $this->database->valid($kategoria);
                        $opis = $this->database->valid($opis);
        
                        $zap = $this->database->query("SELECT * FROM `|prefix|bm_postmeta` WHERE `bm_name` LIKE '$tytul' AND `bm_short_name` LIKE '$tytul_skrucony' AND `bm_description` LIKE '$opis' AND `bm_type` LIKE '$kategoria'");
                        // var_dump($zap);
                        if ($zap["num_rows"] === 0) {
                            // usuwanie danych
                            if ($this->database->update("UPDATE |prefix|`bm_postmeta` SET `bm_name`= '$tytul', `bm_short_name`= '$tytul_skrucony', `bm_description`= '$opis',`bm_type`= '$kategoria' WHERE `id_postmeta`= $id")) {
                                return $this->Message->format("success_update", "Dane zostały edytowane!");
                                exit();
                            }else {
                                return $this->Message->format("error", "Wystąpił błąd pod czas edytowania danych.");
                                exit();
                            }
                        } else {
                            return $this->Message->format("info", "Dane są takie same!");
                            exit();
                        }
                    } else {
                        return $this->Message->format("info", "Wprowadzone dane są za krótkie lub długie.");
                        exit();
                    }
                    
                }else{
                    return $this->Message->format("info", "Brak danych do edytowania.");
                    exit();
                }
            } else {
                return $this->Message->format("error", "Brak danych wejśćiowych.");
                exit();
            }
        }
        
    }
