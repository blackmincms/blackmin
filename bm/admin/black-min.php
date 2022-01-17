<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy opsługi połączeń cms'a
	
	#pr1
	
	Black Min cms,
	
	#plik: 1.2
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
	// ładowanie klasy odpowidzialnej za wszystkie url blackmin'a
 	require_once BMPATH  . LADUJ ."class-get-url.php";
	// pobieranie zmuennyc globalnych
	global $host, $db_user, $db_password, $db_name, $polaczenie, $rezultat;
	// ładowanie ścieżek plików
	require_once BMPATH . LADUJ ."class-db.php";
	// ładowanie ścieżek plików
	require_once BMPATH . LADUJ ."define-sciezka.php";
	// zmienna przechowywuje konfiguracje db
	$db_bm = new db_bm();
	$db_bm->db_error_developers(true);
	$db_bm->db_error(true);

	require_once BMPATH  . LADUJ ."class-get-ustawienia.php";
 	require_once BMPATH  . LADUJ ."class-get-status.php";
	// konwertowanie danych pobranych z bazy sql  i przypisywanie ich do łatwiejszych zmienych
	// wersja dołączenia V.1.0
	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	$class_get_status_bm = new get_status_bm(); 
	$get_status_bm = $class_get_status_bm->get_status();
	$status_bm = $get_status_bm;
	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	$class_get_ustawienia_bm = new get_ustawienia_bm(); 
	$get_ustawienia_bm = $class_get_ustawienia_bm->get_ustawienia();
	$ustawienia_bm = $get_ustawienia_bm;
	$bm_ustawienia = $ustawienia_bm;
	// oddawnie zmiennej ssl_bm do zmiennej sesyinej
	$_SESSION['bm_ssl'] = $get_ustawienia_bm["bm_ssl"];
	// pobieranie wartośći z paska url i udostępnianie jej innym algorytmom 
	$get_url_bm = new url_bm();
	$url_sprawdz = $get_url_bm->get_url_bm();
	// sprawdzanie protokołu ssl_bm
	$get_url_bm->check_ssl(true);
	// ładującej klasy ładującej wszystko :D
	require_once BMPATH  . LADUJ ."laduj.php"; 
	// ładowanie klasy pr4
	require_once BMPATH. LADUJ ."class-pr4.php";
	// wyzwalanie klasy pr4
	$pr4 = new pr4();
	// ładowanie aktulizjącej online użytkowników na bieżąco
	require_once BMPATH  . INSERT ."update-user-online.php"; 
	// pobieranie  uprawnieiń blackmin'a
	require_once BMPATH . "black-min-uprawnienia.php";

	// przypisywanie zmiennych
	$url_serwera_bm = $ustawienia_bm["bm_url_server"];
	$url_witryny_bm = $ustawienia_bm["bm_url_site"];
	$bm_nazwa_strony_bm = $ustawienia_bm["bm_name_site"];
	// zmienna przechowywuje skruconą nazwę strony
	$bm_nazwa_strony_bm_skrucona = cut($bm_nazwa_strony_bm, 28);
		
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