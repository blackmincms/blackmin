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
	
	if(isset($_POST['tytul_witryny']))
	{
		// pobieranie danych metodą post
		
		$tytul_witryny = $_POST['tytul_witryny'];
		$opis_witryny = $_POST['opis_witryny'];
		$slowa_kluczowe_witryny = $_POST['slowa_kluczowe_witryny'];
		$icone_ico_witryny = $_POST['icone_ico_witryny'];
		$icone_witryny = $_POST['icone_witryny'];
		$logo_witryny = $_POST['logo_witryny'];
		$banner_witryny = $_POST['banner_witryny'];


		$tytul_witryny = htmlentities($tytul_witryny, ENT_QUOTES, "UTF-8");
		$opis_witryny = htmlentities($opis_witryny, ENT_QUOTES, "UTF-8");
		$slowa_kluczowe_witryny = htmlentities($slowa_kluczowe_witryny, ENT_QUOTES, "UTF-8");
		$icone_ico_witryny = html_entity_decode($icone_ico_witryny, ENT_QUOTES, "UTF-8");
		$icone_witryny = html_entity_decode($icone_witryny, ENT_QUOTES, "UTF-8");	
		$logo_witryny = htmlspecialchars($logo_witryny, ENT_QUOTES, "UTF-8");
		$banner_witryny = htmlspecialchars($banner_witryny, ENT_QUOTES, "UTF-8");
		
		$wszystko_ok = true;	
		
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
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$tytul_witryny' WHERE `bm_nazwa` = 'bm_name_site'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$opis_witryny' WHERE `bm_nazwa` = 'bm_description_site'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$slowa_kluczowe_witryny' WHERE `bm_nazwa` = 'bm_keywords'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$icone_ico_witryny' WHERE `bm_nazwa` = 'bm_icon_site'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$icone_witryny' WHERE `bm_nazwa` = 'bm_icon_png_site'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$logo_witryny' WHERE `bm_nazwa` = 'bm_logo'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Dane zostały zmienione poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$banner_witryny' WHERE `bm_nazwa` = 'bm_banner'")
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