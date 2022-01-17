<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do Załadowania plików seo, js i css admin'a
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";

	// ładowanie pliku admin-seo jeżeli defined nie istnieje V.1.0

	if(!defined('ADMINSEO')) {
		require_once BMPATH . LADUJ . "admin-seo.php";
	};

	// ładowanie pliku admin-css jeżeli defined nie istnieje V.1.0

	if(!defined('ADMINCSS')) {
		require_once BMPATH . LADUJ . "admin-css.php";
	};
	
	// ładowanie pliku admin-js jeżeli defined nie istnieje V.1.0
	
	if(!defined('ADMINJS')) {
		require_once BMPATH . LADUJ . "admin-js.php";
	};

?>