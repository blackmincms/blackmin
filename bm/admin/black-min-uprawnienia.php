<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do kontroli uprawnień wszystkich użytkowników Black Min
	
	#uprawnienia_bm
	
	Black Min cms,
	
	#plik: 1.1
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
	// tablica przechowywująca dane o plikach panelu bm które są oficialnymi nazwami
	$admin_url_sp = [
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
		"",
	];

	$admin_url_sp_per = [
		["url" => "admin-panel", "flaga" => [0,80]],
	];
	
?>