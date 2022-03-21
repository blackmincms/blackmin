<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do ładowanie posdtawowych ustawienia Black Mina
	
	Black Min cms,
	
	#plik: 2.0
*/

	class bm_settings {

		protected $save = null;		

		public function get() {
			global $db_bm;
			
			$t = $db_bm->query("SELECT * FROM `|prefix|bm_ustawienia_bm`", false);

			$this->save = $t["num_rows"];

			// buffor
			$c = [];

			for ($i=0; $i < $t["num_rows"]; $i++) { 
				$c[$t[$i]["bm_nazwa"]] = $t[$i]["bm_wartosc"];
			}

			return $c;
		}

		public function count() {
			return $this->save;
		}		

	}

?>