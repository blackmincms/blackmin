<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do startu bm cms
	
	Black Min cms,
	
	#plik: 1.0
*/
	// ładowanie bm prw
	ini_set('display_errors', 1);
	error_reporting (E_ALL | E_STRICT);
	define( 'BM_AKTYWACJA_PRW', true );
	//protokuł randomowośći wstecznej
	// ładowanie Black_min cms
	require_once "bm-incules.php";
	
?>