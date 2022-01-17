<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do edytowania danych o pliku i zapisywanie bazy danych plików
	
	Black Min cms,
	
	#plik: 1.1
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// wczytywanie poczebnych plików
	require_once "../../../connect.php";
	require_once "../laduj/class-get-ustawienia.php";
	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	$url_serwera_bm = $ustawienia_bm["bm_url_server"];
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['tytul']))
	{
		// ustawienie odpowiedniej daty do zapisu
		$datetime = date('Y-m-d H:i');
		
		// pobieranie danych metodą post
		
		// pobieranie id do zmienienia
		$id_pliku = $_POST['id_pliku'];
		
		// pobieranie danych do sprawdzenia
		$tytul_spr = $_POST['tytul_spr'];
		$opis_spr = $_POST['opis_spr'];
		$folder_spr = $_POST['folder_spr'];

		// pobieranie danych do zaktulizowania w bazie danych plików
		$tytul = $_POST['tytul'];
		$opis = $_POST['opis'];
		$folder = $_POST['folder'];

		// sprawdzanie poprawnośći danych walidacja (choć nie poczebna)
		$tytul = htmlentities($tytul, ENT_QUOTES, "UTF-8");
		$folder = htmlentities($folder, ENT_QUOTES, "UTF-8");
		$opis = htmlspecialchars($opis, ENT_QUOTES, "UTF-8");	
		
		$wszystko_ok = true;
		
		
		// sprawdzenie czy dane są zmienione i ewentualnie pokazanie oszczerzenia
		if (($tytul == $tytul_spr) AND ($opis == $opis_spr) AND ($folder == $folder_spr)) {
			echo '<section class="tsr-alert tsr-alert-info"> Chyba by wypadało coś zmienić! Nie sądzisz? </section>';
			$wszystko_ok = false;
			exit();
		}
		
		// sprawdzanie długości wpisanych znaków i ewentualnie pokazanie błędu
		if ((strlen($tytul)<1) || (strlen($tytul)>424))
		{
			$wszystko_ok = false;
		}
		
		if ((strlen($folder)<1) || (strlen($folder)>424))
		{
			$wszystko_ok = false;
		}
		
		if ((strlen($opis )<1) || (strlen($opis )>1024))
		{
			$wszystko_ok = false;
		}
		
		// jęzeli walidacja przeszła pomyśnie to otwiera się połączenie z bazą danych
		
		if($wszystko_ok == true){

			// działanie na bazie danych dysku

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
					

					//Hurra, wszystkie testy zaliczone, dodajemy rekord do bazy
					
					if ($polaczenie->query("UPDATE `".$prefix_table."bm_filemeta` SET `bm_nazwa`='$tytul',`bm_datetime_zmiany`='$datetime',`bm_opis`='$opis', `bm_folder`='$folder' WHERE `id` = '$id_pliku'"))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Dane Pliku zostały zmienione poprawnie! </section>';
					}
					else
					{
						throw new Exception($polaczenie->error);
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