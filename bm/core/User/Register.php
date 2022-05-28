<?php


    declare(strict_types=1);

    namespace BlackMin\User;

    use BlackMin\Database\Database;
    use BlackMin\Message\Message;

    final class Register {
        
        private $database;
        private $arg;
        protected $message;

        public function __construct(Database $database, array $arg) {
            $this->database = $database;
            $this->arg = $arg;

            $this->message = new Message();
        }

        public function register_mys() {

            if(isset($this->arg['nick'])) {
        
                // pobieranie danych metodą post
                
                $nick = $this->arg['nick'];
                $imie = $this->arg['imie'];
                $nazwisko = $this->arg['nazwisko'];
                $mail = $this->arg['mail'];
                $plec = $this->arg['plec'];
                $haslo = $this->arg['haslo'];
                $haslo2 = $this->arg['haslo2'];
                $rola = $this->arg['rola'];
                $flaga = $rola;
                // formatowanie daty
                
                $datetime = date("Y-m-d H:i"); 
        
                // filtrowanie danych dla pewnośći
                
                $nick = $this->database->valid($nick);
                $imie = $this->database->valid($imie);
                $nazwisko = $this->database->valid($nazwisko);
                $mail = $this->database->valid($mail);
                $plec = $this->database->valid($plec);
                $haslo = $this->database->valid($haslo);
                $haslo2 = $this->database->valid($haslo2);
                
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
                
                // generowanie tokenu użytkownika
                $token = password_hash($nick, PASSWORD_DEFAULT);
                
                if ($flaga == "użytkownik") {
                    $flaga = 5;
                    $rola = "";
                }elseif ($flaga == "redaktor") {
                    $flaga = 10;
                    $rola = "redaktor";
                }elseif ($flaga == "moderator") {
                    $flaga = 15;
                    $rola = "moderator";
                }elseif ($flaga == "współpracownik") {
                    $flaga = 20;
                    $rola = "współpracownik";
                }elseif ($flaga == "administrator") {
                    $flaga = 25;
                    $rola = "administrator";
                }elseif ($flaga == "właśćiciel") {
                    $flaga = 30;
                    $rola = "właśćiciel";
                }else{
                    $flaga = 5;
                    $rola = "użytkownik";
                }	
                
                if ($out = $this->database->query("SELECT `id` FROM `|prefix|bm_users` WHERE email='$mail'")) {
                    if ($out["num_rows"] > 0) {
                        $wszystko_ok = false;
                        return $this->message->format("info", "Istnieje już konto przypisane do tego adresu e-mail!");
                    }
                }
                if ($out = $this->database->query("SELECT `id` FROM `|prefix|bm_users` WHERE nick='$nick'")) {
                    if ($out["num_rows"] > 0) {
                        $wszystko_ok = false;
                        return $this->message->format("info", "Istnieje już konto o takim nicku! Wybierz inne.");
                    }
                }
        
                if ($wszystko_ok != false) {
                    if ($out = $this->database->insert("INSERT INTO `|prefix|bm_users` VALUES (NULL, '$nick', '$imie', '$nazwisko', '$mail', '$plec', '$datetime', '". BM_SETTINGS["url_server"] ."pliki/logo/logo_bm_white_2_100_100.png', '$haslo_hash', '$token', 'aktywacja_konta', '$rola', '$flaga', 'ofline', '$datetime', '[test_system_users],[test_mesages]')")) {
                        return $this->message->format("success", "Nowy Użytkownik Został Dodany Poprawnie!");
                    }
                } else {
                    return $this->message->format("error", "Wystąpił nieznany błąd!");
                }			
                
            }

        }
         

    }
    