<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik przechowuje widgety wbudowanych na serwer
	
	Black Min cms,
	
	#plik: 1.0
*/
	
	function get_plugin_bm(){
		// zmienna przechowywująca dane o wbudowanych pluginach(widget) blackmin
		$bm_widget = [];
		// importowanie zmiennych globalnych
		global $szukaj_posta_kk;

		// widget blackmin (login)
		$bm_widget["logowanie"] = '
			<section class="tsr fs-100 tsr-p-10px bm-logowanie"><a href="'.BM_SETTINGS["url_server"].'bm/logowanie.php">Logowanie</a></section>
		';
		// widget blackmin (search)
		$bm_widget["wyszukiwarka"] = '
				<form accept-charset="UTF-8" action="" method="get" autocomplete="off" class="tsr-p-10px search_form_bm">	
					<section class="tsr tsr-position-relative">
						<input type="search" name="search" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj" value="'. $szukaj_posta_kk .'">
						<input type="image" name="search" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10" src="'.BM_SETTINGS["url_server"].'pliki/ikony/szukaj.png" >
					</section>
				</form>		
		';
		
		// sprawdzanie wszystkich pluginów
		return $bm_widget;
	}
?>