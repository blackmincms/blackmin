<?php
/*
@
@		>>>> AQUAY <<<<
@
@	Timonix Aquay Edytor
@	Edytor Tekstowy i blokowy
@	Versja: beta 0.1
@	Autor: Timonix
@   Cobright: Wszelkie prawa zasczeżone 
@
@		>>>> AQUAY <<<<
@
*/
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do kompilowania kody zrozumiałego dla black min'a
	
	Black Min cms,
	
	#plik: 1.0
*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	function compiler_aquay_black_min($text) {
		
		$text = "$text";
		
		// pobieranie nicku autora posta z sesi
		$nick = $_SESSION['nick'];
		
		// pobieranie daty i godziny
		$datetime = (date("Y-m-d H:i")); 
		
		// rozpoczęcie kompilowania kodu
		$aquay_black_min = true;
		
		// sprawdzenie czy komilator js skompilował poprawnie kod
		$czy_poprawnie_skomilowano = stristr($text, "blackmin_kod");

		if ($czy_poprawnie_skomilowano == false) { // nie znaleziono słowa cholera
		   $error_compilate = "Error_tag_black_min / ";
		   $aquay_black_min = false;
		}
		
		// przypisanie użytkownika do skompilowanego kodu
		if ($aquay_black_min == true) {
			$text = str_replace("user-edytor-aquay", $nick, $text);
		}
		
		// przypisywanie ich do skompilowanego kodu
		if ($aquay_black_min == true) {
			$text = str_replace("datetime-edytor-aquay", $datetime, $text);
		}
		
		// sprawdzenie czy wystąpił błąd jeżeli nie to zwrócenie skomilowanego kodu
		if ($aquay_black_min == true) {
			return $text;
		}else{
			return $error_compilate;
		}
		
	}
	
?>