<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do pobrania informacji o ustawionym motywie
	
	load kmblackmin
	
	Black Min cms,
	
	#plik: 1.1
*/

	# includowanie wybranego motywu przez administratora

	class open_motyw_bm{
		public function open_aktywny_motyw_bm() {
			require_once BMPATH . A . MOTYWY . BM_SETTINGS["bm_theme_active"] . "/" ."index.php";
		}
	}
		
?>