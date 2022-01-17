<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do aktywacji/dezaktywacji pluginu przez admina
	
	Black Min cms,
	
	#plik: 1.2.1
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";
	require_once "../../../connect.php";
	
	// sprawdzenia czy coś przyszło do pliku 
	// usuwanie wybranych plików po id pliku
	// tworzenie odpowiedniego pluginu który schowa plik żeby użytkownik wiedział że usunięcie się powiodło
	
	if(isset($_POST['aktywuj_plugin']))
	{
		$aktywuj_plugin = $_POST['aktywuj_plugin'];
		$aktywuj_plugin_full = $_POST['aktywuj_plugin_full'];
		$aktywny_plugin = $_POST['aktywny_plugin'];
		
		// filtrowanie danych
		$aktywuj_plugin = htmlentities($aktywuj_plugin, ENT_QUOTES, "UTF-8");	
		$aktywny_plugin = htmlentities($aktywny_plugin, ENT_QUOTES, "UTF-8");	
		// usuwanie (spacji, tablulacji)
		$aktywuj_plugin = trim($aktywuj_plugin);
		
		// rozkładanie na czyniki pierwsze struktury menu głównego for id
		$bm_plugin = json_decode($bm_ustawienia["bm_plugin"], true);	
		
		// przeprowadzanie operacji na tablicy z aktywnymi pluginami
		if($aktywny_plugin == "false"){
			$bm_plugin_ = [
				"plugin_full" => $aktywuj_plugin_full,
				"plugin" => $aktywuj_plugin,
			];
			array_push($bm_plugin, $bm_plugin_);
		}elseif($aktywny_plugin == "true"){
			// szukanie w tablicy nazwy pluginu do dezaktywowania
			$id_plugin = array_search($aktywuj_plugin_full, array_column($bm_plugin, "plugin_full"));
			// usuwanie nazy pluginu z tablicy
			array_splice($bm_plugin, $id_plugin, 1);
		}else{
			echo '
				<section class="tsr tsr-alert tsr-alert-error">
					Kod błędu: [ERROR_ACTIVATE_PLUGIN] - Błąd podczas aktywacji/dezaktywacji pluginu!
				</section>
			';
		}
		
		// enkodowanie danych z aktywnymi pluginami
		$bm_plugin = json_encode($bm_plugin);
		
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

				//Hurra, wszystkie testy zaliczone, aktulizujemy rekord			
				if ($rezultat = $polaczenie->query(
				sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$bm_plugin' WHERE `bm_nazwa` = 'bm_wtyczka'")
				 ))
				{
					// pokazywanie odpowiedniego komunikatu
					if($aktywny_plugin == "false"){
						echo '
							<section class="tsr tsr-alert tsr-alert-success">
								Plugin został aktywowany poprawnie!
							</section>
							<meta http-equiv="refresh" content="2">
						';	
					}else{
						echo '
							<section class="tsr tsr-alert tsr-alert-success">
								Plugin został dezaktywowany poprawnie!
							</section>
							<meta http-equiv="refresh" content="2">
						';								
					}
				};
				
				$polaczenie->close();
			}
			
		}
		
          
		catch(Exception $e)
		{
			echo '
				<section class="tsr tsr-alert tsr-alert-error">
					Kod błędu: [ERROR_ACTIVATE_PLUGIN] - Błąd podczas aktywacji/dezaktywacji pluginu!
				</section>
			';	
		}			
			
	}
	
?>