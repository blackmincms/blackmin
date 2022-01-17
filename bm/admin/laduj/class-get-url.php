<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy zarządzanie url bm (pobiera, ustawia, sprawdza informacje)
	
	load class url blackmin
	
	Black Min cms,
	
	#plik: 1.1
*/

	# includowanie wybranego motywu przez administratora

	class url_bm {
		
		public $url;
		
		public function get_url_bm() {
			$http_name = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
			$http_p = "://";
			
			$url_serw_bm = $http_name . $http_p . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; # or define || $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']; 
			$url_full_serw_bm = $http_name . $http_p . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']; # or define || $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']; 
			$site_name = $_SERVER['REQUEST_URI'];
			
			// pobieranie zmiennej globalnej (ustawienia_bm)
			global $ustawienia_bm;
			
			$url_witryny_bm = $ustawienia_bm["bm_url_site"];
			
			$site_name=str_replace($url_witryny_bm, '', $url_serw_bm);
			
			return $site_name;
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
	}
		
?>