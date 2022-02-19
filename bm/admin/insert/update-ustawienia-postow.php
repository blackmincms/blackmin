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
	
	if(isset($_POST['bm_domysny_status_posta']))
	{
		// pobieranie danych metodą post
		
		$bm_domysny_format_posta = $_POST['bm_domysny_format_posta'];
		$bm_domysny_status_posta = $_POST['bm_domysny_status_posta'];
		$bm_domysne_laduj_posty = $_POST['bm_domysne_laduj_posty'];


		$bm_domysny_format_posta = htmlentities($bm_domysny_format_posta, ENT_QUOTES, "UTF-8");
		$bm_domysny_status_posta = htmlentities($bm_domysny_status_posta, ENT_QUOTES, "UTF-8");
		$bm_domysne_laduj_posty = html_entity_decode($bm_domysne_laduj_posty, ENT_QUOTES, "UTF-8");
		
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
					
					// jeżeli wszystkie testy walidacyjne przeszły pomyśnie to dodajemy nową kategorie tag
					// wyśiwtlamy informacje dla użytkownika że kategoria tag został dodany do bazy danych
					
					if ($wszystko_ok == true)
					{
						//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy

						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_domysny_format_posta' WHERE `bm_nazwa` = 'bm_default_format_post'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_domysny_status_posta' WHERE `bm_nazwa` = 'bm_default_status_post'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_domysne_laduj_posty' WHERE `bm_nazwa` = 'bm_default_load_post'")
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