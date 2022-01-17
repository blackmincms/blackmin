<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do aktulizacji ustawień stylu css serwera black min
	
	Black Min cms,
	
	#plik: 1.2
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	require_once "../../../connect.php";
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['tlo_motywu']))
	{
		// pobieranie danych metodą post
		
		$tlo_motywu = $_POST['tlo_motywu'];
		$kolor_czcionki_motywu = $_POST['kolor_czcionki_motywu'];
		$kolor_czcionki_linku_motywu = $_POST['kolor_czcionki_linku_motywu'];
		$kolor_czcionki_linku_hover_motywu = $_POST['kolor_czcionki_linku_hover_motywu'];
		$kolor_czcionki_linku_aktywny_motywu = $_POST['kolor_czcionki_linku_aktywny_motywu'];
		$kolor_czcionki_linku_visitet_motywu = $_POST['kolor_czcionki_linku_visitet_motywu'];

		$zapisz = "
	/*
	*
	*			Domyśny wygląd motywu - niezależnie od motywu
	*	Możliwość zmiany wyglądu strony bez zmieniania w kodzie motywu
	*
	* 	/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\
	*	
	*	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	*	
	*	ten plik służy do aktulizacji personalizacji podstawowego wyglądu motywu black min
	*	
	*	Black Min cms,
	*	
	*	#plik: 1.0
	*
	*/
		
	html, body {
		background-color: $tlo_motywu;
		color: $kolor_czcionki_motywu;
	}
	
	a {
		color: $kolor_czcionki_linku_motywu;
	}
	
	a::visited  {
		color: $kolor_czcionki_linku_visitet_motywu;
	}

	a::active  {
		color: $kolor_czcionki_linku_aktywny_motywu;
	}

	a::hover {
		color: $kolor_czcionki_linku_hover_motywu;
	}	
		
		";

		// uchwyt pliku, otwarcie do dopisania
		$file_open = fopen("../../../files/css/default-style-theme-blackmin.css", "w");

		// blokada pliku do zapisu
		flock($file_open, 2);

		// zapisanie danych do pliku
		fwrite($file_open, $zapisz);

		// odblokowanie pliku
		flock($file_open, 3);

		// zamknięcie pliku
		fclose($file_open);	

		echo '
			<section class="tsr-alert tsr-alert-success">
				Dane Pliku zostały zmienione poprawnie!
			</section>
		';		
		
	}
	
?>