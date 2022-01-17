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
	
	if(isset($_POST['bm_social_fb']))
	{
		// pobieranie danych metodą post
		
		$bm_social_fb = $_POST['bm_social_fb'];
		$bm_social_yt = $_POST['bm_social_yt'];
		$bm_social_google_plus = $_POST['bm_social_google_plus'];
		$bm_social_instagram = $_POST['bm_social_instagram'];
		$bm_social_twitter = $_POST['bm_social_twitter'];


		$bm_social_fb = htmlentities($bm_social_fb, ENT_QUOTES, "UTF-8");
		$bm_social_yt = htmlentities($bm_social_yt, ENT_QUOTES, "UTF-8");
		$bm_social_google_plus = htmlentities($bm_social_google_plus, ENT_QUOTES, "UTF-8");
		$bm_social_instagram = html_entity_decode($bm_social_instagram, ENT_QUOTES, "UTF-8");
		$bm_social_twitter = html_entity_decode($bm_social_twitter, ENT_QUOTES, "UTF-8");
		
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
					sprintf("UPDATE `".$prefix_table."bm_postmeta` SET `bm_wartosc`='$bm_social_fb' WHERE `bm_nazwa` = 'facebook'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Facebook zmieniony poprawnie! </section>';
					};	
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_postmeta` SET `bm_wartosc`='$bm_social_yt' WHERE `bm_nazwa` = 'youtube'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Youtube został zmieniony poprawnie! </section>';
					};	
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_postmeta` SET `bm_wartosc`='$bm_social_google_plus' WHERE `bm_nazwa` = 'google_plus'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Google+ został zmieniony poprawnie! </section>';
					};	
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_postmeta` SET `bm_wartosc`='$bm_social_instagram' WHERE `bm_nazwa` = 'instagram'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Insagram został zmieniony poprawnie! </section>';
					};
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_postmeta` SET `bm_wartosc`='$bm_social_twitter' WHERE `bm_nazwa` = 'twitter'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Twitter został zmieniony poprawnie! </section>';
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