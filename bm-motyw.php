<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do załadowanie motywu strony bm
	
	Black Min cms,
	
	#plik: 1.0
*/
	
	$bm_motyw=TRUE;
	
	// ładowanie pliku odpowiedzialnego za wczytanie aktywnego motywu
	require_once BMPATH . BM . LADUJ ."class-open-motyw.php";
	
	// tworzenie nowej klasy
	$open_motyw_bm = new open_motyw_bm();
	
	// ładowanie aktywnego motywu
	$open_motyw_bm->open_aktywny_motyw_bm();
		
?>