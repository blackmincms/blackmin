<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do edytowania profilu użytkownika
	
	Black Min cms,
	
	#plik: 1.1
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	require_once "../laduj/class-get-ustawienia.php";
	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	$url_serwera_bm = BM_SETTINGS["url_server"];
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['nick']))
	{
		// pobieranie ze zmiennej sesyinej id użytkownika profilu
		$id = $_POST['id'];
		
		// pobieranie danych metodą post
		
		$nick_spr = $_POST['nick_spr'];
		$mail_spr = $_POST['mail_spr'];
		
		$nick = $_POST['nick'];
		$imie = $_POST['imie'];
		$nazwisko = $_POST['nazwisko'];
		$mail = $_POST['mail'];
		$avatar = $_POST['avatar'];
		$dostep = $_POST['dostep'];
		$ranga = $_POST['ranga'];
		
		// formatowanie daty
		$datetime = (date("Y-m-d H:i")); 

		// filtrowanie danych dla pewnośći	
		$nick = html_entity_decode($nick, ENT_QUOTES, "UTF-8");
		$imie = html_entity_decode($imie, ENT_QUOTES, "UTF-8");
		$nazwisko = html_entity_decode($nazwisko, ENT_QUOTES, "UTF-8");
		$mail = html_entity_decode($mail, ENT_QUOTES, "UTF-8");
		$avatar = html_entity_decode($avatar, ENT_QUOTES, "UTF-8");
		$dostep = html_entity_decode($dostep, ENT_QUOTES, "UTF-8");
		$ranga = html_entity_decode($ranga, ENT_QUOTES, "UTF-8");
		
		$rola = $ranga;
		
		$wszystko_ok = true;
		
		//Sprawdzenie długości nicka
		if ((strlen($nick)<3) || (strlen($nick)>24))
		{
			$wszystko_ok = false;
			echo '<section class="tsr tsr-alert tsr-alert-error"> Nick musi posiadać od 3 do 24 znaków! </section>';
		}
		
		// imie i naazwisko
		
		//Sprawdzenie długości imienia
		if ((strlen($imie)<3) || (strlen($imie)>24))
		{
			$wszystko_ok = false;
			echo '<section class="tsr tsr-alert tsr-alert-error"> imie musi posiadać od 3 do 24 znaków! </section>';
		}
	 
		//Sprawdź poprawność nazwiska
		if ((strlen($nazwisko)<4) || (strlen($nazwisko)>34))
		{
			$wszystko_ok = false;
			echo '<section class="tsr tsr-alert tsr-alert-error"> nazwisko musi posiadać od 4 do 34 znaków! </section>';
		}

		// ustawienie odpowiedniej flagi dla rangi
		if ($rola == "użytkownik") {
			$flaga = 5;
		}
		
		if ($rola == "redaktor") {
			$flaga = 10;
		}
		
		if ($rola == "moderator") {
			$flaga = 15;
		}

		if ($rola == "współpracownik") {
			$flaga = 20;
		}
		
		if ($rola == "administrator") {
			$flaga = 25;
		}
		
		if ($rola == "właśćiciel") {
			$flaga = 30;
		}		
		
		// koniec imie i nazwisko
		
		// Sprawdź poprawność adresu email
		$emailB = filter_var($mail, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$mail))
		{
			$wszystko_ok = false;
			echo '<section class="tsr tsr-alert tsr-alert-error"> Podaj poprawny adres e-mail! </section>';
		}
	
		// jęzeli jeżeli walidacja przeszła pomyśnie to otwiera się połączenie z bazą danych
			
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				
				mysqli_query($polaczenie, "SET CHARSET utf8");
				mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");	
				
				if ($mail_spr == false) {
				
					//Czy email już istnieje?
					$rezultat = $polaczenie->query("SELECT `id` FROM `".$prefix_table."bm_uzytkownicy` WHERE email='$mail'");
					
					if (!$rezultat) throw new Exception($polaczenie->error);
					
					$ile_takich_maili = $rezultat->num_rows;
					if($ile_takich_maili>0)
					{
						$wszystko_ok = false;
						echo '<section class="tsr tsr-alert tsr-alert-error"> Istnieje już konto przypisane do tego adresu e-mail! </section>';
					}	

				}

				if ($nick_spr == false) {

					//Czy nick jest już zarezerwowany?
					$rezultat2 = $polaczenie->query("SELECT `id` FROM `".$prefix_table."bm_uzytkownicy` WHERE nick='$nick'");
					
					if (!$rezultat2) throw new Exception($polaczenie->error);
					
					$ile_takich_nickow = $rezultat2->num_rows;
					if($ile_takich_nickow>0)
					{
						$wszystko_ok = false;
						echo '<section class="tsr tsr-alert tsr-alert-error"> Istnieje już konto o takim nicku! Wybierz inne. </section>';
					}
				
				}
				
				// jeżeli wszystkie testy walidacyjne przeszły pomyśnie to dodajemy nowy post
				// wyśiwtlamy informacje dla użytkownika że post został dodany do bazy danych
				
				if ($wszystko_ok == true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					
					if ($polaczenie->query("UPDATE `".$prefix_table."bm_uzytkownicy` SET `nick`='$nick',`imie`='$imie',`nazwisko`='$nazwisko',`email`='$mail',`avatar`='$avatar',`dostep`='$dostep',`ranga`='$ranga',`flaga`='$flaga' WHERE `id` = '$id'"))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Profil Został Edytowany Poprawnie </section>';
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
			
		}
		
          
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań w innym terminie!</span>';
		}			
		
	}
	
?>