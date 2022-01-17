<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do aktywacji skryptu black min
	
	Black Min cms,
	
	#plik: 1.2
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// przyłączanie poczebnych plików
	require_once "../../../connect.php";
	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	
	// sprawdzenia czy coś przyszło do pliku 
	// usuwanie wybranych plików po id pliku
	// tworzenie odpowiedniego skryptu który schowa plik żeby użytkownik wiedział że usunięcie się powiodło
	
	if(isset($_POST['aktywuj_Skrypt']))
	{
		$aktywuj_Skrypt = $_POST['aktywuj_Skrypt'];
		$date_Skrypt = $_POST['date_Skrypt'];
		$aktywny_skrypt = $_POST['aktywny_skrypt'];
		
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


				
				if($aktywny_skrypt == "false"){
				
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_postmeta` SET `bm_wartosc`='ON, $date_Skrypt' WHERE `bm_nazwa` = '$aktywuj_Skrypt' AND `bm_kontent` = 'skrypt'")
					 ))
					{
						echo '
							<section class="tsr tsr-alert tsr-alert-success">
								skrypt został aktywowany poprawnie!
							</section>
							<meta http-equiv="refresh" content="2">
						';	
					};

				}

				if($aktywny_skrypt == "true"){
				
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_postmeta` SET `bm_wartosc`='OFF, $date_Skrypt' WHERE `bm_nazwa` = '$aktywuj_Skrypt' AND `bm_kontent` = 'skrypt'")
					 ))
					{
						echo '
							<section class="tsr tsr-alert tsr-alert-success">
								skrypt został dezaktywowany poprawnie!
							</section>
							<meta http-equiv="refresh" content="2">
						';	
					};

				}
				
				$polaczenie->close();
			}
			
		}
		
          
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań w innym terminie!</span>';
			echo '
				<section class="tsr tsr-alert tsr-alert-error">
					Kod błędu: [ERROR_ACTIVATE_THEME] - Błąd podczas aktywacji/dezaktywacji skryptu!
				</section>
			';	
		}			
			
	}
	
?>