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
	
	if(isset($_POST['tryb']))
	{
		// pobieranie danych metodą post
		
		$bm_tryb_konserwacji = $_POST['tryb'];
		$bm_tryb_konserwacji_tytul = $_POST['tryb_tytul'];
		$bm_tryb_konserwacji_opis = $_POST['tryb_opis'];
		$bm_tryb_konserwacji_datetime = $_POST['tryb_datetime'];


		$bm_tryb_konserwacji = htmlentities($bm_tryb_konserwacji, ENT_QUOTES, "UTF-8");
		$bm_tryb_konserwacji_tytul = htmlentities($bm_tryb_konserwacji_tytul, ENT_QUOTES, "UTF-8");
		$bm_tryb_konserwacji_opis = htmlentities($bm_tryb_konserwacji_opis, ENT_QUOTES, "UTF-8");
		$bm_tryb_konserwacji_datetime = html_entity_decode($bm_tryb_konserwacji_datetime, ENT_QUOTES, "UTF-8");
		
		$wszystko_ok = true;	
		
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
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_tryb_konserwacji' WHERE `bm_nazwa` = 'bm_maintenance_mode'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Tryb Konserwacji został zmieniony poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_tryb_konserwacji_tytul' WHERE `bm_nazwa` = 'bm_maintenance_mode_title'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Tytuł Konserwacji został zmieniony poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_tryb_konserwacji_opis' WHERE `bm_nazwa` = 'bm_maintenance_mode_description'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Opis Konserwacji został zmieniony poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_tryb_konserwacji_datetime' WHERE `bm_nazwa` = 'bm_maintenance_mode_datetime'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Data i czas Zakończenia Konserwacji został zmieniony poprawnie! </section>';
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