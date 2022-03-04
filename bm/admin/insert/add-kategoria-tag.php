<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do dodawanie nowei kategori tagów
	
	Black Min cms,
	
	#plik: 2.0
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
		
	if (isset($_POST["tytul"])) {
		// zmianna raportująca o błędach
		$ad_ok = true;
		if (isset ($_POST['tytul'])){
			$tytul = $_POST['tytul'];
		}else{
			$ad_ok = false;
		}
		
		if (isset ($_POST['tytul_skrucony'])){
			$tytul_skrucony = $_POST['tytul_skrucony'];
		}else {
			$ad_ok = false;
		}
		
		if (isset ($_POST['kategoria'])){
			$kategoria = $_POST['kategoria'];
		}else{
			$ad_ok = false;
		}
		
		if (isset ($_POST['opis'])){
			$opis = $_POST['opis'];
		}else{
			$ad_ok = false;
		}

		if ($ad_ok) {
			if ((strlen($tytul)<1) || (strlen($tytul)>4096))
			{
				$ad_ok = false;
			}
			
			if ((strlen($tytul_skrucony )<1) || (strlen($tytul_skrucony )>4096))
			{
				$ad_ok = false;
			}
			
			if ((strlen($kategoria)<1) || (strlen($kategoria)>4096))
			{
				$ad_ok = false;
			}
			
			if ((strlen($opis )<0) || (strlen($opis )>4096))
			{
				$ad_ok = false;
			}

			if ($ad_ok) {
				global $db_bm;
				$tytul = $db_bm->valid($tytul);
				$tytytul_skruconytul = $db_bm->valid($tytul_skrucony);
				$kategoria = $db_bm->valid($kategoria);
				$opis = $db_bm->valid($opis);

				$zap = $db_bm->query("SELECT * FROM `|prefix|bm_metaposty` WHERE `bm_nazwa` LIKE '$tytul' AND `bm_skr_nazwa` LIKE '$tytul_skrucony' AND `bm_opis` LIKE '$opis' AND `bm_KT` LIKE '$kategoria'");
				if ($zap["num_rows"] == 0) {
					// usuwanie danych
					if ($db_bm->insert("INSERT INTO `|prefix|bm_metaposty` VALUES (NULL, '$tytul', '$tytul_skrucony', '$opis', '$kategoria')")) {
						echo json_encode(["status" => "success", "message" => "Dane zostały dodane!"]);
						exit();
					}else {
						echo json_encode(["status" => "error", "message" => "Wystąpił błąd pod czas dodawania danych."]);
						exit();
					}
				} else {
					echo json_encode(["status" => "info", "message" => "Takie dane już istnieją!"]);
					exit();
				}
			} else {
				echo json_encode(["status" => "info", "message" => "Wprowadzone dane są za krótkie lub długie."]);
				exit();
			}
			
		}else{
			echo json_encode(["warn" => "info", "message" => "Brak danych do dodania."]);
			exit();
		}
	} else {
		echo json_encode(["status" => "error", "message" => "Brak danych wejśćiowych."]);
		exit();
	}

?>