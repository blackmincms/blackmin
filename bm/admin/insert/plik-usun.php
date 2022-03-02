<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do usuwania pliku wgranego na serwer
	
	Black Min cms,
	
	#plik: 2.0
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	if (isset($_POST["name"])) {
		if ($_POST["name"] == "dysk") {
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

					if ($x = $db_bm->query("SELECT `id`, `bm_sciezka`, `bm_miniaturka`, `bm_nazwa` FROM `|prefix|bm_filemeta` WHERE `id` IN (". $a .")")) {
						if ($x["num_rows"] != 0) {
							$is_ok = true;
							$count_check_sum = 0;
							$error_del = "";
							
							// główna ścieżka
							$real_path = realpath("../../../") . "/";
							
							for($i = 0; $i < $t; $i++){
								// validate
								$path_file = $db_bm->valid(str_replace(BM_SETTINGS["url_server"], $real_path, $x[$i]["bm_sciezka"]));
								$path_thumbnail =$db_bm->valid(str_replace(BM_SETTINGS["url_server"], $real_path, $x[$i]["bm_miniaturka"]));
								
								if(file_exists($path_file)){
									if(@unlink($path_file)){
										// sprawdzanie czy miniaturka istnieje
										if($x[$i]["bm_miniaturka"] != "null"){
											if(file_exists($path_thumbnail)){
												@unlink($path_thumbnail);
											}else{
												$error_del .= $x[$i]["bm_nazwa"] . " ,";
												$is_ok = false;
											}
										}
									}else{
										$error_del .= $x[$i]["bm_nazwa"] . " ,";
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
								// usuwanie danych
								if ($db_bm->delete("DELETE FROM `_prefix_bm_filemeta` WHERE `id` IN (". $a .")")) {
									echo json_encode(["status" => "success", "message" => "Usunięto '. $t .' plik(ów) poprawnie!"]);
									exit();
								}else {
									echo json_encode(["status" => "error", "message" => "Wystąpił błąd pod czas usuwania danych."]);
									exit();
								}
							}else{
								// sprawdzanie czy suma kontrolna wynosi zero
								if($count_check_sum === 0){
									// sprawdzanie czy usunięto już dane
									if($db_bm->query("SELECT `id` FROM `_prefix_bm_filemeta` WHERE `id` IN (". $a .")")["num_rows"] != 0){
										if($db_bm->delete("DELETE FROM `_prefix_bm_filemeta` WHERE `id` IN (". $a .")")){
											echo json_encode(["status" => "success", "message" => "Usunięto '. $t .' plik(ów) poprawnie!"]);
											exit();
										}else{
											echo json_encode(["status" => "error", "message" => "Wystąpił błąd pod czas usuwania danych."]);
											exit();
										}
									}else{
										echo json_encode(["status" => "info", "message" => "Plik(i) zostały już usunięte!"]);
										exit();					
									}
								}else{
									echo '
										<section class="tsr tsr-alert tsr-alert-error">
											Kod błędu: [ERROR_DELETE_FILE] - Błąd podczas usuwania plik(ów)!
										</section>
									';			
								}
							}
						} else {
							echo json_encode(["status" => "info", "message" => "Brak danych do usunięcja."]);
							exit();
						}
					} else {
						echo json_encode(["status" => "error", "message" => "Wystąpił błąd pod czas zapytania do bazy danych."]);
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