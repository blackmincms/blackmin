<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do dodawanie edytowania danych posta 
	Black Min cms,
	
	#plik: 1.1
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['tytul']))
	{
		// pobieranie danych metodą post
		
		$id_post = $_POST['id_post'];
		
		$tytul_spr = $_POST['tytul_spr'];
		$url_spr = $_POST['url_spr'];
		$kategoria_spr = $_POST['kategoria_spr'];
		$kategoria_post_spr = $_POST['kategoria_post_spr'];
		$status_spr = $_POST['status_spr'];
		$haslo_spr = $_POST['password_spr'];
		$tag_spr = $_POST['tag_spr'];
		$tresc_spr = $_POST['tresc_spr'];
		
		$tytul = $_POST['tytul'];
		$url = $_POST['url'];
		$kategoria = $_POST['kategoria'];
		$kategoria_post = $_POST['kategoria_post'];
		$status = $_POST['status'];
		$haslo = $_POST['password_post'];
		$tag = $_POST['tag'];
		$tresc = $_POST['tresc'];
		$miniaturka = $_POST['miniaturka'];
		
		$wszystko_ok = true;
		
		if (($tytul_spr == $tytul) AND ($url_spr == $url) AND ($kategoria_spr == $kategoria) AND ($kategoria_post_spr == $kategoria_post) AND ($status_spr == $status) AND ($haslo_spr == $haslo) AND ($tag_spr == $tag) AND ($tresc == $tresc_spr)) {
			echo '<section class="tsr-alert tsr-alert-info"> Chyba by wypadało coś zmienić! Nie sądzisz? </section>';
			$wszystko_ok = false;
			exit();
		}
		
		// sprawdzanie czy status jest zabespieczony hasłem
		
		if($status != "protect_password") {
			$haslo = "";
		}
		
		// pobieranie nicku autora posta z sesi
		
		$nick = $_SESSION['nick'];
		
		// formatowanie daty
		
		$datetime = (date("Y-m-d H:i")); 

		// filtrowanie danych dla pewnośći

		$tytul = htmlentities($tytul, ENT_QUOTES, "UTF-8");
		$url = htmlentities($url, ENT_QUOTES, "UTF-8");
		$kategoria = htmlentities($kategoria, ENT_QUOTES, "UTF-8");
		$kategoria_post = htmlentities($kategoria_post, ENT_QUOTES, "UTF-8");
		$status = htmlentities($status, ENT_QUOTES, "UTF-8");
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
		//$date = htmlentities($date, ENT_QUOTES, "UTF-8");
		$tag = htmlentities($tag, ENT_QUOTES, "UTF-8");
		//$tresc_post = htmlspecialchars($tresc_post, ENT_QUOTES, "UTF-8");
		
		
		$wszystko_ok = true;
		
		
		if ((strlen($tytul)<1) || (strlen($tytul)>256))
		{
			$wszystko_ok = false;
		}
		
		if ((strlen($url)<1) || (strlen($url)>256))
		{
			$wszystko_ok = false;
		}
		
		if ((strlen($haslo)<0) || (strlen($haslo)>28))
		{
			$wszystko_ok = false;
		}
		
		if(preg_match('/^[a-zA-Z0-9 ]*$/', $url)){
		}else{
			$wszystko_ok = false;
			echo '<section class="tsr-alert tsr-alert-error"> url zawiera niedozwolone znaki </section>';
		}
		
		
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
				mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");	

				// sprawdzanie czy url już istnieje

				if($url_spr != $url) {
					if ($rezultat = $polaczenie->query(
					sprintf("SELECT * FROM `".$prefix_table."bm_data_posty` WHERE `url` LIKE '$url'")
					 ))
					{
					
						$ile_url = mysqli_num_rows($rezultat);
						
						if($ile_url >= "1"){
							echo '<section class="tsr-alert tsr-alert-error"> nie możę być więcej niż jeden taki sam url </section>';
							$wszystko_ok = false;
						}
		
					};		
				}
				
				// jeżeli wszystkie testy walidacyjne przeszły pomyśnie to dodajemy nowy post
				// wyśiwtlamy informacje dla użytkownika że post został dodany do bazy danych
				
				if ($wszystko_ok == true)
				{
					
					if ($rezultat = $polaczenie->query(
					sprintf("UPDATE `".$prefix_table."bm_data_posty` SET `tytul`='$tytul',`url`='$url',`kategoria`='$kategoria',`kategoria_post`='$kategoria_post',`status`='$status',`password_post`='$haslo',`tagi`='$tag',`datetime_zmiany`='$datetime',`kto_edit`='$nick', `bm_komentarze`='false', `bm_miniaturka`='$miniaturka',`tresc`='$tresc' WHERE `id` = '$id_post'")
					 ))
					{
						echo '<section class="tsr-alert tsr-alert-success"> Post został zmieniony poprawnie! </section>';
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
		
	}
	
?>