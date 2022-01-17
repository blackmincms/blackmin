<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy zarządzanie url bm (pobiera, ustawia, sprawdza informacje)
	
	load class url blackmin
	
	Black Min cms,
	
	#plik: 1.2
*/

	# includowanie wybranego motywu przez administratora

	class url_bm extends get_ustawienia_bm {
		
		public $url;
		
		public function get_url_bm() {
			$http_name = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
			$http_p = "://";
			
			$url_serw_bm = $http_name . $http_p . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
			$url_full_serw_bm = $http_name . $http_p . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']; 
			
			// pobieranie zmiennej globalnej (ustawienia_bm)
			global $ustawienia_bm;
			
			$url_witryny_bm = $ustawienia_bm["bm_url_site"];
			
			$site_name=str_replace($url_witryny_bm, '', $url_serw_bm);
			
			return $site_name;
		}
		
		public function get_orginal_url_bm() {
			$http_name = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
			$http_p = "://";
			
			$url_serw_bm = $http_name . $http_p . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
			$url_full_serw_bm = $http_name . $http_p . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']; 
			
			return $url_serw_bm;
		}
		// funckcja sprawdzająca  czy dany serwer używa ssl jeśli nie przekierowuwuje go na na zabespieczony protokó
		public function check_ssl($t = false){
			// pobieranie zmiennej globalnej (ustawienia_bm)
			global $ustawienia_bm;
			// sprawdzanie czy blackmin ma użyć szyfrowania ssl
			if($ustawienia_bm["bm_ssl"] == 1){
				// sprawdzanie czy wykonać przekierowanie na protoków ssl
				if($t == true){
					// sprawdzanie czy użytko protokołu szyfrowanego (https) jeżeli użytko protokołu (http) przekierujemy na protokół szyfrowany
					// pobieranie url do zmiennej
					$ssl_scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
					$url_domain = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";				
					if($ssl_scheme == "http"){
						header("Location: ". $url_domain, true, 301);
						exit();
					}
				}else{
					return true;
				}
			}else{
				return false;
			}
		}
		// funkcja farsąjąca url, zykły ciąg > sparsowane url | z ciągu na tablice url
		public function parse_url($t){
			// sprawdzanie czy ciąg nie jest pusty i czy jest ciągiem
			if(($t != 0) and (is_string($t))){
				// zwracanie zbarsowanych dancyh
				return parse_url($t);
			}else{
				return false;
			}
		}
		// funckcja unparsuje > sparsowane url | z tablicy na ciąg url
		public function unparse_url($parsed_url) {
			$scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
			$host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
			$port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
			$user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
			$pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
			$pass     = ($user || $pass) ? "$pass@" : '';
			$path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
			$query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
			$fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
			return "$scheme$user$pass$host$port$path$query$fragment";
		}
		// funkcja zamieniająca np scieżkę (../img/logo.png) na (https://timonix.pl/img/logo.png)
		// schemat = ścieżka relatywna(../img/logo.png) na śćięzkę absolutną z domeną i ściężką relatywną
		public function relativeToAbsolute($inurl, $absolute) {
			// Get all parts so not getting them multiple times :)
			$absolute_parts = parse_url($absolute);   
			// Test if URL is already absolute (contains host, or begins with '/')
			if ( (strpos($inurl, $absolute_parts['host']) == false) ) {
				// Define $tmpurlprefix to prevent errors below
				$tmpurlprefix = "";
				// Formulate URL prefix    (SCHEME)                   
				if (!(empty($absolute_parts['scheme']))) {
					// Add scheme to tmpurlprefix
					$tmpurlprefix .= $absolute_parts['scheme'] . "://";
				}
				// Formulate URL prefix (USER, PASS)   
				if ((!(empty($absolute_parts['user']))) and (!(empty($absolute_parts['pass'])))) {
					// Add user:port to tmpurlprefix
					$tmpurlprefix .= $absolute_parts['user'] . ":" . $absolute_parts['pass'] . "@";   
				}
				// Formulate URL prefix    (HOST, PORT)   
				if (!(empty($absolute_parts['host']))) {
					// Add host to tmpurlprefix
					$tmpurlprefix .= $absolute_parts['host'];
					// Check for a port, add if exists
					if (!(empty($absolute_parts['port']))) {
						// Add port to tmpurlprefix
						$tmpurlprefix .= ":" . $absolute_parts['port'];
					}
				}
				// Formulate URL prefix    (PATH) and only add it if the path to image does not include ./   
				if ( (!(empty($absolute_parts['path']))) and (substr($inurl, 0, 1) != '/') ) {
					// Get path parts
					$path_parts = pathinfo($absolute_parts['path']);
					// Add path to tmpurlprefix
					$tmpurlprefix .= $path_parts['dirname'];
					$tmpurlprefix .= "/";
				}
				else {   
					$tmpurlprefix .= "/";   
				}   
				// Lets remove the '/'
				if (substr($inurl, 0, 1) == '/') { $inurl = substr($inurl, 1); }   
				// Lets remove the './'
				if (substr($inurl, 0, 2) == './') { $inurl = substr($inurl, 2); }   
				return $tmpurlprefix . $inurl;
			}   
			else {
				// Path is already absolute. Return it :)
				return $inurl;
			}
		}	

		// alias funkcji relativeToAbsolute
		public function reltoabs($inurl, $absolute) {
			relativeToAbsolute($inurl, $absolute);
		}
		
		// funkcja sprawdzająca url blackmin
		public function check_url(){
			// pobieranie url
			$url =  url_bm::get_url_bm();
			
			// sprawdzanie czy załadować przerwę techniczną
			if(get_ustawienia_bm::get_ustawienia()["bm_maintenance_mode"] == "true"){
				$t = "maintenance_mode";
				// sprawdzanie czy jest użyty folder domyśny
			}elseif($url == ''){
				$t = "root";
			// sprawdzanie czy załadować posta
			}elseif(strlen($url) >= 1){
			// sprawdzanie czy załadować szukanego posta
				if(strlen($_SERVER["QUERY_STRING"]) >= 1){
					// zmienna przechowywuje explode zapytania
					$query = explode("&", parse_url($url, PHP_URL_QUERY));
					// pętla przeprowadzająca operacie na tablicy z zapytaniami
					for($i = 0; $i < count($query); $i++){
						// sprawdzanie czy użyto słów kluczowych do wyszukania posta
						$wq = explode("=", $query[$i])[0];
						// sprawdzanie czy użyto przekierowania do panelu admina Black Min'a						
						if(parse_url(explode("/", $url)[count(explode("/", $url))-1], PHP_URL_PATH) == "admin"){
							$t = "admin_bm";
						// sprawdzanie czy załadować stronę szukanego posta
						}elseif(($wq == "search") || ($wq == "search_post") || ($wq == "search_page")){ 
							$t = "search_page";
							break;
						// sprawdzanie czy załadować stronę
						}else{
							$t = "post_page";
						}
					}
				// sprawdzanie czy użyto przekierowania do panelu admina Black Min'a
				}elseif(parse_url(explode("/", $url)[count(explode("/", $url))-1], PHP_URL_PATH) == "admin"){
					$t = "admin_bm";
				// sprawdzanie czy załadować stronę
				}else{
					$t = "post_page";				
				}	
			}else{
				$t = "error_bm";
			}
			// zwracanie wyniku
			return $t;
		}
		
		// pobieranie url bm do załadowania
		public function bm_url(){
			// pobieranie url
			$url =  url_bm::get_url_bm();
			// pobieranie ładowania kontentu
			$c = url_bm::check_url();
			// rozdzieleanie danych po shlash :O
			$r = parse_url($url);
			// tablica z śćięzką
			$s = (isset($r["path"]) ? explode("/", $r["path"]) : []);
			// pobieranie konfiguracji url bm do załadowania kontentu
			// zliczanie tablicy
			$z = count($s);				
			// path = ścieżka do załadowania;
			// check_url = sprawdzone url
			// url_parse = sparsowane url (tablica)
			// url_full = peły url bm
			// tabica przechowywująca konfiguracjie ścieżek
			$t = [
				"path" => "error_bm",
				"checked_url" => "error_bm",
				"url_parse" => $r,
				"url_full" => "$url"
			];
			
			if (strstr(url_bm::get_orginal_url_bm(), $GLOBALS["ustawienia_bm"]["bm_url_site"]) === false) {
				// przekierowanie do strony głownej
				header("Location:". $GLOBALS["ustawienia_bm"]["bm_url_site"]);
				exit();
			 }
			
			// sprawdzanie kóre scieżki podać do ładowanego kontenu
			if($c == "root"){
				$t["path"] = "all";
				$t["checked_url"] = "$c";
				$t["url_parse"] = ["all"];
				$t["url_full"] = "all";				
			}elseif($c == "maintenance_mode"){
				$t["path"] = $GLOBALS["ustawienia_bm"]["bm_url_site"];
				$t["checked_url"] = "$c";
				$t["url_parse"] = ["". $GLOBALS["ustawienia_bm"]["bm_url_site"] .""];
				$t["url_full"] = $GLOBALS["ustawienia_bm"]["bm_url_site"];
			}elseif($c == "search_page"){
				// sprawdzanie czy istnieją dane do szukania
				if(isset($_GET["search"])){
					$t["path"] = $_GET["search"];
					$t["checked_url"] = "$c";							
				}elseif(isset($_GET["search_post"])){
					$t["path"] = $_GET["search_post"];
					$t["checked_url"] = "$c";							
				}elseif(isset($_GET["search_page"])){
					$t["path"] = $_GET["search_page"];
					$t["checked_url"] = "$c";							
				}else{
					// pokazywanie błędu jeżeli dane nie istnieją
					$t["path"] = $GLOBALS["ustawienia_bm"]["bm_url_site"];
					$t["checked_url"] = "error_bm";			
					$t["url_parse"] = ["". $GLOBALS["ustawienia_bm"]["bm_url_site"] .""];
					$t["url_full"] = $GLOBALS["ustawienia_bm"]["bm_url_site"];					
				}		
			}elseif($c == "admin_bm"){
				// przekierowanie do panelu BlackMin'a
				header("Location:". $GLOBALS["ustawienia_bm"]["bm_url_server"]. "bm/admin/admin-panel.php");
				exit();
			}elseif($c == "post_page"){
				$t["path"] = $s[$z-1];
				$t["checked_url"] = "$c";					
			}else{
				// pokazywanie błędu jeżeli dane nie istnieją
				$t["path"] = "error_bm";		
				$t["checked_url"] = "error_bm";			
				$t["url_parse"] = ["".$GLOBALS["ustawienia_bm"]["bm_url_site"] .""];
				$t["url_full"] = $GLOBALS["ustawienia_bm"]["bm_url_site"];						
			}

			// zwracanie wyniku 
			return $t;
		}
	}
		
?>