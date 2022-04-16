<?php


    declare(strict_types=1);

    namespace BlackMin\User;

    use BlackMin\Message\Message;

    class User {

        private $database;
        private $action;
        private $arg;
        private $message;

        public function __construct(object $t, string $a, array $arg) {
            $this->database = $t;
            $this->action = $a;
            $this->arg = $arg;

            $this->message = new Message();

            if ($this->action == "login") {
                return User::login();
            }else if ($this->action == "unset") {
                // return User::set();
            }else if ($this->action == "logout") {
                // return User::del();
            }else {
                return false;
            } 
        }
        
        public function check(){
            $t = $this->database->valid($this->arg["login"]);
            $p = $this->database->valid($this->arg["haslo"]);

            if (strlen($t) != 0) {
                if ($wiersz = $this->database->query("SELECT * FROM `|prefix|bm_users` WHERE nick = '". $t ."'")) {
                    if ($wiersz["num_rows"] != 0) {
                        if (password_verify($p, $wiersz[0]['password'])) {
                            $_SESSION['zalogowany'] = true;
                            $_SESSION['id'] = $wiersz[0]['id'];
                            $_SESSION['nick'] = $wiersz[0]['nick'];
                            $_SESSION['name'] = $wiersz[0]['name'];
                            $_SESSION['surname'] = $wiersz[0]['surname'];
                            $_SESSION['email'] = $wiersz[0]['email'];
                            $_SESSION['gender'] = $wiersz[0]['gender'];
                            $_SESSION['date_join'] = $wiersz[0]['date_join'];
                            $_SESSION['avatar'] = $wiersz[0]['avatar'];
                            $_SESSION['access'] = $wiersz[0]['access'];
                            $_SESSION['rank'] = $wiersz[0]['rank'];
                            $_SESSION['flag'] = $wiersz[0]['flag'];
                            $_SESSION['online'] = $wiersz[0]['online'];
                            $_SESSION['last_active'] = $wiersz[0]['last_active'];
                            $flaga = $wiersz[0]['flag'];
                            
                            $_SESSION['session_flag'] = $flaga;
                            
                            $user_t = "";
                            
                            if($flaga >= 6){
                                $user_t = "admin/";
                            }else{
                                $user_t = "user/";
                            }
                            
                            header('Location: '.$user_t.'panel.php');
                            return $this->message->format("location", $user_t.'panel.php');
                            exit();

                            return $this->message->format("success", "BlackMin: Zalogowano Prawidłowo!");
                        } else {
                            return $this->message->format("info", "BlackMin: Nieprawidłowy login lub hasło!!");
                        }
                    }else{
                        return $this->message->format("info", "BlackMin: Nieprawidłowy login lub hasło!!");
                    }
                } else {
                    return $this->message->format("error", "BlackMin: Wystąpił Błąd Połączenia Z Serwerem!");
                }       
            } else {
                return $this->message->format("error", "BlackMin: Wprowadzone dane są nieprawidłowe!");
            }
            
        }

        public function login() {
            return User::check();
        }

        public function logout () {
            session_unset();
            return true;
        }

    }
    