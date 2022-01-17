<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do ładowanie menu Black Mina
	
	Black Min cms,
	
	#plik: 1.1.2
*/


	class menu_bm {
		
		// zmiene do generowania menu black min'abs
		var $rodzic_tag_menu = "ol";
		var $dziecko_tag_menu = "li";
		var $rodzic_sub_menu_tag = "ul";
		var $class_rodzic_menu = "menu";
		var $class_dziecko_menu = "menu-children";
		var $class_sub_menu = "menu-sub-parent";
	
		// funkcja sortująca itemu menu według kolejnośći
		// tablica z danymi do posortowania, tablica z strukturom sortującą, nazwa głównego kontenerta na sortowanie, box do przeciągania, box do przeczymywania itemów
		private function menu_sort($t, $x, $sort = "tsr-sortiner", $sorthandle = "tsr-sort-handle", $sort_item = "tsr-sort-item", $sortitem = "tsr-sortitem"){
			if((isset($t)) AND isset($x)){
				// sprawdzanie czy dane są w tablicy
				if((is_array($t)) AND (is_array($x))){
					// pobieranie indexu tablicy strukturalnej
					$ile_sort = count($x);
					// sprawdzanie czy tablica nie jest pusta
					if($ile_sort != 0){
						// zmienna przechowywująca strukture menu
						$r = "";
						// pętla do operacji na danych
						for($i = 0; $i < $ile_sort; $i++){
							$rev = array_search($x[$i]["id"], array_column($t, "id"));
							$menu_items = json_decode($t[$rev]["bm_wartosc"], true);
		
							$r .= '<'. $this->dziecko_tag_menu .' class="'. $this->class_dziecko_menu .'"><a href="'.$menu_items[1].'">'.$menu_items[0].'</a>';
		
							if(isset($x[$i]["children"])){
								$r .= '<'. $this->rodzic_sub_menu_tag .' class="'. $this->class_sub_menu .'">';
								$r .= menu_bm::menu_sort($t, $x[$i]["children"]);
								$r .= '</'. $this->rodzic_sub_menu_tag .'>';
							}
							
							$r .= '</'. $this->dziecko_tag_menu .'>';
						}
						
						// zwracanie danych posortowanych
						return $r;
					}else{
						return null;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		} 

		// funkcjia do zmiany tagu html dla generowanego menu
		public function set_tag_menu($rodzic_tag, $dziecko_tag, $rodzic_sub_menu_tag){
			$this->rodzic_tag_menu = $rodzic_tag;
			$this->dziecko_tag_menu = $dziecko_tag;
			$this->rodzic_sub_menu_tag = $rodzic_sub_menu_tag;
		}

		// funkcjia do zmiany klasy html dla generowanego menu
		public function add_class_menu($rodzic_class, $dziecko_class, $class_sub_menu){
			$this->class_rodzic_menu .= $rodzic_class;
			$this->class_dziecko_menu .= $dziecko_class;
			$this->class_sub_menu .= $class_sub_menu;
		}

		// funkcjia do zmiany klasy html dla generowanego menu
		public function set_class_menu($rodzic_class, $dziecko_class, $class_sub_menu){
			$this->class_rodzic_menu = $rodzic_class;
			$this->class_dziecko_menu = $dziecko_class;
			$this->class_sub_menu = $class_sub_menu;
		}
		
		// funkcjia do ładowania menu
		public function load_menu(){
			// przyłączanie danych
			// pobieranie zmiennych globalnych
			global $prefix_table,$db_bm,$get_ustawienia_bm;
			// pobieranie wszysatkich itemów z menu
			$q = $db_bm->query("SELECT * FROM `".$prefix_table."bm_postmeta` WHERE `bm_kontent` LIKE 'menu'");
			
			// sprawdzanie czy menu zawiera elmenty
			if((count(json_decode($get_ustawienia_bm["bm_get_menu_structur"], true))) AND (count($q)) != 0){
				// renderowanie i zwracanie wyniku
				return '<'. $this->rodzic_tag_menu .' class="'. $this->class_rodzic_menu .'">' . menu_bm::menu_sort($q, json_decode($get_ustawienia_bm["bm_get_menu_structur"], true)) .  '</'. $this->rodzic_tag_menu .' ">';		
			}else{
				return null;
			}
		}

	}

?>