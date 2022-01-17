<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do edytowania danych menu 
	Black Min cms,
	
	#plik: 1.1
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['id_menu']))
	{
		// pobieranie danych metodą post
		
		$url = $_POST['url_adres_rename'];
		$tytul = $_POST['tytul_menu_rename'];
		$item_type = $_POST['item_type'];
		$id_menu = $_POST['id_menu'];

		// walidowanie poprawnośći wpisanych danych
		$tytul = html_entity_decode($tytul, ENT_QUOTES, "UTF-8");
		$url = html_entity_decode($url, ENT_QUOTES, "UTF-8");
		
		// tworzenie flagi do sprawdzenia poprawnośći danych
		$wszystko_ok = true;
		
		// sprawdzenie czy tytuł nie jest mniejszy od 1 i większy od 512
		if ((strlen($tytul)<1) || (strlen($tytul)>512))
		{
			$wszystko_ok = false;
			echo '<section class="tsr-alert tsr-alert-error"> tytuł jest za krutki lub za długi </section>';
		}
		
		// sprawdzenie czy url nie jest mniejszy od 1 i większy od 512
		if ((strlen($url)<1) || (strlen($url)>512))
		{
			$wszystko_ok = false;
			echo '<section class="tsr-alert tsr-alert-error"> url jest za krutki lub za długi </section>';
		}
		
		// walidowanie adresu url
		if (filter_var($url, FILTER_VALIDATE_URL)){
			//echo "url jest poprawne";
		}else{
			$wszystko_ok = false;
			echo '<section class="tsr-alert tsr-alert-error"> url zawiera niedozwolone znaki </section>';
		}
		
		// jeżeli wszystko ok to tworzymy tablice do przechowyania danych o menu itemie
		
		$menu_item = [];
		
		array_push($menu_item, $tytul);
		array_push($menu_item, $url);
		array_push($menu_item, $item_type);
		
		$json_encode = json_encode($menu_item);
		
		// zapisywanie struktury menu do bazy danychy	
			
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				
				mysqli_query($polaczenie, "SET CHARSET utf8");
				mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
			
				
				if ($wszystko_ok == true) {
				
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_postmeta` SET `bm_wartosc`='$json_encode' WHERE id = '$id_menu'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Element menu został zaktulizowany poprawnie! </section>';
					};	
				
				}
				
				$polaczenie->close();
			}
			
		}
          
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań w innym terminie!</span>';
		}			
			
	}
		
	
?>