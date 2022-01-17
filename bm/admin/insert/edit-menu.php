<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do edytowania menu 
	Black Min cms,
	
	#plik: 1.1
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['menu_structur']))
	{
		// pobieranie danych metodą post
		
		$menu_structur = $_POST['menu_structur'];
		
		// zapisywanie struktury menu do bazy danychy	
			
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
				
					
				if ($rezultat = $polaczenie->query(
				sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$menu_structur' WHERE `bm_nazwa` = 'bm_menu_structur'")
				 ))
				{
					echo '<section class="tsr-alert tsr-alert-success"> Menu zostało zmienione poprawnie! </section>';
				};	
				
				if ($rezultat = $polaczenie->query(
				sprintf("UPDATE `".$prefix_table."bm_postmeta` SET `bm_nazwa`='menu_item' WHERE `bm_nazwa` = 'new_menu_item'")
				 ))
				{
					echo '<section class="tsr-alert tsr-alert-success"> Nowy element menu został zaktulizowany! </section>';
				};	
				
				$polaczenie->close();
			}
			
		}
          
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań w innym terminie!</span>';
		}			
			
	}
		
	
?>