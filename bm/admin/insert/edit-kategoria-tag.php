<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do edytowania kategori tagów przez admina
	
	Black Min cms,
	
	#plik: 1.1
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['tytul_KT']))
	{
		// pobieranie danych metodą post
		
		$id_KT = $_POST['id_KT'];
		
		$tytul_KT_spr = $_POST['tytul_KT_spr'];
		$tytul_skrucony_KT_spr = $_POST['tytul_skrucony_KT_spr'];
		$KT_KT_spr = $_POST['KT_KT_spr'];
		$opis_KT_spr = $_POST['opis_KT_spr'];

		$tytul_KT = $_POST['tytul_KT'];
		$tytul_skrucony_KT = $_POST['tytul_skrucony_KT'];
		$KT_KT = $_POST['kategoria_KT'];
		$opis_KT = $_POST['opis_KT'];

		$tytul_KT = htmlentities($tytul_KT, ENT_QUOTES, "UTF-8");
		$tytul_skrucony_KT = htmlentities($tytul_skrucony_KT, ENT_QUOTES, "UTF-8");
		$KT_KT = htmlentities($KT_KT, ENT_QUOTES, "UTF-8");
		$opis_KT = htmlspecialchars($opis_KT, ENT_QUOTES, "UTF-8");	
		
		$wszystko_ok = true;
		
		if (($tytul_KT == $tytul_KT_spr) AND ($tytul_skrucony_KT == $tytul_skrucony_KT_spr) AND ($KT_KT == $KT_KT_spr) AND ($opis_KT == $opis_KT_spr)) {
			echo '<section class="tsr-alert tsr-alert-info"> Chyba by wypadało coś zmienić! Nie sądzisz? </section>';
			$wszystko_ok = false;
			exit();
		}
		
		if ((strlen($tytul_KT)<1) || (strlen($tytul_KT)>4096))
		{
			$wszystko_ok = false;
		}
		
		if ((strlen($tytul_skrucony_KT )<1) || (strlen($tytul_skrucony_KT )>4096))
		{
			$wszystko_ok = false;
		}
		
		if ((strlen($KT_KT)<1) || (strlen($KT_KT)>4096))
		{
			$wszystko_ok = false;
		}
		
		if ((strlen($opis_KT )<1) || (strlen($opis_KT )>4096))
		{
			$wszystko_ok = false;
		}
		
		if($KT_KT == "kategoria" OR "tag"){
			
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
				
				// jeżeli wszystkie testy walidacyjne przeszły pomyśnie to dodajemy nową kategorie tag
				// wyśiwtlamy informacje dla użytkownika że kategoria tag został dodany do bazy danych
				
				if ($wszystko_ok == true)
				{

					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_metaposty` SET `bm_nazwa`='$tytul_KT',`bm_skr_nazwa`='$tytul_skrucony_KT',`bm_opis`='$opis_KT',`bm_KT`='$KT_KT' WHERE `id` = '$id_KT'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Kategoria/Tag został zmieniony poprawnie! </section>';
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