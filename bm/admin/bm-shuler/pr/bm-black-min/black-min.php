<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy opsługi połączeń cms'a
	
	#pr1
	
	Black Min cms,
	
	#plik: 1.2
*/

	# publiczne zmiene error load motywu, skryptów, języka i nie tylko
	
	$bm_motyw=false;$bm_plugin=false;$bm_jezyk=false;
	
	//  ustawienie zmienych motyw, plugin, jezyk jako zmiene globalne
	
	global $bm_motyw,$bm_plugin,$bm_jezyk;
	
	// tworzenie daty i czasu serwera według określonych struktur czasowych
	
	$date = date('Y-m-d');
	$date2 = date('Y.m.d');
	$date3 = date('d-m-Y');
	$date4 = date('d.m.Y');
	$time = date('H:i');
	$time2 = date('H:i:s');
	
	// ustawienie zmienych data i czas jako globalne
	
	global $date, $date2, $date3, $date4, $time, $time2;
	
	// ustawienie daty, czasu i zmienych bazy danych do sesi
	
	$_SESSION['date'] = $date;
	$_SESSION['date2'] = $date2;
	$_SESSION['date3'] = $date3;
	$_SESSION['date4'] = $date4;
	$_SESSION['time'] = $time;
	$_SESSION['time2'] = $time2;
	
	// ustawienie globalnego statusu połączenia black mina
	
	$GLOBAL_STATUS = true;

	// pobieranie ścieżki katalogu głównego
	if(!defined('BMPATH_')) {
		define('BMPATH_', dirname( __FILE__ ).'/' );
	};
	
	// otwieranie sesii black mina
	require_once(BMPATH_ . "../../../black-min-sm.php");
	
?>