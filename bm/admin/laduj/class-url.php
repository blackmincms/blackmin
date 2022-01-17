<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do pobrania informacji o adresie url serwera i udsteonianie go
	
	load kmblackmin
	
	Black Min cms,
	
	#plik: 1.2
*/

	# pobieramy wartość paska url przetwarzamy go i mamy gotowe url do sprawdzenia 
	#wersja dołączenia v.1.0

	class bm_url {
		
		// zmiene przechowywujące dane u url
		public $scheme = null;
		public $user = null;
		public $pass = null;
		public $port = null;
		public $host = null;
		public $path = null;
		public $query = null;
		public $fragment = null;
		
		public $url;
		
		public $script_path = null;
		
		function __construct() {
		
			// ustawnianie zmiennych przechowywująca informacje o url Black Min
			$this->url = htmlentities(urldecode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['SERVER_NAME'] . htmlentities($_SERVER['REQUEST_URI'], ENT_QUOTES, "UTF-8")));	
			$this->scheme = parse_url($this->url, PHP_URL_SCHEME);
			$this->user = parse_url($this->url, PHP_URL_USER);
			$this->pass = parse_url($this->url, PHP_URL_PASS);
			$this->port = parse_url($this->url, PHP_URL_PORT);
			$this->host = parse_url($this->url, PHP_URL_HOST);
			$this->path = parse_url($this->url, PHP_URL_PATH);
			$this->query = parse_url($this->url, PHP_URL_QUERY);
			$this->fragment = parse_url($this->url, PHP_URL_FRAGMENT);
			
			$this->script_path = $_SERVER['PHP_SELF'];
		}
		
		public function get_url_bm() {
			global $url_serwera_bm;
			
			$http_name = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
			$http_p = "://";
			
			$url_serw_bm = $http_name . $http_p . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
			$url_full_serw_bm = $http_name . $http_p . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']; 
			$site_name = $_SERVER['REQUEST_URI'];
			
			$site_name=str_replace($url_serwera_bm, '', $url_serw_bm);
			
			return $site_name;
		}
		
		public function get_url() {			
			return $this->url;	
		}
		
		// funkcja sprawdzająca poprawność scematu https
		public function scheme($t = null){
			// sprawdzanie czy jest podany parametr t(url)
			// jęśli nie pobierane jest schemat z heder
			if($t == null){
				// sprawdzanie poprawnośći schematu
				if($this->scheme == "https"){
					return true;
				}else{
					return false;
				}
			}else{
				// sprawdzanie poprawnośći schematu
				if(parse_url($t, PHP_URL_SCHEME)){
					return true;
				}else{
					return false;
				}
			}
		}
		// funkcja sprawdzająca poprawność użytkownika USER
		public function user($t = null){
			// sprawdzanie czy jest podany parametr t(url)
			// jęśli nie pobierane jest schemat z heder
			if($t == null){
				// sprawdzanie poprawnośći schematu
				if($this->user == "https"){
					return true;
				}else{
					return false;
				}
			}else{
				// sprawdzanie poprawnośći schematu
				if(parse_url($t, PHP_URL_USER)){
					return true;
				}else{
					return false;
				}
			}
		}
		// funkcja sprawdzająca poprawność użytkownika USER
		public function pass($t = null){
			// sprawdzanie czy jest podany parametr t(url)
			// jęśli nie pobierane jest schemat z heder
			if($t == null){
				// sprawdzanie poprawnośći schematu
				if($this->pass == "https"){
					return true;
				}else{
					return false;
				}
			}else{
				// sprawdzanie poprawnośći schematu
				if(parse_url($t, PHP_URL_PASS)){
					return true;
				}else{
					return false;
				}
			}			
		}
		// funkcja sprawdzająca poprawność portu serwera PORT
		public function port($t = null){
			// sprawdzanie czy jest podany parametr t(url)
			// jęśli nie pobierane jest schemat z heder
			if($t == null){
				// sprawdzanie poprawnośći schematu
				if($this->port == "https"){
					return true;
				}else{
					return false;
				}
			}else{
				// sprawdzanie poprawnośći schematu
				if(parse_url($t, PHP_URL_PORT)){
					return true;
				}else{
					return false;
				}
			}				
		}
		// funkcja sprawdzająca poprawność portu hosta HOST
		public function host($t = null){
			// sprawdzanie czy jest podany parametr t(url)
			// jęśli nie pobierane jest schemat z heder
			if($t == null){
				// sprawdzanie poprawnośći schematu
				if($this->host == "https"){
					return true;
				}else{
					return false;
				}
			}else{
				// sprawdzanie poprawnośći schematu
				if(parse_url($t, PHP_URL_HOST)){
					return true;
				}else{
					return false;
				}
			}				
		}
		// funkcja sprawdzająca poprawność portu ścieżki pliku PATH
		public function path($t = null){
			// sprawdzanie czy jest podany parametr t(url)
			// jęśli nie pobierane jest schemat z heder
			if($t == null){
				// sprawdzanie poprawnośći schematu
				if($this->path == "https"){
					return true;
				}else{
					return false;
				}
			}else{
				// sprawdzanie poprawnośći schematu
				if(parse_url($t, PHP_URL_PATH)){
					return true;
				}else{
					return false;
				}
			}			
		}
		// funkcja sprawdzająca poprawność portu url get QUERY
		public function query($t = null){
			// sprawdzanie czy jest podany parametr t(url)
			// jęśli nie pobierane jest schemat z heder
			if($t == null){
				// sprawdzanie poprawnośći schematu
				if($this->query == "https"){
					return true;
				}else{
					return false;
				}
			}else{
				// sprawdzanie poprawnośći schematu
				if(parse_url($t, PHP_URL_QUERY)){
					return true;
				}else{
					return false;
				}
			}				
		}
		// funkcja sprawdzająca poprawność portu url po # | FRAGMENT
		public function fragment($t = null){
			// sprawdzanie czy jest podany parametr t(url)
			// jęśli nie pobierane jest schemat z heder
			if($t == null){
				$t = $this->fragment;
			}
			// sprawdzanie poprawnośći schematu
			if(parse_url($t, PHP_URL_FRAGMENT)){
				return true;
			}else{
				return false;
			}
			
			if($t == null){
				// sprawdzanie poprawnośći schematu
				if($this->query == "https"){
					return true;
				}else{
					return false;
				}
			}else{
				// sprawdzanie poprawnośći schematu
				if(parse_url($t, PHP_URL_QUERY)){
					return true;
				}else{
					return false;
				}
			}				
		}

		// funkcja sprawdzająca poprawność url funkcja (parse)
		public function unparse($parsed_url, $c = false){
			// sprawdzanie czy jest podany parametr t(url)
			// jęśli nie pobierane jest schemat z heder
			
			$scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
			$host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
			$port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
			$user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
			$pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
			$pass     = ($user || $pass) ? "$pass@" : '';
			$path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
			$query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
			$fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
			
			// jeżeli c = true to sprawdzana jest 
			if($c === true){
				return htmlentities("$scheme$user$pass$host$port$path$query$fragment", ENT_QUOTES, "UTF-8");
			}else{
				return "$scheme$user$pass$host$port$path$query$fragment";
			}
		}
		// alias dla funkcji unparse
		public function deparse($t, $c = false){
			bm_url::unparse($t, $c);
		}
		
		// validowanie adresu url funkcja(php)
		public function validate_url($t){
			if(filter_var($t, FILTER_VALIDATE_URL)){
				return true;
			}else{
				return false;
			}
		}
		// validowanie adresu url funkcja(preg_match)
		public function validateurl($input) {
			return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $input);
		}
		
		// sanitezowanie url a następnie validowanie
		// czyli Najpierw usuń wszystkie niedozwolone znaki ze zmiennej $ url, a następnie sprawdź, czy jest to prawidłowy adres URL
		public function sentize_url($t){
			if(filter_var($t, FILTER_SANITIZE_URL)){
				return true;
			}else{
				return false;
			}
		}

		// funkcja zwracająca śćieżkę pliku wykonywalnego
		public function script_path(){
			return $this->script_path;
		}
		// funkcja zwracająca nazwę pliku wykonywalnego
		public function script_name(){
			return $this->path;
		}
	}
		
?>