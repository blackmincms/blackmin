<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy opsługi połączeń cms'a
	
	#pr1
	
	Black Min cms,
	
	#plik: 2.0
*/	

	// pobieranie ścieżki katalogu głównego
	if(!defined('BMPATH')) {
		define('BMPATH', dirname( __FILE__ ).'/' );
	};
	
	if(!defined('BM')) {
		define('BM','bm/' );
	};
	
	if(!defined('LADUJ')) {
		define('LADUJ','laduj/' );
	};
	
	// pobieranie danych konfiguracyinych db
	require_once realpath(BMPATH. "../../connect.php");
	
	// otwieranie sesii black mina
	require_once(BMPATH . "black-min-sm.php");
	// sprawdzanie czy uzytkownik jest zalogowany
	if (!isset($_SESSION['zalogowany'])) {
		header('Location: ../logowanie.php');
		exit();
	}
	// ładowanie ścieżek plików
	require_once realpath(BMPATH .  "../../" . BM . LADUJ ."class-db.php");
	// ładowanie ścieżek plików
	require_once BMPATH . LADUJ ."define-sciezka.php";
	// zmienna przechowywuje konfiguracje db
	$db_bm = new db_bm();
	$db_bm->db_error_developers(true);
	$db_bm->db_error(true);

	// przyłączanie klasy odpiwiedzialnej za status serwera cms
	require_once realpath(BMPATH . "../../" . BM . LADUJ ."class-status.php"); 

	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	$class_status_bm = new bm_status(); 
	$bm_status = $class_status_bm->get();
	define("BM_STATUS", $bm_status, false);

	// przyłączanie klasy odpiwiedzialnej za ustawienia serwera
	require_once realpath(BMPATH . "../../" . BM . LADUJ ."class-ustawienia.php"); 

	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	$class_settings_bm = new bm_settings(); 
	$bm_settings = $class_settings_bm->get();
	define("BM_SETTINGS", $bm_settings, false);

	// ładowanie klasy odpowidzialnej za wszystkie url blackmin'a
	require_once realpath(BMPATH . "../../" . BM  . LADUJ ."class-get-url.php");

	// pobieranie wartośći z paska url i udostępnianie jej innym algorytmom 
	$get_url_bm = new url_bm();
	$url_sprawdz = $get_url_bm->get_url_bm();
	// sprawdzanie protokołu ssl_bm
	$get_url_bm->check_ssl(true); 
	// ładowanie klasy pr4
	require_once BMPATH. LADUJ ."class-pr4.php";
	// wyzwalanie klasy pr4
	$pr4 = new pr4();

	// pobieranie  uprawnieiń blackmin'a
	require_once BMPATH . "black-min-uprawnienia.php";

	// ładowanie pliku sfl (class)
	require_once (realpath(BMPATH . "../../" . BM . LADUJ . "sfl.php"));
	$sfl = new sfl();
	$sfl->add_php( BMPATH . LADUJ . "ostatni-post.php", 0);
	$sfl->add_php(realpath(BMPATH . "../../" . BM . LADUJ . "date-format.php"), 0);
	$sfl->add_php(BMPATH . LADUJ . "text-wrap.php", 0);
	$sfl->add_php(BMPATH . LADUJ . "cut.php", 0);
	$sfl->add_php(BMPATH . LADUJ . "get-kategoria-tag.php", 0);
	
	$loadphp = $sfl->load_php();
	// sprawdzanie błędów pod czas ładowania plików
	if (!$loadphp) {
		if ($sfl->error() != null) {
			echo "Wystąpił błąd pod czas ładowanie plików rdzenia black min";
			exit();
		}
	}

	// ładowanie aktulizjącej online użytkowników na bieżąco
	require_once BMPATH  . INSERT ."update-user-online.php"; 

	// zmienna przechowywuje skruconą nazwę strony
	$bm_nazwa_strony_bm_skrucona = cut(BM_SETTINGS["bm_name_site"], 28);
		
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
	"admin-eksport-baza-danych",
	"admin-meil",
	"admin-ustawienia-spoleczne",
	"admin-ustawienia-linki-i-czas",
	"admin-ustawienia-prywatnosc",
	"",
	];
	
	/* nazwa url zajnstalowanego black min'a - nazwa url i nazwa orginalna */
	
	$black_min = "Black Min cms";
	
?>