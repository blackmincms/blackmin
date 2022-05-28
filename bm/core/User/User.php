<?php


    declare(strict_types=1);

    namespace BlackMin\User;

    use BlackMin\Base\BaseInterface;
    use BlackMin\Message\Message;
    use BlackMin\User\Register;

    final class User implements BaseInterface {

        private $database;
        private $action;
        private $param;

        protected $message;

        public function __construct ($d ,String $a, array $t) {
            $this->database = $d;
            $this->action = $a;
            $this->param = $t;

            $this->message = new Message();
        }

        public function parse(){
            switch ($this->action) {
                case 'login':
                    return $this->login();
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
        
        public function check(){
            $t = $this->database->valid($this->param["login"]);
            $p = $this->database->valid($this->param["haslo"]);

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
                            $_SESSION['flag'] = $flaga = $wiersz[0]['flag'];
                            $_SESSION['online'] = $wiersz[0]['online'];
                            $_SESSION['last_active'] = $wiersz[0]['last_active'];

                            // unset usel login flag
                            unset($_SESSION["BM_USER_LOGIN"]);

                            $user_t = "";
                            
                            if($flaga >= 6){
                                $user_t = "admin";
                            }else{
                                $user_t = "user";
                            }
                            
                            // header('Location: '.$user_t.'panel.php');
                            return $this->message->format("location", ("bm/" . $user_t. '/panel.php'));
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

        public function get() {
            if (isset($this->param['id'])) {          
                // filtrowanie danych
                $id = $this->database->valid($this->param['id']);

                if ($id === "id") {
                    $id = $_SESSION["id"];
                }

                // check param is int

                if ((is_int($id)) || (is_string($id))) {
                    // zapytanie do db
                    $zap = $this->database->query("SELECT `|prefix|bm_users`.* FROM `|prefix|bm_users` WHERE `id` = '$id' LIMIT 1");
                } else {
                    $zap = $this->Message->format("war", "Wprowadzone dane nie są liczbą");
                }
            } else {

                if (isset ($this->param['plec'])){
                    $plec = $this->param['plec'];
                }else{
                    $plec = "all";
                }
        
                if (isset ($this->param['dostep'])){
                    $dostep = $this->param['dostep'];
                }else {
                    $dostep = "all";
                }
                
                if (isset ($this->param['ranga'])){
                    $ranga = $this->param['ranga'];
                }else {
                    $ranga = "all";
                }
                
                if (isset ($this->param['szukaj'])){
                    $szukaj = $this->param['szukaj'];
                }else {
                    $szukaj = "";
                }
        
                if (isset ($this->param['ile_load'])){
                    $ile_load = $this->param['ile_load'];
                }else {
                    $ile_load = "25";
                }
        
                // filtrowanie danych
        
                $plec = $this->database->valid($plec);
                $dostep = $this->database->valid($dostep);
                $ranga = $this->database->valid($ranga);
                $szukaj = $this->database->valid($szukaj);
                $ile_load = $this->database->valid($ile_load);
        
                $plec = ($plec === "all" ? "(`gender` LIKE '%%')" : "(`gender` LIKE '%". $plec ."%')");
                $dostep = ($dostep === "all" ? "(`access` LIKE '%%')" : "(`access` LIKE '%". $dostep ."%')");
                $ranga = ($ranga === "all" ? "(`rank` LIKE '%%')" : "(`rank` LIKE '%". $ranga ."%')");
                $szukaj = (strlen($szukaj) === 0 ? "(`nick` LIKE '%%' OR `name` LIKE '%%' OR `surname` LIKE '%%' OR `email` LIKE '%%')" : "(`nick` LIKE '%". $szukaj ."%' OR `name` LIKE '%". $szukaj ."%' OR `surname` LIKE '%". $szukaj ."%' OR `email` LIKE '%". $szukaj ."%')");
                $ile_load = ($ile_load < 0 ? 0 : $ile_load);
                // zapytanie do db
                $zap = $this->database->query2("SELECT `|prefix|bm_users`.* FROM `|prefix|bm_users` WHERE $plec AND $dostep AND $ranga AND $szukaj ORDER BY `id` DESC LIMIT $ile_load");

            }
    
            return $zap;
        }

        public function del() {
            if (isset($this->param["name"])) {
                if ($this->param["name"] === "user") {
                    if (isset($this->param["content"])) {
                        // sprawdzanie czy dane są do usunięcja
                        $t = count($this->param["content"]);
                        if ($t === 0) {
                            return $this->message->format("info", "Brak danych do usunięcja.");
                        }else {
                            $a = $this->database->parse($this->param["content"]);
                            $a = $this->database->valid($a);
                            // usuwanie danych
                            if ($this->database->delete("DELETE FROM `|prefix|bm_users` WHERE `id` IN (". $a .")")) {
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

        public function add() {
            $register = new Register($this->database, $this->param);
            return $register->register_mys();
        }

        public function edit() {
            if (isset($this->param)) {
                if (!isset ($this->param['id'])){
					return $this->message->format("info", "Brak danych id objektu do edycji.");
                }

                if(isset($this->param['nick'])) {
        
                    // filtrowanie danych
                    $id = $this->database->valid($this->param['id']);

                    if ($id === "id") {
                        $id = $_SESSION["id"];
                    }

                    // pobieranie danych metodą post
                    
                    $nick = $this->param['nick'];
                    $imie = $this->param['imie'];
                    $nazwisko = $this->param['nazwisko'];
                    $avatar = $this->param['avatar'];
                    $mail = $this->param['mail'];
                    $dostep = $this->param['dostep'];
                    $ranga = $this->param['ranga'];
                    $flaga = $ranga;
                    $haslo = (array_key_exists("haslo", $this->param) === true ? $this->param["haslo"] : false);
                    $haslo2 = (array_key_exists("haslo", $this->param) === true ? $this->param["haslo2"] : false);
            
                    // filtrowanie danych dla pewnośći
                    
                    $nick = $this->database->valid($nick);
                    $imie = $this->database->valid($imie);
                    $nazwisko = $this->database->valid($nazwisko);
                    $mail = $this->database->valid($mail);
                    $dostep = $this->database->valid($dostep);
                    $ranga = $this->database->valid($ranga);
                    $haslo = ($haslo !== false ? $this->database->valid($haslo) : false);
                    $haslo2 = ($haslo2 !== false ? $this->database->valid($haslo2) : false);

                    $wszystko_ok = true;
                    
                    //Sprawdzenie długości nicka
                    if ((strlen($nick)<3) || (strlen($nick)>24))
                    {
                        $wszystko_ok = false;
                        return $this->message->format("info", "Nick musi posiadać od 3 do 24 znaków!");
                    }
                    
                    // imie i naazwisko
                    
                    //Sprawdzenie długości imienia
                    if ((strlen($imie)<3) || (strlen($imie)>24))
                    {
                        $wszystko_ok = false;
                        return $this->message->format("info", "Imie musi posiadać od 3 do 24 znaków!");
                    }
                 
                    //Sprawdź poprawność nazwiska
                    if ((strlen($nazwisko)<4) || (strlen($nazwisko)>34))
                    {
                        $wszystko_ok = false;
                        return $this->message->format("info", "Nazwisko musi posiadać od 4 do 34 znaków!");
                    }
                    
                    // Sprawdź poprawność adresu email
                    $emailB = filter_var($mail, FILTER_SANITIZE_EMAIL);
                    
                    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$mail))
                    {
                        $wszystko_ok = false;
                        return $this->message->format("war", " Podaj poprawny adres e-mail!");
                    }
                    
                    // ustawienie odpowiedniej flagi dla rangi
                    if ($ranga == "użytkownik") {
                        $flaga = 5;
                    } elseif ($ranga == "redaktor") {
                        $flaga = 10;
                    } elseif ($ranga == "moderator") {
                        $flaga = 15;
                    } elseif ($ranga == "współpracownik") {
                        $flaga = 20;
                    } elseif ($ranga == "administrator") {
                        $flaga = 25;
                    } elseif ($ranga == "właśćiciel") {
                        $flaga = 30;
                    }else{
                        $flaga = 5;
                        $ranga = "użytkownik";
                    }	
                    
                    if ($out = $this->database->query("SELECT `id`, `email` FROM `|prefix|bm_users` WHERE email = '$mail'")) {
                        if (($out["num_rows"] > 0) && ($out[0]["email"] !== $_SESSION['email']) && ($out[0]["id"] !== $this->param["id"])) {
                            $wszystko_ok = false;
                            return $this->message->format("info", "Istnieje już konto przypisane do tego adresu e-mail!");
                        }
                    }
                    if ($out = $this->database->query("SELECT `id`, `nick` FROM `|prefix|bm_users` WHERE nick = '$nick'")) {
                        if (($out["num_rows"] > 0) && ($out[0]["nick"] !== $_SESSION["nick"]) && ($out[0]["id"] !== $this->param["id"])) {
                            $wszystko_ok = false;
                            return $this->message->format("info", "Istnieje już konto o takim nicku!");
                        }
                    }
 
                    if ($id === $_SESSION["id"]) {
                        if (($haslo !== false) && ($haslo2 !== false)) {
                            if ((strlen($haslo) !== 0) && (strlen($haslo2) !== 0)) {
                                //Sprawdź poprawność hasła
                                if ((strlen($haslo)<8) || (strlen($haslo)>30))
                                {
                                    $wszystko_ok = false;
                                    return $this->message->format("info", "Hasło musi posiadać od 8 do 30 znaków!");
                                }
                                
                                if ($haslo!=$haslo2)
                                {
                                    $wszystko_ok = false;
                                    return $this->message->format("war", "Podane hasła nie są identyczne!");
                                }	
                        
                                $haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
                            }else {
                                $haslo_hash = false;
                            }
                        } else {
                            return $this->message->format("war", "Brak danych wejśćiowych.");
                        }
                        
                    }

                    if ($wszystko_ok != false) {
                        /* if ($out = $this->database->insert("INSERT INTO `|prefix|bm_users` VALUES (NULL, '$nick', '$imie', '$nazwisko', '$mail', '$plec', '$datetime', '". BM_SETTINGS["url_server"] ."pliki/logo/logo_bm_white_2_100_100.png', '$haslo_hash', '$token', 'aktywacja_konta', '$rola', '$flaga', 'ofline', '$datetime', '[test_system_users],[test_mesages]')")) {
                            return $this->message->format("success", "Nowy Użytkownik Został Dodany Poprawnie!");
                        } */

                        // check haslo_hash not false
                        $haslo_hash = (($haslo_hash != false) && (isset($haslo_hash)) ? ", `password` = '". $haslo_hash ."'" : "");

                        if ($out = $this->database->update("UPDATE `bm_users` SET `nick` = '$nick', `name` = '$imie', `surname` = '$nazwisko', `email` = '$mail', `avatar` = '$avatar',`access` = '$dostep', `rank` = '$ranga', `flag` = '$flaga' $haslo_hash WHERE `id` = " . $id . "")) {
                            return $this->message->format("success_update", "Dane Zostały Zmienione Poprawnie!");
                        } else {
                            return $this->message->format("error", "Wystąpił Bład Pod Czas Aktulizowania Danych!");
                        }
                        
                    } else {
                        return $this->message->format("error", "Wystąpił nieznany błąd!");
                    }			
                    
                } else {
                    return $this->message->format("error", "Brak danych wejśćiowych.");
                } 

            } else {
                return $this->message->format("error", "Brak danych wejśćiowych.");
            }          
        }

    }
    