<?php
    namespace BlackMin\Post;

    use BlackMin\Message\Message;

    class Post {

        private $database;
        private $action;
        private $parm;

        protected $Message;

        public function __construct (object $d ,String $a, array $t) {
            $this->database = $d;
            $this->action = $a;
            $this->parm = $t;

            $this->Message = new Message();
            
            return Post::parse();
        }

        public function parse(){
            if ($this->action == "get") {
                return Post::get();
            }else {
                return false;
            }           
        }
   
        public function get(){
            // if (isset ($this->parm['roszerzenie'])){
            //     $roszerzenie = $this->parm['roszerzenie'];
            // }else{
            //     $roszerzenie = "all";
            // }
            
            // if (isset ($this->parm['folder'])){
            //     $folder = $this->parm['folder'];
            // }else {
            //     $folder = "";
            // }
            
            // if (isset ($this->parm['ile_load'])){
            //     $ile_load = $this->parm['ile_load'];
            // }else {
            //     $ile_load = "25";
            // }
            
            // if (isset ($this->parm['szukaj'])){
            //     $szukaj = $this->parm['szukaj'];
            // }else{
            //     $szukaj = "";
            // }
        
            // // filtrowanie danych
            
            // $roszerzenie = $this->database->valid($roszerzenie);
            // $folder = $this->database->valid($folder);
            // $szukaj = $this->database->valid($szukaj);
            // $ile_load = $this->database->valid($ile_load);
            
            // $roszerzenie = ($roszerzenie == "all" ? "`bm_file_type` LIKE '%%'" : "`bm_file_type` LIKE '%". $roszerzenie ."%'");
            // $folder = (strlen($folder) === 0 ? "`bm_folder` LIKE '%%'" : "`bm_folder` LIKE '%". $folder ."%'");
            // $szukaj = (strlen($szukaj) === 0 ? "(`bm_name` LIKE '%%' OR `bm_name_orginal` LIKE '%%' OR `bm_description` LIKE '%%')" : "(`bm_name` LIKE '%". $szukaj ."%' OR `bm_name_orginal` LIKE '%". $szukaj ."%' OR `bm_description` LIKE '%". $szukaj ."%')");
            // $ile_load = ($ile_load < 0 ? 0 : $ile_load);
            // zapytanie do db
            // $zap = $this->database->query2("SELECT * FROM `|prefix|bm_posts` WHERE (`status`LIKE 'public' OR `status`LIKE 'protect_password' OR `status`LIKE 'private') ORDER BY `id_post` DESC LIMIT 25");

            $zap = $this->database->query2("SELECT `|prefix|bm_posts`.*, `|prefix|bm_posts`.`|prefix|author` as 'id_author' , `|prefix|bm_users`.`nick` as 'authores' FROM `|prefix|bm_posts` LEFT JOIN `|prefix|bm_users` ON `|prefix|bm_posts`.`author` = `|prefix|bm_users`.`id` WHERE (`status`LIKE 'public' OR `status`LIKE 'protect_password' OR `status`LIKE 'private') ORDER BY `id_post` DESC LIMIT 25");

            // `|prefix|bm_files`.*, `|prefix|bm_files`.`|prefix|bm_author` as 'id_author' , `|prefix|bm_users`.`nick` as 'autor' FROM `bm_files` LEFT JOIN `|prefix|bm_users` ON `|prefix|bm_files`.`bm_author` = `|prefix|bm_users`.`id`
            return $zap;
        }

        public function set(){
            # code...
        }
        
    }
