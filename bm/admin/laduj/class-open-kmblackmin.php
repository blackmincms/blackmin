<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do pobrania informacji o ustawionym motywie
	
	load kmblackmin
	
	Black Min cms,
	
	#plik: 1.0
*/

	# pobieranie danych o włączonym motywie strony
	
	class open_kmblackmin_motyw  {
		
		public $kmblackmin = "";
		
		public function open_plik_kmblackmin_motyw() {
			$open_kmblackmin = fopen(BMPATH . A . MOTYWY . "konfiguracja-motywu.kmblackmin", "r");
			$kmblackmin = fread($open_kmblackmin, 10);
			fclose($open_kmblackmin);
			return $kmblackmin;
		}
	}
	
?>