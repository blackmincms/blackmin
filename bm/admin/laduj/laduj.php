<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do ładowanie pr4
	
	load #pr4
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie klass, fefine, bazy_danych, funkcji
	
	// tworzenie array który przechowa nam nazwy ładowanych elementów
	
	$laduj = [
		"ustawienia",
		"status",
		"define-sciezka",
		"statystyki",
		"ostatni-post",
		"date-format",
		"text-wrap",
		"cut",
		"get-kategoria-tag",
		"class-timonix-ttk",
	];
	
	$ile_laduj = count($laduj);
	
	for($i=0; $i<$ile_laduj; $i++){
		$sprawdz_plik = file_exists($laduj[$i].".php"); //sprawdzenie czy plik istnieje
		if (BMPATH . LADUJ . $sprawdz_plik) //jeżeli plik nie istnieje (zmienna $test=FALSE)  
		{ 
		
			require_once BMPATH . LADUJ . $laduj[$i].".php";
			
		}else{
		
		echo "Error Na Serwerze Nie Ma Pliku" .$laduj[$i].".php"; //informacja o braku pliku na serwerze
		
		}
		
	}

?>