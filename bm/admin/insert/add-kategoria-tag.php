<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do dodawanie nowei kategori tagów przez admina
	
	Black Min cms,
	
	#plik: 1.1
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['tytul_KT']))
	{
		// pobieranie danych metodą post
		
		$tytul_KT = $_POST['tytul_KT'];
		$tytul_skrucony_KT = $_POST['tytul_skrucony_KT'];
		$kategoria_KT = $_POST['kategoria_KT'];
		$opis_KT = $_POST['opis_KT'];

		$tytul_KT = htmlentities($tytul_KT, ENT_QUOTES, "UTF-8");
		$tytul_skrucony_KT = htmlentities($tytul_skrucony_KT, ENT_QUOTES, "UTF-8");
		$kategoria_KT = htmlentities($kategoria_KT, ENT_QUOTES, "UTF-8");
		$opis_KT = htmlspecialchars($opis_KT, ENT_QUOTES, "UTF-8");
		
		
		$wszystko_ok = true;
		
		
		if ((strlen($tytul_KT)<1) || (strlen($tytul_KT)>4096))
		{
			$wszystko_ok = false;
		}
		
		if ((strlen($tytul_skrucony_KT )<1) || (strlen($tytul_skrucony_KT )>4096))
		{
			$wszystko_ok = false;
		}
		
		if ((strlen($kategoria_KT)<1) || (strlen($kategoria_KT)>4096))
		{
			$wszystko_ok = false;
		}
		
		if ((strlen($opis_KT )<1) || (strlen($opis_KT )>4096))
		{
			$wszystko_ok = false;
		}
		
		if($kategoria_KT == "kategoria" OR "tag"){
			
		}else{
			echo '<section class="tsr-alert tsr-alert-error">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań w innym terminie!<section>';
			$wszystko_ok = false;
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

				// sprawdzanie czy nie istnieje taki sam rekord w bazie danych

				if ($rezultat = @$polaczenie->query(
				sprintf("SELECT * FROM `".$prefix_table."bm_metaposty` WHERE `bm_nazwa` LIKE '$tytul_KT' AND `bm_skr_nazwa` LIKE '$tytul_skrucony_KT' AND `bm_opis` LIKE '$opis_KT' AND `bm_KT` LIKE '$kategoria_KT'")
				 ))
				{
				
					$ile_url = mysqli_num_rows($rezultat);
					
					if($ile_url >= "1"){
						echo '<section class="tsr-alert tsr-alert-error">Nie może być więcej niż jeden taki sam Kategoria/Tag<section>';
						$wszystko_ok = false;
					}
				}			
				
				
				if ($wszystko_ok == true)
				{

					if ($polaczenie->query("INSERT INTO `".$prefix_table."bm_metaposty` VALUES (NULL, '$tytul_KT', '$tytul_skrucony_KT', '$opis_KT', '$kategoria_KT')"))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Kategoria/Tag - Został Dodany. </section>';
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
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