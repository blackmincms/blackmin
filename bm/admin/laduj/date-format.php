<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do zamiany formatu daty i godziny na jakiś inny
	
	Black Min cms,
	
	#plik: 1.1
*/
	
	function data_format($datetime, $foramt_czasu) {
		
		$date = date_create($datetime);
		
		$datetime_format = date_format($date, $foramt_czasu);
		
		return $datetime_format;
		
	};

?>