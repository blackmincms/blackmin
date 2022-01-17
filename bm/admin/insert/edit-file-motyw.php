<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do edytowania plików motywu
	
	Black Min cms,
	
	#plik: 1.1
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['edit_file_theme']))
	{
		// pobieranie danych metodą post
		
		$edit_file_theme = $_POST['edit_file_theme'];
		$save_file = $_POST['save_file'];
		$theme_active_bm = $_POST['theme_active_bm'];

		// uchwyt pliku, otwarcie do dopisania
		$file_open = fopen("../../../a/motywy/".$theme_active_bm."/". $save_file, "w");

		// blokada pliku do zapisu
		flock($file_open, 2);

		// zapisanie danych do pliku
		fwrite($file_open, $edit_file_theme);

		// odblokowanie pliku
		flock($file_open, 3);

		// zamknięcie pliku
		fclose($file_open);	

		echo '
			<section class="tsr-alert tsr-alert-success">
				Dane w Pliku('.$save_file.') zostały zmienione poprawnie!
			</section>
		';		
		
	}
	
?>