<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do usuwanie niepoczebnych bibliotek
	
	Black Min cms,
	
	#plik: 1.1
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	require_once "../laduj/class-get-ustawienia.php";
	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	$url_serwera_bm = $ustawienia_bm["bm_url_server"];
	
	// sprawdzenia czy coś przyszło do pliku 
	// usuwanie wybranych plików po id pliku
	// tworzenie odpowiedniego skryptu który schowa plik żeby użytkownik wiedział że usunięcie się powiodło

	// funkcjia do usuwania folderów wraz z całą zawartośćią folderu
	function removeDir($path) {
		$dir = new DirectoryIterator($path);
		foreach ($dir as $fileinfo) {
			if ($fileinfo->isFile() || $fileinfo->isLink()) {
				unlink($fileinfo->getPathName());
			} elseif (!$fileinfo->isDot() && $fileinfo->isDir()) {
				removeDir($fileinfo->getPathName());
			}
		}
	rmdir($path);
	}
	
	if(isset($_POST['usun_biblioteke']))
	{
		$bm_biblioteka = $_POST['usun_biblioteke'];
		
		$katalog = "../../../a/biblioteki/$bm_biblioteka";
		
		if (removeDir($katalog)) {
			echo '
				<section class="tsr tsr-alert tsr-alert-error">
					Kod błędu: [ERROR_DELETE_FILE] - Błąd podczas usuwania biblioteki!
				</section>
			';		  			
		}else{
			
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

					// usuwanie z bazy danych odpowieniego rekordu (biblioteki)

					if ($rezultat = @$polaczenie->query(
					sprintf("DELETE FROM `".$prefix_table."bm_postmeta` WHERE `bm_nazwa` LIKE '$bm_biblioteka' AND `bm_kontent` = 'biblioteka'")
					 ))
					{

						echo '
							<section class="tsr tsr-alert tsr-alert-success">
								biblioteka została usunięta poprawnie!
							</section>
						';
										
						echo '
							<script type="text/javascript">
							var hiden_post = $("[data-id-post='."'".$bm_biblioteka."'".']");
									
							$(hiden_post).delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500);
							</script>
						';
						
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