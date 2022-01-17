<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do pakowania i rozpakowania plików czyli kompresia i dekompresia plików(nie chodzi o kadłub samolotu :D)
	
	operowanie na plikach zip :D 
	
	Black Min cms,
	
	#plik: 1.1
*/



class xray_zip_bm {

	// funkcjia na kompresie plików (jeszcze nie poczeba :( .-. )
	
	public static function unzip($src, $do){
		$xray_zip = new ZipArchive;
		if ($xray_zip->open($src) !== TRUE) {
			// zwracanie błędu z dekompresią pliku zip
			return "error";
			exit();
		}else{
			// zwracanie potwierdzenia dekompresi pliku zip
			$xray_zip->extractTo($do);
			$xray_zip->close();
			return "success";
		}
	}
}

?>