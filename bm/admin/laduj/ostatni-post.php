<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do Załadowania ostatniego posta ADMIN PANEL
	
	Black Min cms,
	
	#plik: 1.1
*/


	
	function ostatni_post_admin() {
		global $host, $db_user, $db_password, $db_name, $prefix_table, $polaczenie, $rezultat, $date, $date2, $date3, $date4, $time, $time2;
		
		$date = date('Y-m-d');
		
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
				sprintf("SELECT * FROM `".$prefix_table."bm_data_posty` ORDER BY `".$prefix_table."bm_data_posty`.`id` DESC LIMIT 1"))) {
					
					$row = mysqli_fetch_assoc($rezultat);
					$id = $row['id'];
					$dodajacy = $row['dodajacy'];
					$tytul = $row['tytul'];
					$url = $row['url'];
					$datetime = $row['datetime'];
					$tresc = $row['tresc'];
				};	
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		}
		
		return array('id' => $id, 'dodajacy' => $dodajacy, 'tytul' => $tytul, 'url' => $url, 'datetime' => $datetime, 'tresc' => $tresc);
		
	}
	
	ostatni_post_admin();
	$ostatni_post_admin = ostatni_post_admin();

?>