<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do ładowanie pr4
	
	load #pr4
	
	Black Min cms,
	
	#plik: 1.0
*/

	// ładowanie klass, fefine, bazy_danych, funkcji
	
	// tworzenie array który przechowa nam nazwy ładowanych elementów
	
	$laduj = array(
		"define-sciezka",
		"date-format",
	);
	
	function get_include_bm($laduj){
	
	$ile_laduj = count($laduj);
	
		for($i=0; $i<$ile_laduj; $i++){
			if ((require_once BMPATH . BM . LADUJ . $laduj[$i].".php") != true){
				echo  $i ." błąd! Nie można załadować pliku <b>". $laduj[$i]. ". </b>Plik nie istnieje lub został uszkodzony! <br />";
			}else{
				
			}
			
		}
		return true;
	};
	
	get_include_bm($laduj);
		
?>