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
	
	if(isset($_POST['bm_serwer_mail']))
	{
		// pobieranie danych metodą post
		
		$bm_serwer_mail = $_POST['bm_serwer_mail'];
		$bm_serwer_mail_login = $_POST['bm_serwer_mail_login'];
		$bm_serwer_mail_hasło = $_POST['bm_serwer_mail_hasło'];
		$bm_serwer_mail_port = $_POST['bm_serwer_mail_port'];


		$bm_serwer_mail = htmlentities($bm_serwer_mail, ENT_QUOTES, "UTF-8");
		$bm_serwer_mail_login = htmlentities($bm_serwer_mail_login, ENT_QUOTES, "UTF-8");
		$bm_serwer_mail_hasło = htmlentities($bm_serwer_mail_hasło, ENT_QUOTES, "UTF-8");
		$bm_serwer_mail_port = html_entity_decode($bm_serwer_mail_port, ENT_QUOTES, "UTF-8");
		
		$wszystko_ok = true;	

		// Sprawdź poprawność adresu email
		$emailB = filter_var($bm_serwer_mail, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$bm_serwer_mail))
		{
			$wszystko_ok = false;
			echo '<section class="tsr tsr-alert tsr-alert-error"> Podaj poprawny adres e-mail! </section>';
		}
		
		// jęzeli walidacja przeszła pomyśnie to otwiera się połączenie z bazą danych
		
		if($wszystko_ok == true){
			
			
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
				
				if ($wszystko_ok == true)
				{
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_serwer_mail' WHERE `bm_nazwa` = 'bm_serwer_mail'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
					};	
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_serwer_mail_login' WHERE `bm_nazwa` = 'bm_serwer_mail_login'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
					};	
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_serwer_mail_hasło' WHERE `bm_nazwa` = 'bm_serwer_mail_hasło'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
					};	
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_serwer_mail_port' WHERE `bm_nazwa` = 'bm_serwer_mail_port'")
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