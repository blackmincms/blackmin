<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do pobrania i ustawienia informacji o admin użytkowniku
	
	load kmblackmin
	
	Black Min cms,
	
	#plik: 1.0
*/

	# includowanie wybranego motywu przez administratora


		
		function set_admin_user_bm() {
			
			//$id = $_SESSION['id'];
			define('ID',$_SESSION['id'] );
			define('NICK',$_SESSION['nick'] );
			define('IMIE','$_SESSION["imie"]' );
			define('NAZWISKO','$_SESSION["nazwisko"]' );
			define('NR_TELEFONU','$_SESSION["nr_telefonu"]' );
			define('EMAIL','$_SESSION["email"]' );
			define('AVATAR','$_SESSION["avatar"]' );
			define('RANGA','$_SESSION["ranga"]' );
			define('FLAGA','$_SESSION["flaga"]' );
			define('ONLINE','$_SESSION["online"]' );
			
		}

		
set_admin_user_bm();	
		
?>