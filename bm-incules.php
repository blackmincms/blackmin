<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do załadowanie cms
	
	Black Min cms,
	
	#plik: 1.1
*/

	# ladowanie procesora bm

	require_once "black-min.php";
	
	# wyzwalanie klasy pr4
	
	# ladowanie plików bm
	# sprawdzanie czy ma zostać załadowany kontent black mina i czy nie ma błędów
	global $bm_content_load ;
	if ($bm_content_load != false){
		require_once BMPATH . "bm-laduj.php";
	}
		
?>