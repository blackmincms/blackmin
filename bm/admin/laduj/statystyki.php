<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do ładowanie posdtawowych statystyk Black Mina
	
	Black Min cms,
	
	#plik: 1.1
*/


	
	function statystyki_liczba_odwiedzin() {
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
				sprintf("SELECT * FROM `".$prefix_table."bm_statystyki_strony` WHERE `date` = '$date'"))) {
					
					$row = mysqli_fetch_assoc($rezultat);
					$liczba_odwiedzin = $row['liczba_odwiedzin'];
				};	
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		}
		
		return $liczba_odwiedzin;
	}

	function statystyki_liczba_unikalnych_odwiedzin() {
		global $host, $db_user, $db_password, $db_name, $prefix_table, $polaczenie, $rezultat, $date, $date2, $date3, $date4, $time, $time2;
		
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
				sprintf("SELECT * FROM `".$prefix_table."bm_statystyki_strony` WHERE `date` = '$date'"))) {
					$row = mysqli_fetch_assoc($rezultat);
					$liczba_unikalnych_odwiedzin = $row['liczba_unikalnych_odwiedzin'];
				};	
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		}
		
		return $liczba_unikalnych_odwiedzin;
	}
	
	function statystyki_liczba_unikalnych_odwiedzin_dzisiaj() {
		global $host, $db_user, $db_password, $db_name, $prefix_table, $polaczenie, $rezultat, $date, $date2, $date3, $date4, $time, $time2;
		
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
				sprintf("SELECT * FROM `".$prefix_table."bm_statystyki_strony` WHERE `date` = '$date'"))) {		
					$row = mysqli_fetch_assoc($rezultat);
					$liczba_unikalnych_odwiedzin_dzisiaj = $row['liczba_unikalnych_odwiedzin_dzisiaj'];
				};		
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		}
		
		return $liczba_unikalnych_odwiedzin_dzisiaj;
	}
	
	function statystyki_suma_odwiedzin() {
		global $host, $db_user, $db_password, $db_name, $prefix_table, $polaczenie, $rezultat, $date, $date2, $date3, $date4, $time, $time2;
		
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
				sprintf("SELECT sum(`liczba_odwiedzin`) AS `suma_odwiedzin` FROM `".$prefix_table."bm_statystyki_strony`"))){
					$row = mysqli_fetch_assoc($rezultat);
					$suma_odwiedzin = $row['suma_odwiedzin'];
				};		
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		}
		
		return $suma_odwiedzin;
	}

	function statystyki_ile_postow() {
		global $host, $db_user, $db_password, $db_name, $prefix_table, $polaczenie, $rezultat, $date, $date2, $date3, $date4, $time, $time2;
		
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
				sprintf("SELECT * FROM `".$prefix_table."bm_data_posty` WHERE `status` LIKE 'public'"))){
					$ile_postow = mysqli_num_rows($rezultat);
				};	
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		}
		
		return $ile_postow;
	}
	
	function statystyki_ile_online() {
		global $host, $db_user, $db_password, $db_name, $prefix_table, $polaczenie, $rezultat, $date, $date2, $date3, $date4, $time, $time2;
		
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
				sprintf("SELECT * FROM `".$prefix_table."bm_uzytkownicy` WHERE `online` LIKE 'online'"))){
					$ile_online = mysqli_num_rows($rezultat);	
				};		
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		}
		
		return $ile_online;
	}

?>