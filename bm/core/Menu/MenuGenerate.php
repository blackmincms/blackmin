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
*	This file is rendering menu
*/

	// declare(use_strict=1);

	namespace BlackMin\Menu;

	final class MenuGenerate {
		
		// zmiene do generowania menu black min'
		/**
		 * @var string
		 */
		private $rodzic_tag_menu = "ol";
		/**
		 * @var string
		 */
		private $dziecko_tag_menu = "li";
		/**
		 * @var string
		 */
		private $rodzic_sub_menu_tag = "ul";
		/**
		 * @var string
		 */
		private $class_rodzic_menu = "menu";
		/**
		 * @var string
		 */
		private $class_dziecko_menu = "menu-children";
		/**
		 * @var string
		 */
		private $class_sub_menu = "menu-sub-parent";
	
		// funkcja sortująca itemu menu według kolejnośći
		// tablica z danymi do posortowania, tablica z strukturom sortującą, nazwa głównego kontenerta na sortowanie, box do przeciągania, box do przeczymywania itemów
		private function menuSort(array $menuItem, array $structure, string $sort = "tsr-sortiner", string $sorthandle = "tsr-sort-handle", string $sort_item = "tsr-sort-item", string $sortitem = "tsr-sortitem"):string {
			
			// zmienna przechowywująca strukture menu
			$cache = "";
			// pętla do operacji na danych
			foreach ($structure as $key => $value) {
				$rev = array_search($value["id"], array_column($menuItem, "id_meta"));
				if (!$rev) {
					break;
				}
				$menu_items = json_decode($menuItem[$rev]["bm_value"], true);

				$cache .= '<'. $this->dziecko_tag_menu .' class="'. $this->class_dziecko_menu .'"><a href="'.$menu_items[1].'">'.$menu_items[0].'</a>';

				if(isset($value["children"])){
					$cache .= '<'. $this->rodzic_sub_menu_tag .' class="'. $this->class_sub_menu .'">';
					$cache .= $this->menuSort($menuItem, $value["children"]);
					$cache .= '</'. $this->rodzic_sub_menu_tag .'>';
				}

				$cache .= '</'. $this->dziecko_tag_menu .'>';
			}

			return $cache;
		} 

		// funkcjia do zmiany tagu html dla generowanego menu
		public function setTag($rodzic_tag, $dziecko_tag, $rodzic_sub_menu_tag){
			$this->rodzic_tag_menu = $rodzic_tag;
			$this->dziecko_tag_menu = $dziecko_tag;
			$this->rodzic_sub_menu_tag = $rodzic_sub_menu_tag;
		}

		// funkcjia do zmiany klasy html dla generowanego menu
		public function addClass($rodzic_class, $dziecko_class, $class_sub_menu){
			$this->class_rodzic_menu .= $rodzic_class;
			$this->class_dziecko_menu .= $dziecko_class;
			$this->class_sub_menu .= $class_sub_menu;
		}

		// funkcjia do zmiany klasy html dla generowanego menu
		public function setClass($rodzic_class, $dziecko_class, $class_sub_menu){
			$this->class_rodzic_menu = $rodzic_class;
			$this->class_dziecko_menu = $dziecko_class;
			$this->class_sub_menu = $class_sub_menu;
		}
		
		// funkcjia do ładowania menu
		public function loadMenu(array $menuItem){		
			// sprawdzanie czy menu zawiera elmenty
			if(($menuItem["bm_menu_structur"] !== false) AND (count($menuItem["bm_menu_items"])) !== 0){
				// renderowanie i zwracanie wyniku
				return '<'. $this->rodzic_tag_menu .' class="'. $this->class_rodzic_menu .'">' . $this->menuSort($menuItem["bm_menu_items"], $menuItem["bm_menu_structur"]) .  '</'. $this->rodzic_tag_menu .' ">';		
			}else{
				return null;
			}
		}

	}

?>