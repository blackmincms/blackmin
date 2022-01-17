<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do dodawania biblioteki przez admina
	
	Black Min cms,
	
	#plik: 1.1
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['nazwa_biblioteka']))
	{
		// pobieranie danych metodą post
		
		$nazwa_biblioteka = $_POST['nazwa_biblioteka'];
		$edt_biblioteka = $_POST['edt_biblioteka'];

		$nazwa_biblioteka = htmlentities($nazwa_biblioteka, ENT_QUOTES, "UTF-8");
		$edt_biblioteka = htmlentities($edt_biblioteka, ENT_QUOTES, "UTF-8");
		
		$wszystko_ok = true;

		// tworzenie tablicy do przechowywania nazw folderów pluginów black min'a
		$all_katolog = [];
		
		// pobieranie aktualnej daty i godziny
		$datetime = date('d.m.Y H:i');
		
		// pobieranie wszystkich folderów w pluginach
		foreach (glob('../../../a/biblioteki/*', GLOB_ONLYDIR) as $katalog) {
			$katalog_reserch = explode("/", $katalog);
			array_push($all_katolog, $katalog_reserch[5]);
			
		}		
		
		// zliczanie wszystkich folderów w pluginie
		$zlicz_folder = count($all_katolog);
		
		// sprawdzenie czy w pluginach jest folder z szukanym pluginem
		for($i=0;$i<$zlicz_folder;$i++){	
			if($nazwa_biblioteka == $all_katolog[$i]){
				$i += 99999999;
				$wszystko_ok = true;
			}else{
				$wszystko_ok = false;
			}
		}		
			
		if ($wszystko_ok == false){
			echo '<section class="tsr-alert tsr-alert-error">Nie Istnieje Biblioteka O Nazwie('.$nazwa_biblioteka.')<section>';
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
				sprintf("SELECT * FROM `".$prefix_table."bm_postmeta` WHERE `bm_kontent` LIKE 'Biblioteka' AND `bm_nazwa` LIKE '$nazwa_biblioteka'")
				 ))
				{
				
					$ile_url = mysqli_num_rows($rezultat);
					
					if($ile_url >= "1"){
						echo '<section class="tsr-alert tsr-alert-error">Nie może być więcej niż jeden taka sama biblioteka('.$nazwa_biblioteka.')<section>';
						$wszystko_ok = false;
					}
				}			

				
				if ($wszystko_ok == true)
				{

					if ($polaczenie->query("INSERT INTO `".$prefix_table."bm_postmeta` VALUES (NULL, 'biblioteka', '$nazwa_biblioteka', 'OFF, $datetime')"))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Nowa biblioteka('.$nazwa_biblioteka.') - Została Dodana. </section>';
					}else{
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