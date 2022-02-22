<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do załadowanie cms
	ładowanie wszystkch elemtetów bm i pokazywanie błędów jeżeli są takie
	
	Black Min cms,
	
	#plik: 1.0
*/

	# publiczne zmiene error load motywu, skryptów, języka i nie tylko
	
	$bm_motyw=false;$bm_plugin=false;$bm_jezyk=false;
	
	global $bm_motyw,$bm_plugin,$bm_jezyk;
	
	# ładowanie motywu bm
	
	require_once BMPATH . "bm-motyw.php";
	
	# ładowanie pluginów bm
	
	require_once BMPATH .  "bm-plugin.php";
	
	# ładowanie języka bm
	
	require_once BMPATH . "bm-jezyk.php";
	
	# sprawdzanie czy pliki istnieją i czy motyw, pluginy i język się załadował poprawnie
	
	if ($bm_motyw != true){
		echo "<h1>błąd ładowania motywu strony Black Min.</h1>
			<h4>W tej sprawie skontaktuj się z administratorem strony!</h4>
			<h5>kod błędu: ERROR_LOAD_THEME</h5>
		";
	};
	
	if ($bm_plugin != true){
		echo "<h1>błąd ładowania pluginu strony Black Min.</h1>
			<h4>W tej sprawie skontaktuj się z administratorem strony!</h4>
			<h5>kod błędu: ERROR_LOAD_PLUGIN</h5>
		";
	};
	
	if ($bm_jezyk != true){
		echo "<h1>błąd ładowania języka strony Black Min.</h1>
			<h4>W tej sprawie skontaktuj się z administratorem strony!</h4>
			<h5>kod błędu: ERROR_LOAD_LANGUE</h5>
		";
	};
	
?>