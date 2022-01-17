<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik zarządza wszystkimi widgetami
	
	Black Min cms,
	
	#plik: 1.1
*/
	
	class bm_plugin {
		// zmienne przchowywujące dane o zastosowanych widgetach
		protected $top_plugin = [],
						$left_plugin = [],
						$right_plugin = [],
						$bottom_plugin = [],
						$footer_plugin = [];
		// zmienna przechwywuje dane o starcie indexu pluginów
		protected $start_naglowek = '
			<div class="tsr bm_plugins_container bm_widget_container">
		';
		// zmienna przechwywuje dane o końcu indexu pluginów
		protected $start_widget_naglowek = '
			<div class="tsr bm_plugins_container bm_widget_container">
		';
		// zmienna odpowiedzialna za ukrywanie nagłówka konkretnego pluginu
		protected $naglowek_plugin = false;
		
		function __construct(){
			// przyłączanie zmiennej globalnej
			global $ustawienia_bm;
			// pobieranie ustawień panelów z pluginami i przydzielanie ich do odpowedniej zmienej
			$this->top_plugin = $ustawienia_bm["bm_top_widget"];
			$this->left_plugin = $ustawienia_bm["bm_left_widget"];
			$this->right_plugin = $ustawienia_bm["bm_right_widget"];
			$this->bottom_plugin = $ustawienia_bm["bm_bottom_widget"];
			$this->footer_plugin = $ustawienia_bm["bm_footer_widget"];
		}
		// funckcja ukrywająca nagłowek konkretnego widgetu
		public function header_hide($t){
			// sprawdzanie czy poprawnie wprowadzono dane
			if(is_bool($t)){
				//ustawianie wartośći nagłównka czy ma zostać schowany(true) czy nie(false)
				$this->naglowek_plugin = $t;
			}else{
				throw new ErrorException("Błąd: BM_CLASS_PLUGIN_HEADER_HIDE. Wprowadzone dane są nieprawidłowe!", 1);
			}
		}
		
		// funkcja chroniona kompilująca widgety
		protected function kompilowanie_widget($t){
			// sprawdzanie czy dane są tablicą
			if(is_array($t)){
				// zmienna pzecowywująca gotowe wyniki skompilownych pluginów
				$o = '';
				// zliczanie elmentów w tablicy
				$ile = count($t);
				// pętla przeprowadząca operacje na objektach
				for($i = 0;$i < $ile; $i++){
					// sprawdzanie czy wyświetlić nagłówek
					if($this->naglowek_plugin === false){
						// dodawanie nagłowka pluginu (indefikatora)
						$o .= '<div class="tsr bm-widget-'. $t[$i]["plugin"] .'" bm-widget="'.  $t[$i]["plugin"] .'">';
					}
					// sprawdzanie czy widget jest wbudowany w bm
					if($t[$i]["plugin_full"] == "blackmin"){
						// ładowanie pluginów (widget) wgranych w blackmin i posegrowanych dla dostępnych i łatwych do użycja dla programisty bm
						require_once BMPATH . BM . LADUJ . "plugin-bm.php";
						// inkludowanie pliku
						$x = get_plugin_bm();
						$o .= $x[strtolower($t[$i]["plugin"])];
					}else{
						// sprawdzanie czy plugin istnieje
						if(is_dir ( "a/pluginy/".$t[$i]["plugin_full"] )  == true){
							// rozpoczynanie kopilowanie html w php
							ob_start();
							// inkludowanie pliku
							require (BMPATH . A . PLUGINY . $t[$i]["plugin_full"] ."/plugin-content.php");		
							// kompilowanie pliku
							$out = ob_get_contents();
							// zaczywywanie kompilowania pliku
							ob_end_clean();
							// dodawanie danych zmiennej $o
							$o .= $out;
							// zwalnianie danych z pamięci ram
							ob_clean();
						}
					};	
					// sprawdzanie czy wyświetlić nagłówek
					if($this->naglowek_plugin === false){					
						// zamykanie nagłówka pluginu (indefikatora)
						$o .= '</div>';
					}
				}
				// swracanie wyniku
				return $o;
			}else{
				return false;
			}
		}
		
		public function bm_top_widget(){
			// sprawdzanie czy objekt widget został dodany do wyświetlenia
			if(is_array(json_decode($this->top_plugin, true))){
				// zmienna przechowywujące wyrenderowane pluginu
				$t = '';
				// dodawanie header do wyniku renderowania
				$t .= $this->start_naglowek;
				// dodawanie wyrenderowanych widgrtów do wyniku
				$t .= bm_plugin::kompilowanie_widget(json_decode($this->top_plugin, true));
				// dodawanie zamknięcia header do wyniku
				$t .= '</div>';
				// zwracanie wyniku
				return $t;
			}else{
				return false;
			}
		}
		public function bm_left_widget(){
			// sprawdzanie czy objekt widget został dodany do wyświetlenia
			if(is_array(json_decode($this->left_plugin, true))){			
				// zmienna przechowywujące wyrenderowane pluginu
				$t = '';
				// dodawanie header do wyniku renderowania
				$t .= $this->start_naglowek;
				// dodawanie wyrenderowanych widgrtów do wyniku
				$t .= bm_plugin::kompilowanie_widget(json_decode($this->left_plugin, true));
				// dodawanie zamknięcia header do wyniku
				$t .= '</div>';
				// zwracanie wyniku
				return $t;			
			}else{
				return false;
			}				
		}	
		public function bm_right_widget(){
			// sprawdzanie czy objekt widget został dodany do wyświetlenia
			if(is_array(json_decode($this->right_plugin, true))){			
				// zmienna przechowywujące wyrenderowane pluginu
				$t = '';
				// dodawanie header do wyniku renderowania
				$t .= $this->start_naglowek;
				// dodawanie wyrenderowanych widgrtów do wyniku
				$t .= bm_plugin::kompilowanie_widget(json_decode($this->right_plugin, true));
				// dodawanie zamknięcia header do wyniku
				$t .= '</div>';
				// zwracanie wyniku
				return $t;		
			}else{
				return false;
			}			
		}
		public function bm_bottom_widget(){
			// sprawdzanie czy objekt widget został dodany do wyświetlenia
			if(is_array(json_decode($this->bottom_plugin, true))){			
				// zmienna przechowywujące wyrenderowane pluginu
				$t = '';
				// dodawanie header do wyniku renderowania
				$t .= $this->start_naglowek;
				// dodawanie wyrenderowanych widgrtów do wyniku
				$t .= bm_plugin::kompilowanie_widget(json_decode($this->bottom_plugin, true));
				// dodawanie zamknięcia header do wyniku
				$t .= '</div>';
				// zwracanie wyniku
				return $t;			
			}else{
				return false;
			}			
		}
		public function bm_footer_widget(){
			// sprawdzanie czy objekt widget został dodany do wyświetlenia
			if(is_array(json_decode($this->footer_plugin, true))){			
				// zmienna przechowywujące wyrenderowane pluginu
				$t = '';
				// dodawanie header do wyniku renderowania
				$t .= $this->start_naglowek;
				// dodawanie wyrenderowanych widgrtów do wyniku
				$t .= bm_plugin::kompilowanie_widget(json_decode($this->footer_plugin, true));
				// dodawanie zamknięcia header do wyniku
				$t .= '</div>';
				// zwracanie wyniku
				return $t;			
			}else{
				return false;
			}			
		}
	}
	
?>