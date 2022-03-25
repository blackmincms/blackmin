<?php	
/**
*	"Black Min" 
*	
*	For the full copyright and license information, please view the LICENSE
*	file that was distributed with this source code.
*
*	@package BlackMin
*	
*	#plik: 2.0
*
*	This file has load head
*/

	namespace BlackMin\Head;

	class Head {
		// tworzenie zmienych odpowiedzialnych za dodawanie nowych zawartośći do head
		/**
		* 	@var string;
		*/
		protected $add_to_head = "";
		/**
		* 	@var string;
		*/		
		protected $add_to_title = "";
		/**
		* 	@var string;
		*/		
		protected $add_description = "";
		/**
		* 	@var string|null;
		*/		
		protected $add_keywords = "";
		/**
		* 	@var string;
		*/		
		protected $set_lang = "";
		/**
		* 	@var string;
		*/		
		protected $set_icon = "";
		/**
		* 	@var string;
		*/		
		protected $set_icon_ico = "";
		/**
		* 	@var string;
		*/		
		protected $set_robots = "";
		/**
		* 	@var string;
		*/		
		protected $add_css = "";
		/**
		* 	@var string;
		*/		
		protected $add_script = "";
		/**
		* 	@var string;
		*/
		protected $autor_Timonix_BM = "BlackMinCMS";
		
		// funkcja konstrukcyina
		function __construct() {
			// ładowanie podstawowych ustawień blackmin'a 
			$this->add_to_title = BM_SETTINGS["bm_name_site"] . " | Black Min CMS";
			$this->add_description = BM_SETTINGS["bm_description_site"]. " "; 
			$this->add_keywords = BM_SETTINGS["bm_keywords"]; 
			$this->set_lang = BM_SETTINGS["bm_lang_site"]; 
			$this->set_icon = BM_SETTINGS["bm_icon_png_site"]; 
			$this->set_icon_ico = BM_SETTINGS["bm_icon_site"]; 
			$this->set_robots = BM_SETTINGS["bm_robots"]; 
			
			// ustawienie autora i narzędzi BlackMinCMS
			$this->autor_Timonix_BM = "BlackMinCMS " . BM_STATUS["bm_version"];
			
			// ładowanie pliku odpowiedzialnego za inpretetacjie kodu napisanego przez autora posta
			$this->add_script .= '<script src="'.BM_SETTINGS["url_server"]. "files/js/" .'blackmin_extention.js"></script>'. " \n ";
			// ładowanie domyśnego wyglądu motywu
			$this->add_css .= '<link rel="stylesheet" href="'.BM_SETTINGS["url_server"].'files/css/default-style-theme-blackmin.css" />'. " \n ";			
		}
		
		// funkcja chowająca wersję BlackMinCMS
		public function hidden_version(){
			$this->autor_Timonix_BM = "BlackMinCMS ";
		}
		
		// funkcjia do dodawania znaczników do head
		public function add_head($add) {
			$this->add_to_head .= $add. " \n ";
		}
		
		// funkcjia do dodawania tytułu strony
		public function add_title($add) {
			$this->add_to_title = $add . $this->add_to_title;
		}

		// funkcjia do ustawwiania tytułu strony
		public function set_title($add) {
			$this->add_to_title = $add;
		}
		
		// funkcjia do dodowania opisu strony
		public function add_description($add) {
			$this->add_description .= $add. " ";
		}

		// funkcjia do ustaswiania opisu strony
		public function set_description($add) {
			$this->add_description = $add;
		}
		
		// funkcjia do dodawania słów kluczowych do strony
		public function add_keywords($add) {
			// sprawdzanie czy istnieją już słowa kluczowe
			if(strlen($this->add_keywords) >= 1){
				$this->add_keywords .= "," . $add;
			}else{
				$this->add_keywords .= $add;
			}
		}

		// funkcjia do ustawiania słów kluczowych do strony
		public function set_keywords($add) {
			$this->add_keywords = $add;
		}
		
		// funkcjia ustawianie języka strony
		function set_lang($add) {
			$this->set_lang = $add;
		}
		
		// funkcja do ustawienia ikony strony
		public function set_icon($set) {
			if ($set == NULL){
				$this->set_icon = $this->set_icon; 
			}else{
				$this->set_icon = $set;
			}
		}
		
		// funkcja do ustawienia ikony strony
		public function set_icon_ico($set) {		
			if ($set == NULL){
				$this->set_icon_ico = $this->set_icon_ico;
			}else{
				$this->set_icon_ico = $set;
			}			
		}
		
		// funkcjia do ustawiania robotów pozwalającym się poruszać po stronie
		public function set_robots($set) {
			if ($set == NULL){
				$this->set_robots = $this->set_robots; 
			}else{
				$this->set_robots = $set;
			}	
		}
		
		// funkcja do dodawania zasobów css do strony
		public function add_css($add, $flaga = null) {
			
			if ($add == "jquery_ui"){
				$this->add_css = '<link rel="stylesheet" href="'.BM_SETTINGS["url_server"].'files/global/jquery/jquery-ui.css" />'. " \n ";
			}else{
				if($flaga == "bm" OR $flaga == "black_min" OR $flaga == "blackmin"){
					$this->add_css .= '<link rel="stylesheet" href="'. $add .'">'. " \n ";
				}else{
					$this->add_css .= '<link rel="stylesheet" href="'.BM_SETTINGS["url_server"]. "a/motywy/" . BM_SETTINGS["bm_theme_active"] . "/" . $add .'">'. " \n ";
				}
			}	
		}
		
		// funkcjia do dodawania zasobów javascript do strony
		public function add_script($add, $flaga = null) {
			
			if ($add == "jquery"){
				$this->add_script .= '<script src="'.BM_SETTINGS["url_server"].'/files/global/jquery/jquery.min.js"></script>'. " \n ";
			}else if($add == "jquery_ui"){
				$this->add_script .= '<script src="'.BM_SETTINGS["url_server"].'/files/global/jquery/jquery-ui.min.js"></script>'. " \n ";
			}else{
				if($flaga == "bm" OR $flaga == "black_min" OR $flaga == "blackmin"){
					$this->add_script .= '<script src="'. $add .'"></script>'. " \n ";
				}else{
					$this->add_script .= '<script src="'.BM_SETTINGS["url_server"]. "a/motywy/" . BM_SETTINGS["bm_theme_active"]  . "/" . $add .'"></script>'. " \n ";
				}	
			}	
		}
		
		// funkcja odpowiedzialna za generowanie wyniku seo i ładowanie jej do strony
		public function load_head() {
			// zmienna przechowywuje url strony bm
			$url_site_bm = BM_SETTINGS["url_server"];
ECHO<<<END
	<!-- roszerzenie aplikacj strony KODOWANIE -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Script-Type" content="text/javascript">
	<!-- Koniec roszerzenia aplikacj strony KODOWANIE -->
	<!-- Rozpoczynane Znaczników meta i seo, favicon -->
	<meta name="viewport" content="width=1900">
	<title>$this->add_to_title</title>
	<meta name="title" content="$this->add_to_title">
    <meta name="description" content="$this->add_description">
	<meta name="Keywords" content="$this->add_keywords">
    <meta property="og:title" content="$this->add_to_title">
    <meta property="og:site_name" content="$this->add_to_title">
    <meta property="og:description" content="$this->add_description">
	<meta property="og:keywords" content="$this->add_keywords">
    <meta property="og:url" content="$url_site_bm">
	<link rel="shortcut icon" type="image/x-icon" href="$this->set_icon_ico"/>               
	<link rel="icon" type="image/png" href="$this->set_icon" />
    <meta property="og:image" content="$this->set_icon">
    <meta property="og:image:width" content="100">
    <meta property="og:image:height" content="100">
    <meta property="og:type" content="website">
	<!-- Kontynołowanie Znaczników meta robots, autor, langue, data publikacji strony,  -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">    
	<meta http-equiv="Page-Enter" content="revealTrans(Duration=10, Transition=23)">
    <meta http-equiv="Content-Language" content="$this->set_lang">
    <meta name="Author" content="Black Min CMS">
    <meta http-equiv="Expires" content="Fri, 20 Dec 2020 20:20:20 GMT">
    <meta name="Authoring_tool" content="$this->autor_Timonix_BM">
	<meta name="generator" content="$this->autor_Timonix_BM">
    <meta name="Robots" content="$this->set_robots">
	<!-- Konczenie Znaczników meta i meta_data i metadata i robots-->
	<!-- Dodawanie nowych znaczników meta ON -->
	$this->add_to_head
	<!-- Dodawanie nowych znaczników meta OFF -->
	<!-- Dodawanie nowych stylów css ON -->
	$this->add_css
	<!-- Dodawanie nowych stylów css OFF -->
	<!-- Dodawanie nowych skryptów javascript ON -->
	$this->add_script
	<!-- Dodawanie nowych skryptów javascript OFF -->
END;
		}

	}

?>