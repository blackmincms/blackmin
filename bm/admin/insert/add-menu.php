<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do dodawanie nowego menu do bazy
	
	Black Min cms,
	
	#plik: 1.1
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['tytul']))
	{
		// pobieranie danych metodą post
		
		$tytul = $_POST['tytul'];
		$url = $_POST['url'];
		$item_type = $_POST['item_type'];
		
		// walidowanie poprawnośći wpisanych danych
		$tytul = html_entity_decode($tytul, ENT_QUOTES, "UTF-8");
		$url = html_entity_decode($url, ENT_QUOTES, "UTF-8");
		$item_type = html_entity_decode($item_type, ENT_QUOTES, "UTF-8");
		
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
		}else{
			$wszystko_ok = false;
			echo '<section class="tsr-alert tsr-alert-error"> url zawiera niedozwolone znaki </section>';
		}
			
		$menu_item = [];
		
		array_push($menu_item, $tytul);
		array_push($menu_item, $url);
		array_push($menu_item, $item_type);
		
		$json_encode = json_encode($menu_item);
		
		// jęzeli jeżeli walidacja przeszła pomyśnie to otwiera się połączenie z bazą danych
		
		if($wszystko_ok == true){
			
			
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

					if ($wszystko_ok == true)
					{
						
						if ($polaczenie->query("INSERT INTO `".$prefix_table."bm_postmeta` VALUES (NULL, 'menu', 'new_menu_item', '$json_encode')"))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Menu zostało dodane </section>';
							echo '<script type="text/javascript">var done_add = 1; $("input[name=adres-url]").val("");$("input[name=tytul-menu]").val("");</script>';

						}
						else
						{
							throw new Exception($polaczenie->error);
						}
						
					}
					
					$polaczenie->close();
				}
				
			}
			
			  
			catch(Exception $e)
			{
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań w innym terminie!</span>';
			}			
			
		}
		
	}
	
?>