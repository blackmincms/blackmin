<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do dodawanie nowego użytkownika przez admina
	
	Black Min cms,
	
	#plik: 2.0
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	$url_serwera_bm = BM_SETTINGS["url_server"];
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['nick']))
	{
		global $db_bm;

		// pobieranie danych metodą post
		
		$nick = $_POST['nick'];
		$imie = $_POST['imie'];
		$nazwisko = $_POST['nazwisko'];
		$mail = $_POST['mail'];
		$plec = $_POST['plec'];
		$haslo = $_POST['haslo'];
		$haslo2 = $_POST['haslo2'];
		$rola = $_POST['rola'];
		$flaga = html_entity_decode($rola, ENT_QUOTES, "UTF-8");
		// formatowanie daty
		
		$datetime = (date("Y-m-d H:i")); 

		// filtrowanie danych dla pewnośći
		
		$nick = $db_bm->valid($nick);
		$imie = $db_bm->valid($imie);
		$nazwisko = $db_bm->valid($nazwisko);
		$mail = $db_bm->valid($mail);
		$plec = $db_bm->valid($plec);
		$haslo = $db_bm->valid($haslo);
		$haslo2 = $db_bm->valid($haslo2);
		
		$wszystko_ok = true;
		
		//Sprawdzenie długości nicka
		if ((strlen($nick)<3) || (strlen($nick)>24))
		{
			$wszystko_ok = false;
			echo '<section class="tsr tsr-alert tsr-alert-error"> Nick musi posiadać od 3 do 24 znaków! </section>';
			exit();
		}
		
		// imie i naazwisko
		
		//Sprawdzenie długości imienia
		if ((strlen($imie)<3) || (strlen($imie)>24))
		{
			$wszystko_ok = false;
			echo '<section class="tsr tsr-alert tsr-alert-error"> imie musi posiadać od 3 do 24 znaków! </section>';
			exit();
		}
	 
		//Sprawdź poprawność nazwiska
		if ((strlen($nazwisko)<4) || (strlen($nazwisko)>34))
		{
			$wszystko_ok = false;
			echo '<section class="tsr tsr-alert tsr-alert-error"> nazwisko musi posiadać od 4 do 34 znaków! </section>';
			exit();
		}
		
		
		// koniec imie i nazwisko
		
		// Sprawdź poprawność adresu email
		$emailB = filter_var($mail, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$mail))
		{
			$wszystko_ok = false;
			echo '<section class="tsr tsr-alert tsr-alert-error"> Podaj poprawny adres e-mail! </section>';
			exit();
		}
		
		//Sprawdź poprawność hasła
		if ((strlen($haslo)<8) || (strlen($haslo)>30))
		{
			$wszystko_ok = false;
			echo '<section class="tsr tsr-alert tsr-alert-error"> Hasło musi posiadać od 8 do 30 znaków! </section>';
			exit();
		}
		
		if ($haslo!=$haslo2)
		{
			$wszystko_ok = false;
			echo '<section class="tsr tsr-alert tsr-alert-error"> Podane hasła nie są identyczne! </section>';
			exit();
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
		
		if ($out = $db_bm->query("SELECT `id` FROM `|prefix|bm_uzytkownicy` WHERE email='$mail'")) {
			if ($out["num_rows"] > 0) {
				$wszystko_ok = false;
				echo '<section class="tsr tsr-alert tsr-alert-error"> Istnieje już konto przypisane do tego adresu e-mail! </section>';
				exit();
			}
		}
		if ($out = $db_bm->query("SELECT `id` FROM `|prefix|bm_uzytkownicy` WHERE nick='$nick'")) {
			if ($out["num_rows"] > 0) {
				$wszystko_ok = false;
				echo '<section class="tsr tsr-alert tsr-alert-error"> Istnieje już konto o takim nicku! Wybierz inne. </section>';
				exit();
			}
		}

		if ($wszystko_ok != false) {
			if ($out = $db_bm->insert("INSERT INTO `|prefix|bm_uzytkownicy` VALUES (NULL, '$nick', '$imie', '$nazwisko', '$mail', '$plec', '$datetime', '$url_serwera_bm"."pliki/logo/logo_bm_white_2_100_100.png', '$haslo_hash', '$token', 'aktywacja_konta', '$rola', '$flaga', 'ofline', '$datetime', '[test_system_users],[test_mesages]')")) {
				echo '<section class="tsr-alert tsr-alert-success"> Nowy Użytkownik Został Dodany Poprawnie </section>';
				echo '<meta http-equiv="refresh" content="0">';
			}
		} else {
			echo '<section class="tsr-alert tsr-alert-error"> Wystąpił nieznany błąd! </section>';
			exit();
		}			
		
	}
	
?>