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
	
	if(isset($_POST['bm_spolecznosc_link']))
	{
		// pobieranie danych metodą post
		
		$bm_spolecznosc_opis = $_POST['bm_spolecznosc_opis'];
		$bm_spolecznosc_link = $_POST['bm_spolecznosc_link'];
		$bm_spolecznosc_link_info_cookies = $_POST['bm_spolecznosc_link_info_cookies'];
		$bm_spolecznosc_text_akcept = $_POST['bm_spolecznosc_text_akcept'];


		$bm_spolecznosc_opis = htmlentities($bm_spolecznosc_opis, ENT_QUOTES, "UTF-8");
		$bm_spolecznosc_link = htmlentities($bm_spolecznosc_link, ENT_QUOTES, "UTF-8");
		$bm_spolecznosc_link_info_cookies = htmlentities($bm_spolecznosc_link_info_cookies, ENT_QUOTES, "UTF-8");
		$bm_spolecznosc_text_akcept = html_entity_decode($bm_spolecznosc_text_akcept, ENT_QUOTES, "UTF-8");
		
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
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_spolecznosc_opis' WHERE `bm_nazwa` = 'bm_cookie_description'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_spolecznosc_link' WHERE `bm_nazwa` = 'bm_cookie_link'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_spolecznosc_link_info_cookies' WHERE `bm_nazwa` = 'bm_cookie_privacy_policy_link'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_spolecznosc_text_akcept' WHERE `bm_nazwa` = 'bm_cookie_accept'")
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