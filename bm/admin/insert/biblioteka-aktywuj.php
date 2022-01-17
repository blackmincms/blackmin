<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do kontroli i zarządzania bibliotekami javascript w black minie
	
	Black Min cms,
	
	#plik: 1.1
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	
	// sprawdzenia czy coś przyszło do pliku 
	// usuwanie wybranych plików po id pliku
	// tworzenie odpowiedniego skryptu który schowa plik żeby użytkownik wiedział że usunięcie się powiodło
	
	if(isset($_POST['aktywuj_biblioteke']))
	{
		$aktywuj_biblioteke = $_POST['aktywuj_biblioteke'];
		$date_biblioteka = $_POST['date_biblioteka'];
		$aktywna_biblioteka = $_POST['aktywna_biblioteka'];
		
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
				
				if($aktywna_biblioteka == "false"){
				
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_postmeta` SET `bm_wartosc`='ON, $date_biblioteka' WHERE `bm_nazwa` = '$aktywuj_biblioteke' AND `bm_kontent` = 'biblioteka'")
					 ))
					{
						echo '
							<section class="tsr tsr-alert tsr-alert-success">
								biblioteka została aktywowana poprawnie!
							</section>
							<meta http-equiv="refresh" content="2">
						';	
					};

				}

				if($aktywna_biblioteka == "true"){
				
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_postmeta` SET `bm_wartosc`='OFF, $date_biblioteka' WHERE `bm_nazwa` = '$aktywuj_biblioteke' AND `bm_kontent` = 'biblioteka'")
					 ))
					{
						echo '
							<section class="tsr tsr-alert tsr-alert-success">
								biblioteka została dezaktywowana poprawnie!
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
			echo '
				<section class="tsr tsr-alert tsr-alert-error">
					Kod błędu: [ERROR_ACTIVATE_LIBRARY] - Błąd podczas aktywacji/dezaktywacji skryptu!
				</section>
			';	
		}			
			
	}
	
?>