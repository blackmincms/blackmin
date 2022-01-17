<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do przekierowanie użytkownika na uwzględdniony adres url
	
	#pr1
	
	Black Min cms,
	
	#plik: 1.1
*/
				
	require_once("admin/black-min-sm.php");
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: logowanie.php');
		exit();
	}else{
		header('Location: admin/admin-panel.php');
		exit();
	}

?>