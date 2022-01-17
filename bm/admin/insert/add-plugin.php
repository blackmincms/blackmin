<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do dodawania pluginu przez admina
	
	Black Min cms,
	
	#plik: 1.1
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['nazwa_plugin']))
	{
		// pobieranie danych metodą post
		
		$nazwa_plugin = $_POST['nazwa_plugin'];
		$edt_plugin = $_POST['edt_plugin'];

		$nazwa_plugin = htmlentities($nazwa_plugin, ENT_QUOTES, "UTF-8");
		$edt_plugin = htmlentities($edt_plugin, ENT_QUOTES, "UTF-8");
		
		$wszystko_ok = true;

		// tworzenie tablicy do przechowywania nazw folderów pluginów black min'a
		$all_katolog = [];
		
		// pobieranie aktualnej daty i godziny
		$datetime = date('d.m.Y H:i');
		
		// pobieranie wszystkich folderów w pluginach
		foreach (glob('../../../a/pluginy/*', GLOB_ONLYDIR) as $katalog) {
			$katalog_reserch = explode("/", $katalog);
			array_push($all_katolog, $katalog_reserch[5]);
			
		}		
		
		// zliczanie wszystkich folderów w pluginie
		$zlicz_folder = count($all_katolog);
		
		// sprawdzenie czy w pluginach jest folder z szukanym pluginem
		//foreach ($all_katolog as $plik) {
		for($i=0;$i<$zlicz_folder;$i++){	
			if($nazwa_plugin == $all_katolog[$i]){
				$i += 99999999;
				$wszystko_ok = true;
			}else{
				$wszystko_ok = false;
			}
		}		
			
		if ($wszystko_ok == false){
			echo '<section class="tsr-alert tsr-alert-error">Nie Istnieje Plugin O Nazwie('.$nazwa_plugin.')<section>';
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
				sprintf("SELECT * FROM `".$prefix_table."bm_postmeta` WHERE `bm_kontent` LIKE 'plugin' AND `bm_nazwa` LIKE '$nazwa_plugin'")
				 ))
				{
				
					$ile_url = mysqli_num_rows($rezultat);
					
					if($ile_url >= "1"){
						echo '<section class="tsr-alert tsr-alert-error">Nie może być więcej niż jeden taki sam plugin('.$nazwa_plugin.')<section>';
						$wszystko_ok = false;
					}
				}			
				
				if ($wszystko_ok == true)
				{
					if ($polaczenie->query("INSERT INTO `".$prefix_table."bm_postmeta` VALUES (NULL, 'plugin', '$nazwa_plugin', 'OFF, $datetime')"))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Nowy Plugin('.$nazwa_plugin.') - Został Dodany. </section>';
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