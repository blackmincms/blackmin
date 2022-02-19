<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do aktulizacji widżetów strony bm
	
	Black Min cms,
	
	#plik: 1.2
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['tab_top_box']))
	{
		// pobieranie danych metodą post
		$tab_top_box = $_POST['tab_top_box'];
		$tab_left_box = $_POST['tab_left_box'];
		$tab_right_box = $_POST['tab_right_box'];
		$tab_bottom_box = $_POST['tab_bottom_box'];
		$tab_footer_box = $_POST['tab_footer_box'];
		$tab_top_box2 = $_POST['tab_top_box2'];
		$tab_left_box2 = $_POST['tab_left_box2'];
		$tab_right_box2 = $_POST['tab_right_box2'];
		$tab_bottom_box2 = $_POST['tab_bottom_box2'];
		$tab_footer_box2 = $_POST['tab_footer_box2'];		
		// dekodowanie danych json
		$tab_top_box = json_decode($tab_top_box, true);
		$tab_left_box = json_decode($tab_left_box, true);
		$tab_right_box = json_decode($tab_right_box, true);
		$tab_bottom_box = json_decode($tab_bottom_box, true);
		$tab_footer_box = json_decode($tab_footer_box, true);
		$tab_top_box2 = json_decode($tab_top_box2, true);
		$tab_left_box2 = json_decode($tab_left_box2, true);
		$tab_right_box2 = json_decode($tab_right_box2, true);
		$tab_bottom_box2 = json_decode($tab_bottom_box2, true);
		$tab_footer_box2 = json_decode($tab_footer_box2, true);
		
		// zmienne przechowywujące dane o widgetach
		$tab_top_box_ = [];
		$tab_left_box_ = [];
		$tab_right_box_ = [];
		$tab_bottom_box_ = [];
		$tab_footer_box_ = [];
		// pobieranie ilośći elmeentów w tablicy
		$ile = count($tab_top_box);
		// sprawdzanie czy ciąg jest pusty
		if($ile === 0){
			$tab_top_box_ = "NULL";
		}else{
			for($i = 0; $i < $ile; $i++){
				// filtrowanie danych
				$tab_top_box_title = htmlentities($tab_top_box[$i]["title"], ENT_QUOTES, "UTF-8");
				$tab_top_box2_id = htmlentities($tab_top_box2[$i]["id"], ENT_QUOTES, "UTF-8");
				// tablica przechowywująca dane o pluginie
				$bm_plugin_ = [
					"plugin_full" => $tab_top_box2_id,
					"plugin" => $tab_top_box_title,
				];
				// dodawanie danych do tablicy już pogrupowane
				array_push($tab_top_box_, $bm_plugin_);
			}
		}
		// pobieranie ilośći elmeentów w tablicy
		$ile = count($tab_left_box);		
		if($ile === 0){
			$tab_left_box_ = "NULL";
		}else{
			for($i = 0; $i < $ile; $i++){
				// filtrowanie danych
				$tab_left_box_title = htmlentities($tab_left_box[$i]["title"], ENT_QUOTES, "UTF-8");
				$tab_left_box2_id = htmlentities($tab_left_box2[$i]["id"], ENT_QUOTES, "UTF-8");
				// tablica przechowywująca dane o pluginie
				$bm_plugin_ = [
					"plugin_full" => $tab_left_box2_id,
					"plugin" => $tab_left_box_title,
				];
				// dodawanie danych do tablicy już pogrupowane
				array_push($tab_left_box_, $bm_plugin_);
			}			
		}
		// pobieranie ilośći elmeentów w tablicy
		$ile = count($tab_right_box);		
		if($ile === 0){
			$tab_right_box_ = "NULL";
		}else{
			for($i = 0; $i < $ile; $i++){
				// filtrowanie danych
				$tab_right_box_title = htmlentities($tab_right_box[$i]["title"], ENT_QUOTES, "UTF-8");
				$tab_right_box2_id = htmlentities($tab_right_box2[$i]["id"], ENT_QUOTES, "UTF-8");
				// tablica przechowywująca dane o pluginie
				$bm_plugin_ = [
					"plugin_full" => $tab_right_box2_id,
					"plugin" => $tab_right_box_title,
				];
				// dodawanie danych do tablicy już pogrupowane
				array_push($tab_right_box_, $bm_plugin_);
			}					
		}
		// pobieranie ilośći elmeentów w tablicy
		$ile = count($tab_bottom_box);		
		if($ile === 0){
			$tab_bottom_box_ = "NULL";
		}else{
			for($i = 0; $i < $ile; $i++){
				// filtrowanie danych
				$tab_bottom_box_title = htmlentities($tab_bottom_box[$i]["title"], ENT_QUOTES, "UTF-8");
				$tab_bottom_box2_id = htmlentities($tab_bottom_box2[$i]["id"], ENT_QUOTES, "UTF-8");
				// tablica przechowywująca dane o pluginie
				$bm_plugin_ = [
					"plugin_full" => $tab_bottom_box2_id,
					"plugin" => $tab_bottom_box_title,
				];
				// dodawanie danych do tablicy już pogrupowane
				array_push($tab_bottom_box_, $bm_plugin_);
			}				
		}
		// pobieranie ilośći elmeentów w tablicy
		$ile = count($tab_footer_box);		
		if($ile === 0){
			$tab_footer_box_ = "NULL";
		}else{
			for($i = 0; $i < $ile; $i++){
				// filtrowanie danych
				$tab_footer_box_title = htmlentities($tab_footer_box[$i]["title"], ENT_QUOTES, "UTF-8");
				$tab_footer_box2_id = htmlentities($tab_footer_box2[$i]["id"], ENT_QUOTES, "UTF-8");
				// tablica przechowywująca dane o pluginie
				$bm_plugin_ = [
					"plugin_full" => $tab_footer_box2_id,
					"plugin" => $tab_footer_box_title,
				];
				// dodawanie danych do tablicy już pogrupowane
				array_push($tab_footer_box_, $bm_plugin_);
			}				
		}

		// enkodowanie danych json
		$tab_top_box_ = json_encode($tab_top_box_);
		$tab_left_box_ = json_encode($tab_left_box_);
		$tab_right_box_ = json_encode($tab_right_box_);
		$tab_bottom_box_ = json_encode($tab_bottom_box_);
		$tab_footer_box_ = json_encode($tab_footer_box_);
		
		$wszystko_ok = true;	
		
		// jęzeli walidacja przeszła pomyśnie to otwiera się połączenie z bazą danych
		
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
					mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");				
					
					if ($wszystko_ok == true)
					{

						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$tab_top_box_' WHERE `bm_nazwa` = 'bm_top_widget'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Top Widżet został zmieniony poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$tab_left_box_' WHERE `bm_nazwa` = 'bm_left_widget'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Left Widżet został zmieniony poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$tab_right_box_' WHERE `bm_nazwa` = 'bm_right_widget'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Right Widżet został zmieniony poprawnie! </section>';
						};	
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$tab_bottom_box_' WHERE `bm_nazwa` = 'bm_bottom_widget'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Bottom Widżet został zmieniony poprawnie! </section>';
						};	
						
						if ($rezultat = $polaczenie->query(
						sprintf("UPDATE `".$prefix_table."bm_ustawienia_bm` SET `bm_wartosc`='$tab_footer_box_' WHERE `bm_nazwa` = 'bm_footer_widget'")
						 ))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Footer Widżet został zmieniony poprawnie! </section>';
						};	
						
					}
					
					$polaczenie->close();
				}
				
			}
			
			  
			catch(Exception $e)
			{
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności!</span>';
			}			
			
		}
		
	}
	
?>