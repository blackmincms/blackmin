<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do ucięcia za dużych wyrazów i wstawienie ich do następnej liniki
	
	Black Min cms,
	
	#plik: 1.1
*/
	
	function cut($tekst,$ile){
		
		if (strlen($tekst) > $ile) {
		  $tekst=substr($tekst, 0, $ile);
			for ($a=strlen($tekst)-1;$a>=0;$a--) {
				if ($tekst[$a]==" ") {
					$tekst=substr($tekst, 0, $a)."...";
					break;
				};
			};
		};
		return $tekst;
	}

?>