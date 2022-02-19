<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do zapisywania pliku przesłanego przez użytkownika
	
	Black Min cms,
	
	#plik: 1.2.1
*/
	// sprawdzamy czy plik został przesłany na serwera
	if(isset($_FILES['file'])) {
	
		// ładowanie jądra black mina
		require_once "../black-min.php";
	
		require_once "../../../connect.php";
		require_once "../laduj/class-get-ustawienia.php";
		
		$url_serwera_bm = BM_SETTINGS["url_server"];
		
		// pobieranie id autora pliku
		$autor_id = $_SESSION['id'];
		
		// ustawianie dat dla upload pliku
		$date_miesac = date('m');
		$date_rok = date('Y');
		$date = date('d-m-Y');
		$date2 = date('Y-m-d H:i');
		
		// Podawanjie ścieżki do zapisu 
		$target_dir = realpath("../../../")."/pliki/uploads/";
		$target_dir2 = realpath("../../../")."/pliki/uploads/";
		$target_dir_www = BM_SETTINGS["url_server"]."pliki/uploads/";
		
		// sprawdzanie czy katalog z rokiem został stworzony
		// jeżeli tak potwierdza 
		// jeżeli nie tworzy go
		
		if (is_dir($target_dir . $date_rok)) {
			
			// sprawdzenie czy plik z miesiącem został stworzony 
			// jeżeli tak potwierdza 
			// jeżeli nie tworzy go
			if (file_exists($target_dir . $date_rok . "/" . $date_miesac . "/")) {
				
			}else {
				mkdir($target_dir . $date_rok . "/" . $date_miesac . "/", 0777);
			}
		}else{
			
			// tworzenie pliku roku uploudu
			mkdir($target_dir . $date_rok, 0777);
			
			// sprawdzenie czy plik z miesiącem został stworzony 
			// jeżeli tak potwierdza 
			// jeżeli nie tworzy go
			if (file_exists($target_dir . $date_rok . "/" . $date_miesac . "/")) {
				
			}else {
				mkdir($target_dir . $date_rok . "/" . $date_miesac . "/", 0777);
			}		
		}
		
		// sprawdzenie czy folder na miniaturki istnieje // jeżeli tak to lecimy dalej jeżeli nie tworzymy go
		if (is_dir($target_dir . "miniaturs_" . $date_rok)) {
			
			// sprawdzenie czy plik z miesiącem został stworzony 
			// jeżeli tak potwierdza 
			// jeżeli nie tworzy go
			if (file_exists($target_dir . "miniaturs_" . $date_rok . "/" . $date_miesac . "/")) {
				
			}else {
				mkdir($target_dir . "miniaturs_" . $date_rok . "/" . $date_miesac . "/", 0777);
			}
		}else{
			
			// tworzenie pliku roku uploudu
			mkdir($target_dir . "miniaturs_" . $date_rok, 0777);
			
			// sprawdzenie czy plik z miesiącem został stworzony 
			// jeżeli tak potwierdza 
			// jeżeli nie tworzy go
			if (file_exists($target_dir . "miniaturs_" . $date_rok . "/" . $date_miesac . "/")) {
				
			}else {
				mkdir($target_dir . "miniaturs_" . $date_rok . "/" . $date_miesac . "/", 0777);
			}		
		}
		
		//zamiana nazwy pliku i sprawdzenie poprawnośći w nazwie pliku
		$file_name = $_FILES["file"]["name"];
		$replace_file_name = str_replace(" ","-",$_FILES["file"]["name"]);
		
		// pobieranie nazwy pliku
		$target_file = $target_dir . $date_rok . "/" . $date_miesac . "/". basename($replace_file_name);
		$target_file_miniaturs = $target_dir . "miniaturs_" . $date_rok . "/" . $date_miesac . "/" . basename($replace_file_name);
		$target_file2 = $target_dir2 . $date_rok . "/" . $date_miesac . "/". basename($_FILES["file"]["name"]);
		$target_file2_miniaturs = $target_dir2 . "miniaturs_" . $date_rok . "/" . $date_miesac . "/". basename($_FILES["file"]["name"]);
		$target_file_http = $target_dir_www . $date_rok . "/" . $date_miesac . "/". basename($_FILES["file"]["name"]);
		$target_file_miniaturs_http = $target_dir_www . "miniaturs_" . $date_rok . "/" . $date_miesac . "/". basename($_FILES["file"]["name"]);
		
		// ustawienie zmienej do sprawdzenia walidacj
		$uploadOk = 1;
		
		// sprawdzenie typu pliku (roszerzenia)
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		// Check if image file is a actual image or fake image
		if(isset($_FILES["file"])) {
			$check = getimagesize($_FILES["file"]["tmp_name"]);
		}
		
		// Check if file already exists
		if (file_exists($target_file)) {
			//echo "Przepraszamy, ale plik już istnieje.";
			$t = ["result" => "error", "message" => "Plik już istnieje! > ". basename($_FILES["file"]["name"])];
			echo json_encode($t);
			$uploadOk = 0;
			// zwracanie wyniku
			exit();
		}
		// Check file size
		if ($_FILES["file"]["size"] > 5000000) {
			//echo "Twój plik jest za duży.";
			$t = ["result" => "error", "message" => "Twój plik jest za duży! > ". basename($_FILES["file"]["name"])];
			echo json_encode($t);
			$uploadOk = 0;
			// zwracanie wyniku
			exit();			
		}

		// ustawienie zmienej pliku do przesłania
		$plik_wysli = $_FILES["file"]["tmp_name"];
		
		// pobieranie rozszerzenia pliku
		$rozszerzenie = $_FILES["file"]['type'];
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$t = ["result" => "error", "message" => "Plik nie został przesłany! > ". basename($_FILES["file"]["name"])];
			echo json_encode($t);		

			// zwracanie wyniku
			exit();
			
		// if everything is ok, try to upload file
		}else{
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {	
		
				// zamiana pustego miejsca pomiędzy znakami na "-" w scieżce
				$target_file3 = str_replace(" ","-",$target_file2);
				$target_file3_miniaturs = str_replace(" ","-",$target_file2_miniaturs);
				
				$target_file_http = str_replace(" ","-",$target_file_http);
				$target_file_miniaturs_http = str_replace(" ","-",$target_file_miniaturs_http);
				
				// odcinanie głównego roszerzenia pliku
				$reserch_roszerzenie = explode("/", $rozszerzenie);
				
				// tworzenie miniaturki wtedy gdy mam doczynienia z plikiem img
				if ($reserch_roszerzenie[0] == "image"){
				
					// Sprawdzanie roszerzenia obrazka i otwieranie odpowiednio go otwieramy
					if ($reserch_roszerzenie[1] == "gif"){
						$image = imagecreatefromgif($target_file);
					}
					
					if ($reserch_roszerzenie[1] == "png"){
						$image = imagecreatefrompng($target_file);
					}
					
					if ($reserch_roszerzenie[1] == "bmp"){
						$image = imagecreatefrombmp($target_file);
					}
					
					if ($reserch_roszerzenie[1] == "jpg" or $reserch_roszerzenie[1] == "jpeg" or $reserch_roszerzenie[1] == "jpe"){
						$image = imagecreatefromjpeg($target_file);
					}
					
					// wczytujemy zdjęcie do uchwytu
					 
					$image_width = imagesx($image);
					 
					$image_height = imagesy($image);
					 
					// pobieramy rozmiar oryginalnego obrazu
					 
					$new_width = 250;
					 
					$new_height = 170;
					 
					// definiujemy rozmiar dla nowego obrazu
					 
					$new_image = imagecreatetruecolor($new_width, $new_height);
					 
					// tworzymy uchwyt dla nowego obrazu
					 
					imagecopyresized($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
					 
					// kopiujemy, narazie bez zmiany parametrów
					 
					header("Content-type: image/jpg");
					 
					// definiujemy nagłówek z mimetype
					 
					//imagepng($new_image);
					if(imagejpeg($new_image, $target_file_miniaturs, 88)){
					}
				
				}else{
					// zwracanie null jeżeli nie znaleziono dopasowanego roszerzenia
					
					$target_file3_miniaturs = "null";
					$target_file_miniaturs_http = "null";
				}
				
				
				// dodawanie nowego rekordu do bazy danych dysku
				// jeżeli przeszedł poprawną walidacjie
				
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
			
						
						// jeżeli wszystkie testy walidacyjne przeszły pomyśnie to dodajemy nowy post
						// wyśiwtlamy informacje dla użytkownika że post został dodany do bazy danych
						

						//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
						
						if ($polaczenie->query("INSERT INTO `".$prefix_table."bm_filemeta` VALUES (NULL, '$autor_id', '$file_name', '$replace_file_name', '$date2', '$date2', '', '$rozszerzenie', '$target_file_miniaturs_http', 'domyśny', '$target_file_http')"))
						{
							
							$t = ["result" => "success", "message" => "Plik został przesłany! > ". basename($_FILES["file"]["name"])];
							echo json_encode($t);	
							
						}else{
							throw new Exception($polaczenie->error);
						}
						
						$polaczenie->close();
					}
					
				}
				
				  
				catch(Exception $e)
				{
					
					$t = ["result" => "error", "message" => "Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań w później!"];
					echo json_encode($t);						
				}						
				
			} else {

				$t = ["result" => "error", "message" => "Wystąpił błąd podczas przesyłania pliku."];
				echo json_encode($t);					
			}
		}	
	} else {
		
		$t = ["result" => "error", "message" => "Wystąpił błąd podczas przesyłania pliku...."];
		echo json_encode($t);			
	}
	
?>