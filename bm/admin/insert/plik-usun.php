<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do usuwania pliku wgranego na serwer
	
	Black Min cms,
	
	#plik: 1.2
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	
	// sprawdzenia czy coś przyszło do pliku 
	// usuwanie wybranych rekordów po id rekordu
	// tworzenie odpowiedniego skryptu który schowa rekord żeby użytkownik wiedział że usunięcie się powiodło
	
	if(isset($_POST["pliki"])){
		
		// validacja danych
		$pliki = $_POST["pliki"];
		$id =  $db_bm->valid($_POST["iot"]);
		
		// zliczanie tablicy
		$ile = count($pliki);
		
		// zmienna przechowywuje status poprawności operacji
		$is_ok = true;
		$count_check_sum = 0;
		
		// główna ścieżka
		$real_path = realpath("../../../") . "/";
		
		for($i = 0; $i < $ile; $i++){
			// validate
			$path_file = $db_bm->valid(str_replace(BM_SETTINGS["url_server"], $real_path, $pliki[$i]["path"]));
			$path_thumbnail =$db_bm->valid(str_replace(BM_SETTINGS["url_server"], $real_path, $pliki[$i]["thumbnail"]));
			
			if(file_exists($path_file)){
				if(@unlink($path_file)){
					// sprawdzanie czy miniaturka istnieje
					if($pliki[$i]["thumbnail"] != "null"){
						if(file_exists($path_thumbnail)){
							@unlink($path_thumbnail);
						}else{
							$is_ok = false;
						}
					}
				}else{
					$is_ok = false;
				}
				
				// check sum count
				$count_check_sum++;
			}else{
				$is_ok = false;
			}
		}
		
		// sprawdzanie czy nie ma błlędów pod czas usuwania plików
		if($is_ok === true){
			if($db_bm->delete("DELETE FROM `_prefix_bm_filemeta` WHERE `id` IN (". $id .")")){
				echo '
					<section class="tsr tsr-alert tsr-alert-success">
						Usunięto '. $ile .' plik(ów) poprawnie!
					</section>
				';	
				echo '<script type="text/javascript">removeElements();</script>';
			}else{
				echo '
					<section class="tsr tsr-alert tsr-alert-error">
						Kod błędu: [ERROR_DELETE_FILE] - Błąd podczas usuwania plik(ów)!
					</section>
				';		
			}
		}else{
			// sprawdzanie czy suma kontrolna wynosi zero
			if($count_check_sum === 0){
				// sprawdzanie czy usunięto już dane
				if($db_bm->query("SELECT `id` FROM `_prefix_bm_filemeta` WHERE `id` IN (". $id .")")["num_rows"] != 0){
					if($db_bm->delete("DELETE FROM `_prefix_bm_filemeta` WHERE `id` IN (". $id .")")){
						echo '
							<section class="tsr tsr-alert tsr-alert-success">
								Usunięto pliki poprawnie!
							</section>
						';	
						echo '<script type="text/javascript">removeElements();</script>';
					}else{
						echo '
							<section class="tsr tsr-alert tsr-alert-error">
								Kod błędu: [ERROR_DELETE_FILE] - Błąd podczas usuwania plik(ów)!
							</section>
						';		
					}
				}else{
					echo '
						<section class="tsr tsr-alert tsr-alert-info">
							Plik(i) zostały już usunięte!
						</section>
					';						
				}
			}else{
				echo '
					<section class="tsr tsr-alert tsr-alert-error">
						Kod błędu: [ERROR_DELETE_FILE] - Błąd podczas usuwania plik(ów)!
					</section>
				';			
			}
		}
		
	}		
	
?>