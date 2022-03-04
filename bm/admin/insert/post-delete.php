<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do usuwania jakiegoś posta bm
	
	Black Min cms,
	
	#plik: 2.0
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	if (isset($_POST["name"])) {
		if ($_POST["name"] == "post") {
			if (isset($_POST["content"])) {
				// sprawdzanie czy dane są do usunięcja
				$t = count($_POST["content"]);
				if ($t === 0) {
					echo json_encode(["status" => "info", "message" => "Brak danych do usunięcja."]);
					exit();
				}else {
					global $db_bm;
					$a = $db_bm->parse($_POST["content"]);
					$a = $db_bm->valid($a);
					// usuwanie danych
					if ($db_bm->delete("DELETE FROM `bm_data_posty` WHERE `id` IN (". $a .")")) {
						echo json_encode(["status" => "success", "message" => "Dane zostały usunięte!"]);
						exit();
					}else {
						echo json_encode(["status" => "error", "message" => "Wystąpił błąd pod czas usuwania danych."]);
						exit();
					}
				}
			}else{
				echo json_encode(["status" => "info", "message" => "Brak danych do usunięcja."]);
				exit();
			}
		}else{
			echo json_encode(["status" => "error", "message" => "Błędne danye wejśćiowye."]);
			exit();
		}
	} else {
		echo json_encode(["status" => "error", "message" => "Brak danych wejśćiowych."]);
		exit();
	}
	
?>