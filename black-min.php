<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy opsługi połączeń cms'a
	
	#pr1
	
	Black Min cms,
	
	#plik: 2.0
*/

	if(!defined('BMPATH')) {
		define('BMPATH', dirname( __FILE__ ).'/' );
	};
	
	if(!defined('BM')) {
		define('BM','bm/' );
	};
	
	if(!defined('LADUJ')) {
		define('LADUJ','laduj/' );
	};
	
	if(!defined('BM')) {
		define('BM','bm/' );
	};
	
	// tworzenie wyświetlanej zmienej black min cms
	// Cobright - Wszelkie Prawa Zastrzeżone
	$black_min = "Black Min cms";
	$black_min_version = [
							"bm" => "2.0",
							"bmdb" => "2.0",
							"bm_refferer" => "dostosować bm do nowego rozwiązania (by Timonix)"
						];
	
	// tworzenie zmienej globalnej do przechowywania informacji czy ma zostać załadowany kontent strony
	$bm_content_load = true;
	
	// plik konfikuracyjny bazy danych sql
	require_once "connect.php";
	
	// ładowanie ścieżek plików
	require_once BMPATH . BM . LADUJ ."class-db.php";
	// ładowanie ścieżek plików
	require_once BMPATH . BM . LADUJ ."define-sciezka.php";
	// zmienna przechowywuje konfiguracje db
	$db_bm = new db_bm();
	$db_bm->db_error_developers(false);
	$db_bm->db_error(false);
	
	// przyłączanie klasy odpiwiedzialnej za status serwera cms
	require_once BMPATH . BM . LADUJ ."class-status.php"; 
	
	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	$class_status_bm = new bm_status(); 
	$bm_status = $class_status_bm->get();
	define("BM_STATUS", $bm_status, false);
	
	// przyłączanie klasy odpiwiedzialnej za ustawienia serwera
	require_once BMPATH . BM . LADUJ ."class-ustawienia.php"; 

	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	$class_settings_bm = new bm_settings(); 
	$bm_settings = $class_settings_bm->get();
	define("BM_SETTINGS", $bm_settings, false);

	// ładowanie klasy odpowiedzialnej za url w blackmin'ie
	require_once BMPATH . BM . LADUJ ."class-get-url.php"; 
	// wywoływanie klasy url bm
	$get_url_bm = new url_bm(true);
	$url_sprawdz = $get_url_bm->get_url_bm();
	$bm_url = $get_url_bm->bm_url();
	$get_url_bm->check_ssl();
	
	// ładowanie klasy pr4
	require_once BMPATH . BM . LADUJ ."class-pr4.php";
	
	$pr4 = new pr4();

	// ładowanie pliku sfl (class)
	require_once (BMPATH . BM . LADUJ . "sfl.php");
	$sfl = new sfl();
	$sfl->add(BMPATH . BM . LADUJ . "class-menu.php", 0); // ładowanie głównego menu black mina dla dostępnych i łatwych do użycja dla programisty bm
	$sfl->add(BMPATH . BM . LADUJ . "class-post.php", 0); // ładowanie głównego silnika ładującego posta black mina dla dostępnych i łatwych do użycja dla programisty bm
	$sfl->add(BMPATH . BM . LADUJ . "class-plugin.php", 0); // ładowanie głównego silnika ładującego pluginów (widget) dla dostępnych i łatwych do użycja dla programisty bm
	$sfl->add(BMPATH . BM . LADUJ . "plugin-bm.php", 0); // ładowanie pluginów (widget) wgranych w blackmin i posegrowanych dla dostępnych i łatwych do użycja dla programisty bm
	$sfl->add(BMPATH . BM . LADUJ . "class-head-load.php", 0); // ładowanie klasy odpowiedzialnej za zarządzaniem za generowanie i kontrolowanie nagłówka head w szoblonie html_entity_decode	
	$sfl->load("php");

	// #note @note
	// stworzyć w pełni generowane menu dla programistów bm (plugin, wtyczek i tp)
	// przeglądnąć klasy class-plugin.php i  plugin-bm.php
	// dodać nowe standardy
		
		
	$admin_url_sp = [
		"admin-panel",
		"admin-add-post",
		"admin-all-post",
		"admin-kategorie-tagi-post",
		"admin-ustawienia",
		"admin-black-min",
		"admin-socialmedia",
		"admin-statystyki",
		"admin-user-all",
		"admin-add-user",
		"admin-ustawienia-posta",
		"admin-update-bm",
		"admin-dysk",
		"admin-add-dane",
		"admin-komentarze",
		"admin-motywy-bm",
		"admin-pluginy",
		"admin-add-plugin",
		"admin-skrypty",
		"admin-add-skrypt",
		"admin-edit-skrypt",
		"admin-moj-profil",
		"admin-baza-danych",
		"admin-import-baza-danych",
		"admin-eksport-baza-danych",
		"admin-meil",
		"admin-ustawienia-spoleczne",
		"admin-ustawienia-linki-i-czas",
		"admin-ustawienia-prywatnosc",
		"",
	];
		
	// sprawdzenie zmienych globalnych czy istnieje 
	// jezeli zmiena super globalna istnieje ładowanie black mina rozpocznie się!
	
	if (isset($GLOBAL_STATUS)) {
		echo '
			<section class="tsr tsr-alert tsr-alert-error">
				Błąd Serwera! Wprowadzony Przez Ciebie KOD Zawiódł i Nie Umożliwia Działanie Innych Programów Prawidłowo! Zmień Lub Usuń KOD żeby Wszystko Chodziło Jak Trzeba!!!!
			</section>
			<section class="tsr tsr-alert tsr-alert-error">
				Kod Błędu: ERROR_CODE AND ERROR_CODE_FATAL
			</section>
		';
		exit();
	};	
	
?>