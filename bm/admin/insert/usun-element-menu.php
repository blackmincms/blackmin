<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do usuwania niepoczebnych elementów menu
	Black Min cms,
	
	#plik: 1.2
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['id_menu']))
	{
		// pobieranie danych metodą post
		$id_menu = $_POST['id_menu'];
		// sprawdzanie poprawnośći danych
		$id_menu = htmlentities($id_menu, ENT_QUOTES, "UTF-8");
		// dekodowanie danych json_decode
		
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
				sprintf("DELETE FROM `".$prefix_table."bm_postmeta` WHERE `id` IN (". $id_menu .")")
				 ))
				{
					echo '<section class="tsr-alert tsr-alert-success"> Element menu został usunięty poprawnie! </section>';
				};	
				
				$polaczenie->close();
			}
			
		}
          
		catch(Exception $e)
		{
			echo '<section class="tsr-alert tsr-alert-error">Błąd serwera! Przepraszamy za niedogodności!</section>';
		}			
			
	}
		
	
?>