<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do zmieniania folderu pluginu
	
	Black Min cms,
	
	#plik: 1.2
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// sprawdzenia czy coś przyszło do pliku 
	
	if(isset($_POST['pliki']))
	{
		$pliki = $_POST['pliki'];
		
		$nazwa_folderu = $_POST['nazwa_folderu'];
		
		// filtrowanie danych
		if	($db_bm->parse($pliki)) {
			$pliki = $db_bm->valid($db_bm->parse($pliki));
		}else{
			$pliki = $db_bm->valid($pliki);
		}
		$nazwa_folderu = $db_bm->valid($nazwa_folderu);
		
		// ustawienie odpowiedniej daty do zapisu
		$datetime = date('Y-m-d H:i:s"');
		
		// aktulizacja nazwy folderu
		$new_folders = $db_bm->update("UPDATE `_prefix_bm_filemeta` SET `bm_folder`='$nazwa_folderu', `bm_datetime_zmiany` = '$datetime' WHERE `id` IN ($pliki)");
		
		if($new_folders){
			echo '
				<section class="tsr tsr-alert tsr-alert-success tsr-alert-close">
						Nazwa folderu pliku została poprawnie zmieniona!
					</section>
				';
		}else{
			echo '
				<section class="tsr tsr-alert tsr-alert-error">
					Kod błędu: [ERROR_RENAME_FOLDERS_FILE] - Błąd podczas zmieniania nazwy folderu pliku!
				</section>
			';
		}
		
	}		
	
?>