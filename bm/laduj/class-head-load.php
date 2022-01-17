<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do opsługi i zarządzania sekcji head w arkuszu html
	
	Black Min cms,
	
	#plik: 1.2
*/


	class head_bm extends get_ustawienia_bm {
		private $get_ustawienia;
		
		// tworzenie zmienych odpowiedzialnych za dodawanie nowych zawartośći do head
		protected $add_to_head = "";
		protected $add_to_title = "";
		protected $add_description = "";
		protected $add_keywords = "";
		protected $set_lang = "";
		protected $set_icon = "";
		protected $set_icon_ico = "";
		protected $set_robots = "";
		protected $add_css = "";
		protected $add_script = "";
		protected $autor_Timonix_BM = "BlackMinCMS";
		
		// funkcja konstrukcyina
		function __construct(){
			// pobieranie ustawień bm globalnych
			global $get_ustawienia_bm, $get_status_bm;
			$this->get_ustawienia = $get_ustawienia_bm;
			// ładowanie podstawowych ustawień blackmin'a 
			$this->add_to_title = $get_ustawienia_bm["bm_name_site"] . " | Black Min CMS";
			$this->add_description = $get_ustawienia_bm["bm_description_site"]. " "; 
			$this->add_keywords = $get_ustawienia_bm["bm_keywords"]; 
			$this->set_lang = $get_ustawienia_bm["bm_lang_site"]; 
			$this->set_icon = $get_ustawienia_bm["bm_icon_png_site"]; 
			$this->set_icon_ico = $get_ustawienia_bm["bm_icon_ico_site"]; 
			$this->set_robots = $get_ustawienia_bm["bm_robots"]; 
			
			// ustawienie autora i narzędzi BlackMinCMS
			$this->autor_Timonix_BM = "BlackMinCMS " . $get_status_bm["bm_version"];
			
			// ładowanie pliku odpowiedzialnego za inpretetacjie kodu napisanego przez autora posta
			$this->add_script .= '<script src="'.$get_ustawienia_bm["bm_url_server"]. "files/js/" .'blackmin_extention.js"></script>'. " \n ";
			// ładowanie domyśnego wyglądu motywu
			$this->add_css .= '<link rel="stylesheet" href="'.$get_ustawienia_bm["bm_url_server"].'files/css/default-style-theme-blackmin.css" />'. " \n ";			
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
				$this->add_css = '<link rel="stylesheet" href="'.$this->get_ustawienia["bm_url_server"].'files/global/jquery/jquery-ui.css" />'. " \n ";
			}else{
				if($flaga == "bm" OR $flaga == "black_min" OR $flaga == "blackmin"){
					$this->add_css .= '<link rel="stylesheet" href="'. $add .'">'. " \n ";
				}else{
					$this->add_css .= '<link rel="stylesheet" href="'.$this->get_ustawienia["bm_url_server"]. "a/motywy/" . $this->get_ustawienia["bm_theme_active"] . "/" . $add .'">'. " \n ";
				}
			}	
		}
		
		// funkcjia do dodawania zasobów javascript do strony
		public function add_script($add, $flaga = null) {
			
			if ($add == "jquery"){
				$this->add_script .= '<script src="'.$this->get_ustawienia["bm_url_server"].'/files/global/jquery/jquery.min.js"></script>'. " \n ";
			}else if($add == "jquery_ui"){
				$this->add_script .= '<script src="'.$this->get_ustawienia["bm_url_server"].'/files/global/jquery/jquery-ui.min.js"></script>'. " \n ";
			}else{
				if($flaga == "bm" OR $flaga == "black_min" OR $flaga == "blackmin"){
					$this->add_script .= '<script src="'. $add .'"></script>'. " \n ";
				}else{
					$this->add_script .= '<script src="'.$this->get_ustawienia["bm_url_server"]. "a/motywy/" . $this->get_ustawienia["bm_theme_active"]  . "/" . $add .'"></script>'. " \n ";
				}	
			}	
		}
		
		// funkcja odpowiedzialna za generowanie wyniku seo i ładowanie jej do strony
		public function load_head() {
			// zmienna przechowywuje url strony bm
			$url_site_bm = $this->get_ustawienia["bm_url_site"];
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
    <meta http-equiv="Expires" content="Fri, 28 Dec 2019 17:45:14 GMT">
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