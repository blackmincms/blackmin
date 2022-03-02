<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do zmieniania folderu pluginu
	
	Black Min cms,
	
	#plik: 2.0
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";

	if (isset($_POST["name"])) {
		if (isset($_POST["content"])) {
			// sprawdzanie czy dane są do usunięcja
			$t = count($_POST["content"]);
			if ($t === 0) {
				echo json_encode(["status" => "info", "message" => "Brak danych do zmiany."]);
				exit();
			}else {
				global $db_bm;
				$a = $db_bm->parse($_POST["content"]);
				$a = $db_bm->valid($a);
				$nazwa_folderu = $db_bm->valid($_POST["rename"]);
			
				// ustawienie odpowiedniej daty do zapisu
				$datetime = date('Y-m-d H:i:s"');
				// usuwanie danych
				if ($db_bm->update("UPDATE `_prefix_bm_filemeta` SET `bm_folder`='$nazwa_folderu', `bm_datetime_zmiany` = '$datetime' WHERE `id` IN ($a)")) {
					echo json_encode(["status" => "success", "message" => "Nazwa folderu pliku została poprawnie zmieniona!"]);
					exit();
				}else {
					echo json_encode(["status" => "error", "message" => "Wystąpił Błąd podczas zmieniania nazwy folderu pliku."]);
					exit();
				}
			}
		}else{
			echo json_encode(["status" => "info", "message" => "Brak danych do zmiany."]);
			exit();
		}
	} else {
		echo json_encode(["status" => "error", "message" => "Brak danych wejśćiowych."]);
		exit();
	}

?>