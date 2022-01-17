<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy opsługi połączeń cms'a
	
	#pr1
	
	Black Min cms,
	
	#plik: 1.2.1.1
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
	
	// tworzenie zmienej globalnej do przechowywania informacji czy ma zostać załadowany kontent strony
	$bm_content_load = true;
	
	// plik konfikuracyjny bazy danych sql
	require_once "connect.php";
	// pobieranie glbalnych ustawień
	global $host, $db_user, $db_password, $db_name, $polaczenie, $rezultat;
	
	// ładowanie ścieżek plików
	require_once BMPATH . BM . LADUJ ."class-db.php";
	// ładowanie ścieżek plików
	require_once BMPATH . BM . LADUJ ."define-sciezka.php";
	// zmienna przechowywuje konfiguracje db
	$db_bm = new db_bm();
	$db_bm->db_error_developers(false);
	$db_bm->db_error(false);
	
	// przyłączanie klasy odpiwiedzialnej za status serwera cms
	require_once BMPATH . BM . LADUJ ."class-get-status.php"; 
	
	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	$class_get_status_bm = new get_status_bm(); 
	$get_status_bm = $class_get_status_bm->get_status();
	$status_bm = $get_status_bm;
	
	// przyłączanie klasy odpiwiedzialnej za ustawienia serwera
	require_once BMPATH . BM . LADUJ ."class-get-ustawienia.php"; 

	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	$class_get_ustawienia_bm = new get_ustawienia_bm(); 
	$get_ustawienia_bm = $class_get_ustawienia_bm->get_ustawienia();
	$ustawienia_bm = $get_ustawienia_bm;
	// oddawnie zmiennej ssl_bm do zmiennej sesyinej
	$_SESSION['bm_ssl'] = $get_ustawienia_bm["bm_ssl"];	
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

	// tworzenie zmiennych odpowiedzialnych za konfiguracje statusu na serwerze bm
	$bm_nick_admin_bm = $status_bm["bm_installation_admin"];
	$bm_mail_admin_bm = $status_bm["bm_admin_mail"];
	$bm_wersja_db = $status_bm["bm_version_db"];
	$bm_aupt_public = $status_bm["bm_public_aupt"];
	$bm_aupt_private = $status_bm["bm_private_aupt"];
	$bm_aupt_acces = $status_bm["bm_aupt_acces"];
	$bm_data_instalacji = $status_bm["bm_date_installation"];
	$bm_wersja_black_min = $status_bm["bm_version"];
	// tworzenie zmiennych odpowiedzialnych za konfiguracje statusu na serwerze bm
	$get_settings_bm = $ustawienia_bm;
	$settings_bm = $ustawienia_bm;
	$url_instalacji_bm = $ustawienia_bm["bm_url_server"];
	$url_witryny_bm = $ustawienia_bm["bm_url_site"];
	// zmienne sesyine przechowywujące url instalacji bm i url witryny bm
	$_SESSION['url_instalacji_bm'] = $url_instalacji_bm ;
	$_SESSION['url_witryny_bm'] = $url_witryny_bm ;
	
	// ładowanie ustawień black min'a dostępnych i łatwych do użycja dla programisty bm
	require_once BMPATH . BM . LADUJ . "ustawienia.php";

	// ładowanie statusu black min'a dostępnych i łatwych do użycja dla programisty bm
	require_once BMPATH . BM . LADUJ . "status.php";

	// ładowanie głównego menu black mina dla dostępnych i łatwych do użycja dla programisty bm
	require_once BMPATH . BM . LADUJ . "class-menu.php";
	
	// ładowanie głównego silnika ładującego posta black mina dla dostępnych i łatwych do użycja dla programisty bm
	require_once BMPATH . BM . LADUJ . "class-post.php";

	// ładowanie głównego silnika ładującego pluginów (widget) dla dostępnych i łatwych do użycja dla programisty bm
	require_once BMPATH . BM . LADUJ . "class-plugin.php";
	// ładowanie pluginów (widget) wgranych w blackmin i posegrowanych dla dostępnych i łatwych do użycja dla programisty bm
	require_once BMPATH . BM . LADUJ . "plugin-bm.php";

	// ładowanie klasy odpowiedzialnej za zarządzaniem za generowanie i kontrolowanie nagłówka head w szoblonie html_entity_decode	
	require_once BMPATH . BM . LADUJ . "class-head-load.php";
		
		
		// ati  aplkacyjiny Timonix'a identyfikator
		// atpi aplikacyjiny Timonix'a protokuł identyfikacyiny
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