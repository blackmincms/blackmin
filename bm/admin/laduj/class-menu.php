<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do pobrania informacji o ustawionym motywie
	
	load kmblackmin
	
	Black Min cms,
	
	#plik: 1.0
*/

	# includowanie wybranego motywu przez administratora


	class get_admin_menu_left_bm {

	$admin_menu_left = [
		"panel",
		"add-post",
		"all-post",
		"kategorie-tagi-post",
		"ustawienia",
		"black-min",
		"socialmedia",
		"statystyki",
		"user-all",
		"add-user",
		"ustawienia-posta",
		"update-bm",
		"dysk",
		"add-dane",
		"komentarze",
		"motywy-bm",
		"pluginy",
		"add-plugin",
		"skrypty",
		"add-skrypt",
		"edit-skrypt",
		"moj-profil",
		"baza-danych",
		"import-baza-danych",
		"eksport-baza-danych",
		"eksport-baza-danych",
		"meil",
		"ustawienia-spoleczne",
		"ustawienia-linki-i-czas",
		"ustawienia-prywatnosc",
	];

	$admin_menu_left_sciezka = [
		"admin-panel",
		"admin-add-post",
		"admin-all-post",
		"admin-kategorie-tagi-post",
		"admin-ustawienia",
		"admin-black-min",
		"admin-socialmedia",
		"admin-statystyki",
		"admin-user-all",
		"admin-add-user",
		"admin-ustawienia-posta",
		"admin-update-bm",
		"admin-dysk",
		"admin-add-dane",
		"admin-komentarze",
		"admin-motywy-bm",
		"admin-pluginy",
		"admin-add-plugin",
		"admin-skrypty",
		"admin-add-skrypt",
		"admin-edit-skrypt",
		"admin-moj-profil",
		"admin-baza-danych",
		"admin-import-baza-danych",
		"admin-eksport-baza-danych",
		"admin-eksport-baza-danych",
		"admin-meil",
		"admin-ustawienia-spoleczne",
		"admin-ustawienia-linki-i-czas",
		"admin-ustawienia-prywatnosc",
	];
	
	$ile_laduj2 = count($admin_menu_sciezka);
		
		public $admin_menu_left;
		
		public $admin_menu_left_sciezka;
		
		public function get_admin_menu_left_bm() {
			
		for($i=0; $i<$ile_laduj; $i++){

			echo $admin_menu_left[$i];
			
		}
			
		}
		
		public function get_admdn_menu_left_sciezka_bm() {
			
		for($i2=0; $i2<$ile_laduj2; $i2++){
			
			
		}
			
		}
	}
		
?>