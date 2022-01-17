<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyciągania wszystkich plików wgranych na serwer
	
	#Zawannsowane szukanie
	
	Black Min cms,
	
	#plik: 1.3
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
	require_once "cut.php";
	
	// odbieranie od skryptu metodą post informacji na temat poszukiwanych rekordów w bacie danych
	
	if (isset ($_POST['ile_load'])){
		$ile_load = $_POST['ile_load'];
	}else {
		$ile_load = "25";
	}
	
	// renderowanie odpowiedniego wyniku szukanychh informacji przez użytkownika

	// tworzenie tablicy do przechowywania nazw folderów motywów black min'a
	$all_katolog = [];
	
	// tablica do przechowywania nazw folderów w motywie
	$nazwa_katolog = [];
	
	// tworzenie tablicy odpowiedzialnej za przechowywanie danych na temat plików
	$all_plik = [];
	
	// tablica do przechowywania nazw plików w folderze
	$nazwa_plik = [];

	// tablica do przechowywania danych o zabronionych roszerzeniach
	$wyklucz_roszczerzenia = [
		'0' => "png",
		'1' => "jpg",
		'2' => "jpeg",
		'3' => "bnp",
	];
	
	$zlicz_wykluczenia = count($wyklucz_roszczerzenia);

	// dodawanie do szukania w folderze głównym
	
	// pobieranie wszystkich folderów w aktywnym motywie
	foreach (glob('../../a/motywy/'.bm_theme_active().'/*', GLOB_ONLYDIR) as $katalog) {
		$katalog_reserch = explode("/", $katalog);
		array_push($nazwa_katolog, $katalog_reserch[5]);
		
		array_push($all_katolog, $katalog);
	}
	
	// sortowanie nazw filderów od A do Zawannsowane
	$zlicz_folder = sort($all_katolog);
	
	// dodawanie do wszystkich kotalogów, katalogu domowego
	
	// zliczanie wszystkich folderów w motywie
	$zlicz_folder = count($all_katolog);

	// pętla do poierania plików z folderu domowego motywu
	foreach (glob('../../a/motywy/'.bm_theme_active().'/*.*', GLOB_MARK) as $plik) {
		$plik_reserch = explode("/", $plik);
		
		$roszerzenie_pliki = explode(".", $plik_reserch[5]);
		
		// zliczanie oczymanych wyników po 
		$zlciz_all_pliki = count($roszerzenie_pliki);
		
		// sprawdzanie czy roszerzenie pliku nie jest na czarnej liście i eventualnie usuwanie go z tablicy 
		
		if((array_search($wyklucz_roszczerzenia[0], $roszerzenie_pliki)) OR (array_search($wyklucz_roszczerzenia[1], $roszerzenie_pliki)) OR (array_search($wyklucz_roszczerzenia[2], $roszerzenie_pliki)) OR (array_search($wyklucz_roszczerzenia[3], $roszerzenie_pliki))){
		}else{
			array_push($all_plik, $plik);
			array_push($nazwa_plik, $plik_reserch[5]);
		}
	}	
	
	// pętla do pobierania plików z wewnącz folderów
	for($i=0;$i<$zlicz_folder;$i++){

		// pętla do pobierania plików z folderów wyszukanych przez pobieżednią pętla wyciągającą nazy folderów
		foreach (glob($all_katolog[$i].'/*.*', GLOB_MARK) as $plik) {
			$plik_reserch = explode("/", $plik);
			
			$roszerzenie_pliki = explode(".", $plik_reserch[6]);
			$zlciz_all_pliki = count($roszerzenie_pliki);
			
			// sprawdzanie czy roszerzenie pliku nie jest na czarnej liście i eventualnie usuwanie go z tablicy 

			if((array_search($wyklucz_roszczerzenia[0], $roszerzenie_pliki)) OR (array_search($wyklucz_roszczerzenia[1], $roszerzenie_pliki)) OR (array_search($wyklucz_roszczerzenia[2], $roszerzenie_pliki)) OR (array_search($wyklucz_roszczerzenia[3], $roszerzenie_pliki))){
			}else{
				array_push($all_plik, $plik);
				array_push($nazwa_plik, $plik_reserch[5]."/".$plik_reserch[6]);
			}
			
		}	
		
	}	
	
	$zlicz_all_plik = count($all_plik);
	
	for($i=0;$i<$zlicz_all_plik;$i++){
		echo '<section class="tsr tsr-p-10px tsr-mt-10 fs-60 background-green cursor-pointer" data-nazwa-pliku="'.$nazwa_plik[$i].'" ><a href="?src='.$nazwa_plik[$i].'">'.$nazwa_plik[$i].'</a></section>';
	}

?>