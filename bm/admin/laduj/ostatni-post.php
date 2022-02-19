<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do Załadowania ostatniego posta ADMIN PANEL
	
	Black Min cms,
	
	#plik: 2.0
*/
	global $db_bm;

	$ostatni_post = $db_bm->query("SELECT * FROM `|prefix|bm_data_posty` ORDER BY `|prefix|bm_data_posty`.`id` DESC LIMIT 1");

	if ($ostatni_post) {
		define("LAST_POST", $ostatni_post);
	}else{
		echo "ERROR: Wystąpił błąd pod czas pobieranie ostatniego posta!";
		exit();
	}

?>