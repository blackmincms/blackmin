<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyciągania wszystkich plików(Bibliotek) wgranych na serwer
	
	#Zawannsowane szukanie
	
	Black Min cms,
	
	#plik: 1.1
*/

	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	require_once "class-get-ustawienia.php";
	require_once "cut.php";
	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	$get_ustawienia_bm = new get_ustawienia_bm(); 
	$get_ustawienia_bm->get_ustawienia();
	$ustawienia_bm = $get_ustawienia_bm->get_ustawienia();
	$url_serwera_bm = $ustawienia_bm["bm_wartosc"][0];
	
	// odbieranie od skryptu metodą post informacji na temat poszukiwanych rekordów w bacie danych
	
	if (isset ($_POST['ile_load'])){
		$ile_load = $_POST['ile_load'];
	}else {
		$ile_load = "25";
	}
	
	// renderowanie odpowiedniego wyniku szukanychh informacji przez użytkownika

	// tworzenie tablicy do przechowywania nazw folderów skryptów black min'a
	$all_katolog = [];

	// pobieranie wszystkich katologów skryptów zainstalowanych na serwerze
	foreach (glob('../../../a/biblioteki/*', GLOB_ONLYDIR) as $katalog) {
		$katalog_reserch = explode("/", $katalog);
		array_push($all_katolog, $katalog_reserch[5]);
	}
	
	// sortowanie odpowiednio tablicy
	sort($all_katolog);

	// tworzenie tablicy do przecowywania rekordów pobranych z plików iniciujących Skryptach
	$kontent_biblioteka_load = [];
	
	// schemat dla przerchowyania danych o bibliotece
	$bm_name = "";
	$bm_description = "";
	$bm_autor = "";
	$bm_date_create = "";
	$bm_url_library_bm = "";
	$bm_amup_bm = "";
	$bm_versions = "";
	$bm_autor_website = "";

	// zmiene do przechowywania zainstalowanych folderów(czyli zaindexowanych)
	$aktywna_nazwa_biblioteka_bm = [];
	$aktywna_biblioteka_bm = [];

	// pobieranie danych o aktywnym bibliotece
	
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

				if ($rezultat = $polaczenie->query(
				sprintf("SELECT * FROM `".$prefix_table."bm_postmeta` WHERE `bm_kontent` LIKE 'biblioteka'")
				 ))
				{
				
					$ile_aktywnych_bibliotek = mysqli_num_rows($rezultat);
					
					for ($i = 0; $i < $ile_aktywnych_bibliotek; $i++) {
					
						$row = mysqli_fetch_assoc($rezultat);
						array_push($aktywna_nazwa_biblioteka_bm, $row['bm_nazwa']);
						array_push($aktywna_biblioteka_bm, $row['bm_wartosc']);
					}
	
				};		
			
			$polaczenie->close();
		}
		
	}
	
	  
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań w innym terminie!</span>';
	}	
	
	// zliczanie zajnstalowanych skryptów
	$zlicz_zainstalowane_skryptow = count($all_katolog);
	
	// otwieranie plików i pobieranie danych do odczytania skryptu
	for ($i = 0; $i < $ile_aktywnych_bibliotek; $i++) {
		
		// ładowanie zainstalowanych skryptów
		$open_biblioteke_kontent = file_get_contents("../../../a/biblioteki/" . $aktywna_nazwa_biblioteka_bm[$i] ."/library.js");
		
		if (strstr($open_biblioteke_kontent, "bm_description:")===False) {
			$bm_description = false;
		}else{
			// przypisywanie zmienych do informacji o bibliotece
			$bm_description = explode("bm_description:", "$open_biblioteke_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_description = explode("//", $bm_description[1]);
			$bm_description = $bm_description[0];
		};
		if (strstr($open_biblioteke_kontent, "bm_author:")===False) {
			$bm_author = false;
		}else{
			// przypisywanie zmienych do informacji o bibliotece
			$bm_author = explode("bm_author:", "$open_biblioteke_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_author = explode("//", $bm_author[1]);
			$bm_author = $bm_author[0];
		};
		if (strstr($open_biblioteke_kontent, "bm_date_create:")===False) {
			$bm_date_create = false;
		}else{
			// przypisywanie zmienych do informacji o bibliotece
			$bm_date_create = explode("bm_date_create:", "$open_biblioteke_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_date_create = explode("//", $bm_date_create[1]);			
			$bm_date_create = $bm_date_create[0];
		};
		if (strstr($open_biblioteke_kontent, "bm_url_library_bm:")===False) {
			$bm_url_library_bm = false;
		}else{
			// przypisywanie zmienych do informacji o bibliotece
			$bm_url_library_bm = explode("bm_url_library_bm:", "$open_biblioteke_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_url_library_bm = explode("//", $bm_url_library_bm[1]);		
			$bm_url_library_bm = $bm_url_library_bm[0];
		};
		if (strstr($open_biblioteke_kontent, "bm_amup_bm:")===False) {
			$bm_amup_bm = false;
		}else{
			// przypisywanie zmienych do informacji o bibliotece
			$bm_amup_bm = explode("bm_amup_bm:", "$open_biblioteke_kontent");	
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_amup_bm = explode("//", $bm_amup_bm[1]);			
			$bm_amup_bm = $bm_amup_bm[0];
		};
		if (strstr($open_biblioteke_kontent, "bm_versions:")===False) {
			$bm_versions = false;
		}else{
			// przypisywanie zmienych do informacji o bibliotece
			$bm_versions = explode("bm_versions:", "$open_biblioteke_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_versions = explode("//", $bm_versions[1]);			
			$bm_versions = $bm_versions[0];
		};
		
		if (strstr($open_biblioteke_kontent, "bm_autor_website:")===False) {
			$bm_autor_website = false;
		}else{
			// przypisywanie zmienych do informacji o bibliotece
			$bm_autor_website = explode("bm_autor_website:", "$open_biblioteke_kontent");	
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_autor_website = explode("//", $bm_autor_website[1]);
			$bm_autor_website = $bm_autor_website[0];
		};
		
		
		if ($bm_description === false){
			echo '<section class="tsr-alert tsr-alert-error"> Kod Błędu: ERROR_LIBRARY_DESCRIPTION </section>';
			echo '<section class="tsr-alert tsr-alert-error"> Error w bibliotece:  '.$all_katolog[$i].' </section>';
			exit();
		}
		
		if ($bm_author === false){
			echo '<section class="tsr-alert tsr-alert-error"> Kod Błędu: ERROR_LIBRARY_AUTHOR </section>';
			echo '<section class="tsr-alert tsr-alert-error"> Error w bibliotece:  '.$all_katolog[$i].' </section>';
			exit();
		}
		
		if ($bm_date_create === false){
			$bm_date_create = "Nie Podano Daty Stworzenia Skryptu!";
		}
		
		if ($bm_url_library_bm === false){
			echo '<section class="tsr-alert tsr-alert-error"> Kod Błędu: ERROR_LIBRARY_URL </section>';
			echo '<section class="tsr-alert tsr-alert-error"> Error w bibliotece:  '.$all_katolog[$i].' </section>';
			exit();
		}
		
		if ($bm_amup_bm === false){
			echo '<section class="tsr-alert tsr-alert-error"> Kod Błędu: ERROR_LIBRARY_AUMP </section>';
			echo '<section class="tsr-alert tsr-alert-error"> Error w bibliotece:  '.$all_katolog[$i].' </section>';
			exit();
		}
		
		if ($bm_versions === false){
			$bm_versions = "Nie Podano Dokładnej Wersji! : Alfa";
		}
		
		if ($bm_amup_bm === false){
			echo '<section class="tsr-alert tsr-alert-error"> Kod Błędu: ERROR_LIBRARY_AUMP </section>';
			echo '<section class="tsr-alert tsr-alert-error"> Error w bibliotece:  '.$all_katolog[$i].' </section>';
			exit();
		}
		
		if ($bm_autor_website === false){
			$bm_autor_website = "Autor Skryptu Nie Podał Własnej Strony!";
		}
		
		$check_img = file_exists("../../../a/biblioteki/$all_katolog[$i]/miniaturka.png");
		
		if ($check_img === false) {
			$bm_miniaturka = $url_serwera_bm."/pliki/banner/placeholder.jpg";
		}else{
			$bm_miniaturka = $url_serwera_bm."a/biblioteki/$all_katolog[$i]/miniaturka.png";
		}

		$schemat_biblioteka = [
		'bm_name' => $aktywna_nazwa_biblioteka_bm[$i],
		'bm_description' => $bm_description,
		'bm_author' => $bm_author,
		'bm_date_create' => $bm_date_create,
		'bm_url_library_bm' => $bm_url_library_bm,
		'bm_amup_bm' => $bm_amup_bm,
		'bm_versions' => $bm_versions,
		'bm_autor_website' => $bm_autor_website,
		'bm_logo_library' => $bm_miniaturka,
		];
		
		array_push($kontent_biblioteka_load, $schemat_biblioteka);
	
	}
	
	// obliczanie ile użytkownik chciał mieć pokazane Skryptów a ile można wyświetlić
	if ($ile_load > $zlicz_zainstalowane_skryptow) {
		$ile_load = $zlicz_zainstalowane_skryptow;
	}		
	
	for ($i = 0; $i < $ile_aktywnych_bibliotek; $i++) 
	{
					
		$id_biblioteka = $i;
		$bm_name = $kontent_biblioteka_load[$i]['bm_name'];
		$bm_description = $kontent_biblioteka_load[$i]['bm_description'];
		$bm_autor = $kontent_biblioteka_load[$i]['bm_author'];
		$bm_date_create = $kontent_biblioteka_load[$i]['bm_date_create'];
		$bm_url_library_bm = $kontent_biblioteka_load[$i]['bm_url_library_bm'];
		$bm_amup_bm = $kontent_biblioteka_load[$i]['bm_amup_bm'];
		$bm_versions = $kontent_biblioteka_load[$i]['bm_versions'];
		$bm_autor_website = $kontent_biblioteka_load[$i]['bm_autor_website'];
		$bm_logo_library = $kontent_biblioteka_load[$i]['bm_logo_library'];
		
		$bm_name2 = $bm_name;
		
		// szukanie pod którym indexem jest dany biblioteka
		$biblioteka_reserch2 = array_search($bm_name, $aktywna_nazwa_biblioteka_bm);
		
		// sprawdzanie czy biblioteka jest aktywny 
		$biblioteka_reserch = explode(",", $aktywna_biblioteka_bm[$biblioteka_reserch2]);
		
		// sprawdzanie który biblioteka jest aktywny
		if ($biblioteka_reserch[0] == "ON") {
			$bm_name = cut($bm_name , 40);
			
echo<<<END
	
	<section class="col-4 tsr-recors-miniaturs tsr-p-5px" height: 265px;>
		<section class="fs-70 tsr-records id-records-$id_biblioteka background-dark-gray" data-usun="1" data-id-post="$bm_name">
			<a href="#theme_$id_biblioteka" rel="modal:open" class="img-efect-normalize2">
				<img src="$bm_logo_library" title="$bm_name" class="img tsr-miniaturka tsr-vertical-align-middle" style="width: 100%;height: 200px;object-fit: fill;">
				<section class="img-efect-normalize-subtitle2">
					Zobacz
				</section>
			</a>
			<section class="fs-90 tsr-cut-string background-dark-red tsr-p-10px tsr-pt-5px tsr-pb-5px">
				<section class="tsr-button tsr-normal">
					Aktywny
				</section>
				$bm_name
			</section>
		</section>
	</section>
								
			<div id="theme_$id_biblioteka" class="tsr modal modal-auto">
				<section class="tsr">
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Pełny Tytuł Skryptu:
						</section>
						<section class="col-inp-75">
							$bm_name
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Autor Skryptu:
						</section>
						<section class="col-inp-75">
							$bm_autor
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Opis Skryptu:
						</section>
						<section class="col-inp-75">
							$bm_description
						</section>
					</section>					
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Data Stworzenia Skryptu:
						</section>
						<section class="col-inp-75">
							$bm_date_create
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Strona Skryptu Black Min:
						</section>
						<section class="col-inp-75">
							<a href="$bm_url_library_bm">
								$bm_url_library_bm
							</a>
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Klucz id Skryptu:
						</section>
						<section class="col-inp-75">
							$bm_amup_bm
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Wersja Skryptu:
						</section>
						<section class="col-inp-75">
							$bm_versions
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Strona Autora Skryptu:
						</section>
						<section class="col-inp-75">
							<a href="$bm_autor_website">
								$bm_autor_website
							</a>	
						</section>
					</section>
					<!--<section class="tsr fs-70">
						<section class="col-inp-25">
							Ścieżka Pliku:
						</section>
						<section class="tsr-inp-75">
							<a href="$bm_logo_library">
								$bm_logo_library
							</a>	
						</section>
					</section>-->
					<img src="$bm_logo_library" title="$bm_name" class="img tsr-mt-20" style="min-width: 25%;">
					<section class="tsr r-0 fs-100 tsr-visable-hover">
						<!--<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
							<a href="">
								Edytuj Bibliotekę
							</a>	
						</section>-->
						<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
							<a href="#zobacz_Skrypt_$id_biblioteka" rel="modal:open">
								Zobacz Bibliotekę
							</a>	
						</section>
						<!--<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
							<a href="#post_zobacz_min_$id_biblioteka" rel="modal:open">
								Zobacz Bibliotekę Na Żywo
							</a>	
						</section>-->
						<section class="tsr-fr tsr-button tsr-error tsr-visable-hover-element edit-post ">
							<a href="#aktywuj_biblioteke_$id_biblioteka" rel="modal:open">
								Dezaktywuj Bibliotekę
							</a>	
						</section>						
					</section>
				</section>
				<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
			</div>
			<script type="text/javascript">
				$('#ptw_activate_Skrypt_$id_biblioteka').click('submit', function(evt1){
				
				var aktywuj_biblioteke = "$bm_name";
				var date_biblioteka = "$biblioteka_reserch[1]";
				var aktywna_biblioteka = "true";
				
				$.ajax({
					type:"POST",
					url:"insert/biblioteka-aktywuj.php",
					data:{
						aktywuj_biblioteke:aktywuj_biblioteke,
						date_biblioteka:date_biblioteka,
						aktywna_biblioteka:aktywna_biblioteka,
					}
				})
				.done(function(info){
					$('.id-records-$id_biblioteka').text("");
					$('.id-records-$id_biblioteka').append(info);
				})
				.fail(function(){
					alert("Wystąpił błąd. Spróbuj ponownie później");
					});
				});	
			</script>			
			<div id="aktywuj_biblioteke_$id_biblioteka" class="tsr modal modal-auto" style="max-width: 500px;">
				<section class="tsr">
					<section class="col-2 fs-70 tsr-p-5px tsr-button">
						<a href="#usun_post_min_$id_biblioteka" id="ptw_activate_Skrypt_$id_biblioteka" class="cursor-pointer" rel="modal:close">
							Tak, Dezaktywuj Bibliotekę
						</a>
					</section>
					<section class="col-2 tsr-button tsr-error">
						<a href="#" rel="modal:close">
							Anuluj!
						</a>
					</section>
					<section class="tsr">
					</section>
				</section>
				<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
			</div>			
			<div id="zobacz_Skrypt_$id_biblioteka" class="tsr modal modal-auto">
				<section class="tsr">
					<img src="$bm_logo_library" title="$bm_name" class="img tsr-mt-10" style="width: 100%;">
				</section>
				<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
			</div>	
		</section>
	
	
END;
			
		}else{
			
echo<<<END
	
	<section class="col-4 tsr-recors-miniaturs tsr-p-5px" style="height: 265px;">
		<section class="fs-70 tsr-records id-records-$id_biblioteka background-gray" data-usun="1" data-id-post="$bm_name">
			<a href="#theme_$id_biblioteka" rel="modal:open" class="img-efect-normalize2">
				<img src="$bm_logo_library" title="$bm_name" class="img tsr-miniaturka tsr-vertical-align-middle" style="width: 100%;height: 200px;object-fit: fill;">
				<section class="img-efect-normalize-subtitle2">
					Zobacz
				</section>
			</a>
			<section class="tsr-p-10px fs-90 tsr-cut-string background-orange">
				$bm_name
			</section>
		</section>
	</section>
	
	

			<div id="delete_Skrypt_$id_biblioteka" class="tsr modal modal-auto" style="max-width: 500px;">
				<section class="tsr">
					<section class="col-2 fs-70 tsr-p-5px tsr-button">
						<a href="#usun_post_min_$id_biblioteka" id="ptw_delte_post_$id_biblioteka" class="cursor-pointer" rel="modal:close">
							Tak, usuń Bibliotekę
						</a>
					</section>
					<section class="col-2 tsr-button tsr-error">
						<a href="#" rel="modal:close">
							Anuluj!
						</a>
					</section>
					<section class="tsr">
					</section>
				</section>
				<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
			</div>
				<script type="text/javascript">
				$('#ptw_delte_post_$id_biblioteka').click('submit', function(evt1){
					
				var usun_biblioteke = "$bm_name2";
				
				$.ajax({
					type:"POST",
					url:"insert/biblioteke-usun.php",
					data:{
						usun_biblioteke:usun_biblioteke,
					}
				})
				.done(function(info){
					$('.id-records-$id_biblioteka').text("");
					$('.id-records-$id_biblioteka').append(info);
				})
				.fail(function(){
					alert("Wystąpił błąd. Spróbuj ponownie później");
					});
				});	
			</script>

			<div id="aktywuj_biblioteke_$id_biblioteka" class="tsr modal modal-auto" style="max-width: 500px;">
				<section class="tsr">
					<section class="col-2 fs-70 tsr-p-5px tsr-button">
						<a href="#usun_post_min_$id_biblioteka" id="ptw_activate_Skrypt_$id_biblioteka" class="cursor-pointer" rel="modal:close">
							Tak, Aktywuj Bibliotekę
						</a>
					</section>
					<section class="col-2 tsr-button tsr-error">
						<a href="#" rel="modal:close">
							Anuluj!
						</a>
					</section>
					<section class="tsr">
					</section>
				</section>
				<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
			</div>
				<script type="text/javascript">
				$('#ptw_activate_Skrypt_$id_biblioteka').click('submit', function(evt1){
				
				var aktywuj_biblioteke = "$bm_name";
				var date_biblioteka = "$biblioteka_reserch[1]";
				var aktywna_biblioteka = false;
				
				$.ajax({
					type:"POST",
					url:"insert/biblioteka-aktywuj.php",
					data:{
						aktywuj_biblioteke:aktywuj_biblioteke,
						date_biblioteka:date_biblioteka,
						aktywna_biblioteka:aktywna_biblioteka,
					}
				})
				.done(function(info){
					$('.id-records-$id_biblioteka').text("");
					$('.id-records-$id_biblioteka').append(info);
				})
				.fail(function(){
					alert("Wystąpił błąd. Spróbuj ponownie później");
					});
				});	
			</script>
			
			<div id="theme_$id_biblioteka" class="tsr modal modal-auto">
				<section class="tsr">
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Pełny Tytuł Skryptu:
						</section>
						<section class="col-inp-75">
							$bm_name
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Autor Skryptu:
						</section>
						<section class="col-inp-75">
							$bm_autor
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Opis Skryptu:
						</section>
						<section class="col-inp-75">
							$bm_description
						</section>
					</section>					
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Data Stworzenia Skryptu:
						</section>
						<section class="col-inp-75">
							$bm_date_create
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Strona Skryptu Black Min:
						</section>
						<section class="col-inp-75">
							<a href="$bm_url_library_bm">
								$bm_url_library_bm
							</a>
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Klucz id Skryptu:
						</section>
						<section class="col-inp-75">
							$bm_amup_bm
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Wersja Skryptu:
						</section>
						<section class="col-inp-75">
							$bm_versions
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Strona Autora Skryptu:
						</section>
						<section class="col-inp-75">
							<a href="$bm_autor_website">
								$bm_autor_website
							</a>	
						</section>
					</section>
					<!--<section class="tsr fs-70">
						<section class="col-inp-25">
							Ścieżka Pliku:
						</section>
						<section class="tsr-inp-75">
							<a href="$bm_logo_library">
								$bm_logo_library
							</a>	
						</section>
					</section>-->
					<img src="$bm_logo_library" title="$bm_name" class="img tsr-mt-20" style="min-width: 25%;">
					<section class="tsr r-0 fs-100 tsr-visable-hover">
						<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
							<a href="#delete_Skrypt_$id_biblioteka" rel="modal:open">
								Usuń Bibliotekę
							</a>											
						</section>
						<!--<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
							<a href="">
								Edytuj Bibliotekę
							</a>	
						</section>-->
						<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
							<a href="#zobacz_Skrypt_$id_biblioteka" rel="modal:open">
								Zobacz Bibliotekę
							</a>	
						</section>
						<!--<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
							<a href="#post_zobacz_min_$id_biblioteka" rel="modal:open">
								Zobacz Bibliotekę Na Zywo
							</a>	
						</section>-->
						<section class="tsr-fr tsr-button tsr-normal tsr-visable-hover-element edit-post ">
							<a href="#aktywuj_biblioteke_$id_biblioteka" rel="modal:open">
								Aktywuj Bibliotekę
							</a>	
						</section>
					</section>
				</section>
				<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
			</div>	
			<div id="zobacz_Skrypt_$id_biblioteka" class="tsr modal modal-auto">
				<section class="tsr">
					<img src="$bm_logo_library" title="$bm_name" class="img tsr-mt-10" style="width: 100%;">
				</section>
				<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
			</div>	
		</section>
	
	
END;
			
		}
	
}

?>