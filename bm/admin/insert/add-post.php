<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do dodawanie nowego posta przez admina
	
	Black Min cms,
	
	#plik: 1.0
*/
				
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	require_once "../../../connect.php";
	require_once "../../../files/global/timonix-aquay-edytor/aquay-black-min-compiler.php";
	
	// sprawdzanie danych do dodania post czy przyszły sprawdzanie poprawnośći wpsianych danych z standardem określonym przez Timoni'x
	
	if(isset($_POST['tytul']))
	{
		// pobieranie danych metodą post
		
		$tytul = $_POST['tytul'];
		$url = $_POST['url'];
		$kategoria = $_POST['kategoria'];
		$kategoria_post = $_POST['kategoria_post'];
		$status = $_POST['status'];
		$haslo = $_POST['password_post'];
		$tag = $_POST['tag'];
		$tresc = $_POST['tresc'];
		$miniaturka = $_POST['miniaturka'];
		
		$tresc = compiler_aquay_black_min($tresc);

		// sprawdzenie czy komilator js skompilował poprawnie kod
		$czy_blad = stristr($tresc, "Error_tag_black_min");

		if ($czy_blad == true) { // nie znaleziono słowa cholera
			echo '<section class="tsr-alert tsr-alert-error"> Wystąpił błąd przy komilowaniu kodu! - kod błędu: Error_tag_black_min </section>';
		}
		
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
		$tag = htmlentities($tag, ENT_QUOTES, "UTF-8");
		
		
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
			// filtrowanie url // pozbawianie go spacji
			$url = str_replace(" ", "-", $url);
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

					if ($rezultat = @$polaczenie->query(
					sprintf("SELECT * FROM `".$prefix_table."bm_data_posty` WHERE `url` LIKE '$url'")
					 ))
					{
					
						$ile_url = mysqli_num_rows($rezultat);
						
						if($ile_url >= "1"){
							echo '<section class="tsr-alert tsr-alert-error"> nie możę być więcej niż jeden taki sam url <section>';
							$wszystko_ok = false;
						}
		
					};				
					
					if ($wszystko_ok == true)
					{
						
						// chwilowe wszczywanie dodawania
						if ($polaczenie->query("INSERT INTO `".$prefix_table."bm_data_posty` VALUES (NULL, '$nick', '$tytul', '$url', '$kategoria', '$kategoria_post', '$status', '$haslo', '$tag', '$datetime', '$datetime', '$nick', '0', 'false', '$miniaturka', '$tresc')"))
						{
							echo '<section class="tsr-alert tsr-alert-success"> Post został dodany </section>';
						}else{
							throw new Exception($polaczenie->error);
						}
							
					}	
					
				}
				
				$polaczenie->close();
			}
			
			catch(Exception $e)
			{
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań w innym terminie!</span>';
			}	
			
		}else{
			echo '<section class="tsr-alert tsr-alert-error"> Wystąpił błąd pod czas dodawania posta </section>';
			exit;
		}	
		
	}
	
?>