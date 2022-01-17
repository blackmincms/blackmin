<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do usuwania motywu black min
	
	Black Min cms,
	
	#plik: 1.2.1
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	require_once "../../../connect.php";
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
	
	if(isset($_POST['usun_motyw']))
	{
		$bm_motyw = $_POST['usun_motyw'];
		
		$katalog = "../../../a/motywy/" . $bm_motyw;
		
		if (removeDir($katalog)) {
			echo '
				<section class="tsr tsr-alert tsr-alert-error">
					Kod błędu: [ERROR_DELETE_FILE] - Błąd podczas usuwania motywu!
				</section>
			';	
		}else{
			echo '
				<section class="tsr tsr-alert tsr-alert-success">
					motyw został usunięty poprawnie!
				</section>
			';
							
			echo '
				<script type="text/javascript">
				var hiden_post = $("[bm-id-post='."'".$bm_motyw."'".']");
						
				$(hiden_post).delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500);
				</script>
			';
		}
				
	}	
	
?>