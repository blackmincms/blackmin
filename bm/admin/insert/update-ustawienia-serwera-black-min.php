<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do aktulizacji ustawień serwera black min
	
	Black Min cms,
	
	#plik: 1.2
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	require_once "../../../connect.php";
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['url_serwera_bm']))
	{
		// pobieranie danych metodą post
		
		$url_serwera = $_POST['url_serwera_bm'];
		$url_witryny = $_POST['url_witryny_bm'];
		$mail_witryny = $_POST['mail_witryny'];
		$ranga_witryny = $_POST['ranga_witryny'];
		$jezyk_witryny = $_POST['jezyk_witryny'];
		$strefa_czasowa_witryny = $_POST['strefa_czasowa_witryny'];
		$date_witryny = $_POST['date_witryny'];
		$time_witryny = $_POST['time_witryny'];
		$admin_witryny = $_POST['admin_witryny'];
		$email_admin_witryny = $_POST['email_admin_witryny'];

		$url_serwera = htmlentities($url_serwera, ENT_QUOTES, "UTF-8");
		$url_witryny = htmlentities($url_witryny, ENT_QUOTES, "UTF-8");
		$mail_witryny = htmlentities($mail_witryny, ENT_QUOTES, "UTF-8");
		$ranga_witryny = html_entity_decode($ranga_witryny, ENT_QUOTES, "UTF-8");
		$jezyk_witryny = html_entity_decode($jezyk_witryny, ENT_QUOTES, "UTF-8");	
		$strefa_czasowa_witryny = html_entity_decode($strefa_czasowa_witryny, ENT_QUOTES, "UTF-8");
		$date_witryny = htmlspecialchars($date_witryny, ENT_QUOTES, "UTF-8");
		$time_witryny = htmlspecialchars($time_witryny, ENT_QUOTES, "UTF-8");
		$admin_witryny = htmlspecialchars($admin_witryny, ENT_QUOTES, "UTF-8");	
		$email_admin_witryny = htmlspecialchars($email_admin_witryny, ENT_QUOTES, "UTF-8");	
		
		$wszystko_ok = true;
		
		
		// jęzeli walidacja przeszła pomyśnie to otwiera się połączenie z bazą danych
		
		if($wszystko_ok == true){
			
		// Sprawdź poprawność adresu email
		$emailB = filter_var($mail_witryny, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$mail_witryny))
		{
			$wszystko_ok = false;
			echo '<section class="tsr tsr-alert tsr-alert-error"> Podaj poprawny adres e-mail! </section>';
		}
		
		// Sprawdź poprawność adresu email
		$emailC = filter_var($email_admin_witryny, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailC, FILTER_VALIDATE_EMAIL)==false) || ($emailC!=$email_admin_witryny))
		{
			$wszystko_ok = false;
			echo '<section class="tsr tsr-alert tsr-alert-error"> Podaj poprawny adres e-mail! </section>';
		}
			
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
				mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");				
				
				// jeżeli wszystkie testy walidacyjne przeszły pomyśnie to dodajemy nową kategorie tag
				// wyśiwtlamy informacje dla użytkownika że kategoria tag został dodany do bazy danych
				
				if ($wszystko_ok == true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy

					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$url_serwera' WHERE `bm_nazwa` = 'url_serwera'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
					};	
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$url_witryny' WHERE `bm_nazwa` = 'url_witryny'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
					};
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$mail_witryny' WHERE `bm_nazwa` = 'bm_email_witryny'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
					};	
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$ranga_witryny' WHERE `bm_nazwa` = 'bm_nowy_uzytkownik'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
					};
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$jezyk_witryny' WHERE `bm_nazwa` = 'bm_jezyk_witryny'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
					};
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$strefa_czasowa_witryny' WHERE `bm_nazwa` = 'bm_strefa_czasowa'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
					};
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$date_witryny' WHERE `bm_nazwa` = 'bm_date'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
					};	
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$time_witryny' WHERE `bm_nazwa` = 'bm_time'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
					};
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_status` SET `bm_wartosc`='$admin_witryny' WHERE `bm_nazwa` = 'bm_nick_admin_bm'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
					};	
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_status` SET `bm_wartosc`='$email_admin_witryny' WHERE `bm_nazwa` = 'bm_mail_admin_bm'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
					};	
					
				}
				
				$polaczenie->close();
			}
			
		}
		
          
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań w innym terminie!</span>';
		}			
			
		}
		
	}
	
?>