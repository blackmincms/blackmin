<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyciągania z bazy wszystkich postów które admin będzie poczebował
	
	#Zawannsowane szukanie
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "../black-min.php";

	// Tworzenie struktury logiczenej do zawansowanego wszyszukiwania w bazie danych

	$kategoria_aktywny = false;
	$szukaj_aktywny = false;
	$folder_aktywny = false;
	
	// odnieranie od skryptu metodą post informacji na temat poszukiwanych rekordów w bacie danych
	
	if (isset ($_POST['roszerzenie'])){
		$kategoria = $_POST['roszerzenie'];
	}else{
		$kategoria = "all";
	}
	
	if (isset ($_POST['ile_load'])){
		$ile_load = $_POST['ile_load'];
	}else {
		$ile_load = "25";
	}
	
	if (isset ($_POST['szukaj'])){
		$szukaj = $_POST['szukaj'];
	}else{
		$szukaj = "";
	}
	
	if (isset ($_POST['folder'])){
		$folder_szukaj = $_POST['folder'];
	}else{
		$folder_szukaj = "";
	}
	
	// stosowanie filtrowania danych przychodzących z posta (choć jest to nie poczebne)
	
	$kategoria = htmlentities($kategoria, ENT_QUOTES, "UTF-8");
	$szukaj = htmlentities($szukaj, ENT_QUOTES, "UTF-8");	
	$folder_szukaj = htmlentities($folder_szukaj, ENT_QUOTES, "UTF-8");			

	// sprawdzanie który element posta został przesłany i na tej podstawie można zrobić wyszukiwanie selektywne

	if ($kategoria != "all") {
		$kategoria_aktywny = true;
		
		// zmienianie odpowiedniego typu pliku
		if ($kategoria == "img") {
			$kategoria = "image";
		}
		
		if ($kategoria == "film") {
			$kategoria = "video";
		}
		
		if ($kategoria == "audio") {
			$kategoria = "audio";
		}
		
		if ($kategoria == "txt") {
			$kategoria = "text";
		}
		
		if ($kategoria == "rar") {
			$kategoria = "application/octet-stream";
		}
	}
		
	if ($szukaj != "") {
		$szukaj_aktywny = true;
	}
	
	if ($folder_szukaj != "") {
		$folder_aktywny = true;
	}
	
	// wybieranie odpowiedniego wyszukiwania podanego przez osobę szukającą
		
	if ($kategoria != "all") {
		$kategoria = "`bm_typ_pliku` LIKE '%". $kategoria ."%'";
	}else {
		$kategoria = "";
	}
		
	if ($szukaj != "") {
		if (($kategoria_aktywny == false) AND ($szukaj_aktywny == true)) {
			$szukaj = "`bm_nazwa` LIKE '%". $szukaj ."%'";
		}else{
			$szukaj = "AND `bm_nazwa` LIKE '%". $szukaj ."%'";
		}
	 }else {
		 $szukaj = "";
	 }
	 
	 if ($folder_szukaj != "") {
		if (($kategoria_aktywny == false) AND ($szukaj_aktywny == false) AND ($folder_aktywny == true)) {
			$folder_szukaj = "`bm_folder` LIKE '%". $folder_szukaj ."%'";
		}else{
			$folder_szukaj = "AND `bm_folder` LIKE '%". $folder_szukaj ."%'";
		}
	 }else {
		 $folder_szukaj = "";
	 }
	
	if (($kategoria_aktywny == true) OR ($szukaj_aktywny == true) OR ($folder_aktywny == true)) {
		 $where = "WHERE";
	 }else {
		 $where = "";
	}
	
	// otwieranie połączenie z bazą danych i stosowanie określonego zapytania
	// renderowanie odpowiedniego wyniku szukanychh informacji przez użytkownika

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

				$rezultat = "SELECT * FROM `".$prefix_table."bm_filemeta` $where $kategoria $szukaj $folder_szukaj ORDER BY `bm_datetime_wgrania` DESC LIMIT $ile_load";
				$wynik = $polaczenie->query($rezultat);
					
					$ile = mysqli_num_rows($wynik);
					
					$ile2 = $ile-1;
			
					$one = 1;	
					
					// tworzenie tablicy do przechowywanie każdego wyrenderowanego wyniku (id) 
					
					$all_id = ""; 
					
echo<<<END

						
						<section class="tsr-p-5px tsr-fl tsr fs-70 tsr-border-solid-bottom tsr-records-title col-st">
							<section class="col-st5">
							<input type="checkbox" name="zaznacz-blok" class="input tsr-mini tsr-vertical-align-top checked-all checked-all-delete " id="checked-all"/>
							</section>
							<section class="col-st25 tsr-algin-left tsr-algin-center-4">
								Pełna Nazwa/Pełna Orginalna Nazwa
							</section>
							<section class="col-st10 tsr-algin-center">
								autor
							</section>
							<section class="col-st25 tsr-algin-center">
								Opis
							</section>
							<section class="col-st10 tsr-algin-center">
								Folder
							</section>
							<section class="col-st10 tsr-algin-center">
								Rozszerzenie
							</section>
							<section class="col-st15 tsr-algin-right tsr-algin-center-4">
								Data Dodania
							</section>
						</section>

						<script type="text/javascript">
									
							var akcja_records = [];
											
						</script>

END;
					
					for ($i = 1; $i <= $ile; $i++) 
					{
						
						
						$row = mysqli_fetch_assoc($wynik);
						$id = $row['id'];
						$autor_id = $row['bm_autor'];
						$nazwa = $row['bm_nazwa'];
						$nazwa_zmiany = $row['bm_nazwa_zmiany'];
						$datetime_wgrania = $row['bm_datetime_wgrania'];
						$datetime_zmiany = $row['bm_datetime_zmiany'];
						$opis = $row['bm_opis'];
						$typ_pliku = $row['bm_typ_pliku'];
						$bm_miniaturka = $row['bm_miniaturka'];
						$folder = $row['bm_folder'];
						$sciezka = $row['bm_sciezka'];
						
						// dodawanie śćieżki do miniaturki
						
						$data_post = date('d-m-Y',strtotime($datetime_zmiany));
						$godzina_post = date('H:i',strtotime($datetime_zmiany));
						$data_zmiany_post = date('d-m-Y',strtotime($datetime_zmiany));
						$godzina_zmiany_post = date('H:i',strtotime($datetime_zmiany));
						
						$all_id .= '"'.$id.'",';
						
						if ($opis === "") {
							$opis = "Brak opisu";
						}
						
						//rozbjianie na czyniki pierwsze rozszerzenia pobranego z tablicy dysku
						$reserch_type = explode("/", $typ_pliku);

						// sprawdzenie poprawnośći rozszerzenia
						// zamiana grafiki jeżeli rozpoznano poprawnie rozszerzenie
						if ($reserch_type[0] == "image") {
							$sciezka2 = $sciezka;
						};
						
						if ($reserch_type[0] == "application") {
							$sciezka2 = $bm_miniaturka;
							
							if ($reserch_type[1] == "rar") {
								$sciezka2 = $bm_miniaturka;
							}
						};
						
						if ($reserch_type[0] == "text") {
							$sciezka2 = $bm_miniaturka;
						};
						
						if ($reserch_type[0] == "audio") {
							$sciezka2 = $bm_miniaturka;
						};
						
						if ($reserch_type[0] == "video") {
							$sciezka2 = $bm_miniaturka;
						};	

						if($bm_miniaturka == "null"){
							$bm_miniaturka = BM_SETTINGS["url_server"]."pliki/banner/placeholder.jpg";
							$sciezka2 = BM_SETTINGS["url_server"]."pliki/banner/placeholder.jpg";
						}
						
						if ($datetime_wgrania === $datetime_zmiany) {
							$data_all = '<section class="tsr fs-100">Opublikowano: </section>'. $datetime_wgrania;
						}else{
							$data_all = '<section class="tsr fs-100">Edytowano Plik Dnia: </section>'. $datetime_zmiany;
						}
						
						$rezultat2 = "SELECT * FROM `".$prefix_table."bm_uzytkownicy` WHERE `id` = '$autor_id'";
						$wynik2 = $polaczenie->query($rezultat2);
						
						$row2 = mysqli_fetch_assoc($wynik2);
						$autor = $row2['nick'];
						$url_serwera_bm = BM_SETTINGS["url_server"];

				 if ( $i % 2 == 0 )
				{
	
echo<<<END

						<section class="tsr-recors-table">
							<section class="tsr-p-5px tsr-fl tsr fs-70 record-autner records-autner tsr-records id-records-$id col-st" ata-id-post="$id">
								<section class="col-st5">
									<input type="checkbox" name="check_usun[]" class="input checkbox tsr-mini tsr-vertical-align-top check_usun" value="$id" id="check_usun" data-id-post="$id" />
								</section>
								<section class="col-st25 fs-90 tsr-overflow-wrap-break-word tsr-algin-center-4">
									<img src="$sciezka2" title="$nazwa" class="img tsr-miniaturka tsr-vertical-align-middle" style="max-width: 74px;">
									$nazwa
									
									<section class="tsr fs-80 tsr-mt-20">$nazwa_zmiany</section>
									
									<section class="tsr r-0 fs-100 tsr-visable-hover">
										<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
											<a href="#post_delete_$id" rel="modal:open">
												Usuń plik
											</a>											
										</section>
										<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
											<a href="admin-edit-dane-pliku.php?edit=$id">
												Edytuj dane
											</a>	
										</section>
										<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
											<a href="#post_zobacz_$id" rel="modal:open">
												Zobacz plik
											</a>	
										</section>
									</section>
								</section>
								<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
									$autor
								</section>
								<section class="col-st25 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
									$opis
								</section>
								<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
									$folder
								</section>
								<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
									$typ_pliku
								</section>
								<section class="col-st15 fs-90 tsr-overflow-wrap-break-word tsr-algin-right tsr-algin-center-4">
									$data_all
								</section>
							</section>

							<div id="post_delete_$id" class="tsr modal modal-auto" style="max-width: 500px;">
								<section class="tsr">
									<section class="col-2 fs-70 tsr-p-5px tsr-button">
										<a href="#usun_post_$id" id="ptw_delte_post_$id" class="cursor-pointer" rel="modal:close">
											Tak, usuń plik
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
								$('#ptw_delte_post_$id').click('submit', function(evt1){
								evt1.preventDefault();
								
								akcja_records.push("$id");

								var d_usun = 1;
								
								$.ajax({
									type:"POST",
									url:"insert/plik-usun-red.php",
									data:{
										usun_plik:akcja_records,
										d_usun:d_usun,
									}
								})
								.done(function(info){
									$('.id-records-$id').text("");
									$('.id-records-$id').append(info);
								})
								.fail(function(){
									alert("Wystąpił błąd. Spróbuj ponownie później");
								});
								});	
							</script>								

							<div id="post_zobacz_$id" class="tsr modal modal-auto">
								<section class="tsr">
									<img src="$sciezka2" title="$nazwa" class="img">
								</section>
								<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
							</div>		
						</section>	
						
					<section class="tsr-recors-miniaturs tsr-display-none">
					
						<section class="">
							<section class="record-autner tsr-records id-records-$id" data-usun="1" data-id-post="$id">
								<a href="#post_previev_min_$id" rel="modal:open">
									<img src="$sciezka2" title="$nazwa" class="img tsr-miniaturka2 tsr-vertical-align-middle" >
								</a>	
							</section>
						</section>

							<div id="post_delete_min_$id" class="tsr modal modal-auto" style="max-width: 500px;">
								<section class="tsr">
									<section class="col-2 fs-70 tsr-p-5px tsr-button">
										<a href="#usun_post_min_$id" id="ptw_delte_post_min_$id" class="cursor-pointer" rel="modal:close">
											Tak, usuń plik
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
								$('#ptw_delte_post_min_$id').click('submit', function(evt1){
								evt1.preventDefault();
							
								akcja_records.push("$id");
								
								var d_usun = 1;
								
								$.ajax({
									type:"POST",
									url:"insert/plik-usun-red.php",
									data:{
										usun_plik:akcja_records,
										d_usun:d_usun,
									}
								})
								.done(function(info){
									$('.id-records-$id').text("");
									$('.id-records-$id').append(info);
								})
								.fail(function(){
									alert("Wystąpił błąd. Spróbuj ponownie później");
									});
								});	
							</script>							
							<div id="post_previev_min_$id" class="tsr modal modal-auto">
								<section class="tsr">
									<section class="tsr fs-70">
										<section class="col-inp-25">
											Pełny Tytuł:
										</section>
										<section class="col-inp-75">
											$nazwa
										</section>
									</section>
									<section class="tsr fs-70">
										<section class="col-inp-25">
											Autor Pliku:
										</section>
										<section class="col-inp-75">
											$autor
										</section>
									</section>
									<section class="tsr fs-70">
										<section class="col-inp-25">
											Opis Pliku:
										</section>
										<section class="col-inp-75">
											$opis
										</section>
									</section>					
									<section class="tsr fs-70">
										<section class="col-inp-25">
											Data Wgrania:
										</section>
										<section class="col-inp-75">
											$data_all
										</section>
									</section>
									<section class="tsr fs-70">
										<section class="col-inp-25">
											Rozszerzenie Pliku:
										</section>
										<section class="col-inp-75">
											$typ_pliku
										</section>
									</section>
									<section class="tsr fs-70">
										<section class="col-inp-25">
											Ścieżka Pliku:
										</section>
										<section class="tsr-inp-75">
											<a href="$sciezka">
												$sciezka
											</a>	
										</section>
									</section>
									<img src="$sciezka2" title="$nazwa" class="img tsr-mt-10">
									<section class="tsr r-0 fs-100 tsr-visable-hover">
										<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
											<a href="#post_delete_min_$id" rel="modal:open">
												Usuń plik
											</a>											
										</section>
										<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
											<a href="admin-edit-dane-pliku.php?edit=$id">
												Edytuj dane
											</a>	
										</section>
										<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
											<a href="#post_zobacz_min_$id" rel="modal:open">
												Zobacz plik
											</a>	
										</section>
									</section>
								</section>
								<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
							</div>	

							<div id="post_zobacz_min_$id" class="tsr modal modal-auto">
								<section class="tsr">
									<img src="$sciezka2" title="$nazwa" class="img tsr-mt-10">
								</section>
								<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
							</div>	
						</section>
					
					</section>						
			
END;
	
  }
  else
  {

echo<<<END

						<section class="tsr-recors-table">
							<section class="tsr-p-5px tsr-fl tsr fs-70 record-autner tsr-records id-records-$id col-st" data-id-post="$id">
								<section class="col-st5">
									<input type="checkbox" name="check_usun[]" class="input checkbox tsr-mini tsr-vertical-align-top check_usun" value="$id" id="check_usun" data-id-post="$id" />
								</section>
								<section class="col-st25 fs-90 tsr-overflow-wrap-break-word tsr-algin-center-4">
									<img src="$sciezka2" title="$nazwa" class="img tsr-miniaturka tsr-vertical-align-middle" style="max-width: 75px;">
									$nazwa
									
									<section class="tsr fs-80 tsr-mt-20">$nazwa_zmiany</section>
									
									<section class="tsr r-0 fs-100 tsr-visable-hover">
										<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
											<a href="#post_delete_$id" rel="modal:open">
												Usuń plik
											</a>											
										</section>
										<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
											<a href="admin-edit-dane-pliku.php?edit=$id">
												Edytuj dane
											</a>	
										</section>
										<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
											<a href="#post_zobacz_$id" rel="modal:open">
												Zobacz plik
											</a>	
										</section>
									</section>
								</section>
								<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
									$autor
								</section>
								<section class="col-st25 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
									$opis
								</section>
								<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
									$folder
								</section>
								<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
									$typ_pliku
								</section>
								<section class="col-st15 fs-90 tsr-overflow-wrap-break-word tsr-algin-right tsr-algin-center-4">
									$data_all
								</section>
							</section>

							<div id="post_delete_$id" class="tsr modal modal-auto" style="max-width: 500px;">
								<section class="tsr">
									<section class="col-2 fs-70 tsr-p-5px tsr-button">
										<a href="#usun_post_$id" id="ptw_delte_post_$id" class="cursor-pointer" rel="modal:close">
											Tak, usuń plik
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
								$('#ptw_delte_post_$id').click('submit', function(evt1){
								evt1.preventDefault();
								
								akcja_records.push("$id");
								//console.log(delete_post);
								
								//var akcja_records = akcja_records;
								var d_usun = 1;
								
								$.ajax({
									type:"POST",
									url:"insert/plik-usun-red.php",
									data:{
										usun_plik:akcja_records,
										d_usun:d_usun,
									}
								})
								.done(function(info){
									$('.id-records-$id').text("");
									$('.id-records-$id').append(info);
								})
								.fail(function(){
									alert("Wystąpił błąd. Spróbuj ponownie później");
								});
								});	
							</script>							

							<div id="post_zobacz_$id" class="tsr modal modal-auto">
								<section class="tsr">
									<img src="$sciezka2" title="$nazwa" class="img">
								</section>
								<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
							</div>	
						</section>	

						<section class="tsr-recors-miniaturs tsr-display-none">
						
							<section class="">
								<section class="record-autner tsr-records id-records-$id" data-usun="1" data-id-post="$id">
									<a href="#post_previev_min_$id" rel="modal:open">
										<img src="$sciezka2" title="$nazwa" class="img tsr-miniaturka2 tsr-vertical-align-middle" >
									</a>	
								</section>
							</section>

								<div id="post_delete_min_$id" class="tsr modal modal-auto" style="max-width: 500px;">
									<section class="tsr">
										<section class="col-2 fs-70 tsr-p-5px tsr-button">
											<a href="#usun_post_min_$id" id="ptw_delte_post_min_$id" class="cursor-pointer" rel="modal:close">
												Tak, usuń plik
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
									$('#ptw_delte_post_min_$id').click('submit', function(evt1){
									evt1.preventDefault();
								
									akcja_records.push("$id");
									
									var d_usun = 1;
									
									$.ajax({
										type:"POST",
										url:"insert/plik-usun-red.php",
										data:{
											usun_plik:akcja_records,
											d_usun:d_usun,
										}
									})
									.done(function(info){
										$('.id-records-$id').text("");
										$('.id-records-$id').append(info);
									})
									.fail(function(){
										alert("Wystąpił błąd. Spróbuj ponownie później");
										});
									});	
								</script>							
								<div id="post_previev_min_$id" class="tsr modal modal-auto">
									<section class="tsr">
										<section class="tsr fs-70">
											<section class="col-inp-25">
												Pełny Tytuł:
											</section>
											<section class="col-inp-75">
												$nazwa
											</section>
										</section>
										<section class="tsr fs-70">
											<section class="col-inp-25">
												Autor Pliku:
											</section>
											<section class="col-inp-75">
												$autor
											</section>
										</section>
										<section class="tsr fs-70">
											<section class="col-inp-25">
												Opis Pliku:
											</section>
											<section class="col-inp-75">
												$opis
											</section>
										</section>					
										<section class="tsr fs-70">
											<section class="col-inp-25">
												Data Wgrania:
											</section>
											<section class="col-inp-75">
												$data_all
											</section>
										</section>
										<section class="tsr fs-70">
											<section class="col-inp-25">
												Rozszerzenie Pliku:
											</section>
											<section class="col-inp-75">
												$typ_pliku
											</section>
										</section>
										<section class="tsr fs-70">
											<section class="col-inp-25">
												Ścieżka Pliku:
											</section>
											<section class="tsr-inp-75">
												<a href="$sciezka">
													$sciezka
												</a>	
											</section>
										</section>
										<img src="$sciezka2" title="$nazwa" class="img tsr-mt-10">
										<section class="tsr r-0 fs-100 tsr-visable-hover">
											<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
												<a href="#post_delete_min_$id" rel="modal:open">
													Usuń plik
												</a>											
											</section>
											<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
												<a href="admin-edit-dane-pliku.php?edit=$id">
													Edytuj dane
												</a>	
											</section>
											<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
												<a href="#post_zobacz_min_$id" rel="modal:open">
													Zobacz plik
												</a>	
											</section>
										</section>
									</section>
									<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
								</div>	

								<div id="post_zobacz_min_$id" class="tsr modal modal-auto">
									<section class="tsr">
										<img src="$sciezka" title="$nazwa" class="img tsr-mt-10">
									</section>
									<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
								</div>	
							</section>
						
						</section>						
			
END;

  }
					
					}	

echo<<<END

						<section class="tsr-p-5px tsr-fl tsr fs-70 tsr-border-solid-bottom tsr-records-title col-st">
							<section class="col-st5">
							<input type="checkbox" name="zaznacz-blok" class="input tsr-mini tsr-vertical-align-top checked-all checked-all-delete " id="checked-all"/>
							</section>
							<section class="col-st25 tsr-algin-left tsr-algin-center-4">
								Pełna Nazwa/Pełna Orginalna Nazwa
							</section>
							<section class="col-st10 tsr-algin-center">
								autor
							</section>
							<section class="col-st25 tsr-algin-center">
								Opis
							</section>
							<section class="col-st10 tsr-algin-center">
								Folder
							</section>
							<section class="col-st10 tsr-algin-center">
								Rozszerzenie
							</section>
							<section class="col-st15 tsr-algin-right tsr-algin-center-4">
								Data Dodania
							</section>
						</section>
					<form accept-charset="UTF-8"  action="" method="post" id="data-add-post" class="checkall">		
						<section class="tsr-fl tsr tsr-mt-20 tsr-records-submit">
							<input type="button" value="Wykonaj akcje" class="input buttom" id="usun_post_submit"/>
						</section>
					</form>

					<script type="text/javascript">
						$(function() {
							// tworzenie skryptu który wszystko zaznacza
							$(".checkall").checkall({
								all:  ".checked-all",
								item: ".check_usun"
							});
						});

					Array.prototype.remove=function(s){
                        for(i=0;i<s.length;i++){
                        if(s==this[i]) this.splice(i, 1);
                        }
					}



						// tworzenie tablicy i przechowywanie id do usunięcia
						var delete_post_all = [$all_id];

						// po kliknięci funkcjia zaznacza wszystkie wyrenderowane rekordy i podświetla je od usunięcia
						
						$('.checked-all').on("click", function() {
							
							// sprawdzanie czy został zaznaczony checkbox all
							var this_check_all = $(this).closest('.checked-all:checked').length;
							var _this_check_all_ = $(this).closest('.checked-all:checked');
							
							// jeżeli checbox all został zaznaczony to dodajemy zaznaczenie i dodajemy wszystkie rekordy to tablicy
							// w przeciwnym wypadku odznaczamy rekord i usuwamy wszystkie rekordy z tablicy
							if (this_check_all == 1) {
								$(".tsr-records").css("color", "rgb(255, 255, 255)").css("box-shadow", "inset black 0px 0px 5px").css("background-color", "rgb(210, 73, 73)");
								$(".check_usun").attr("checked","");
								$(".check_usun").checked = true;
								akcja_records = delete_post_all;
							}else{
								$(".tsr-records").removeAttr("style");
								$(".check_usun").removeAttr("checked","");
								$(".check_usun").checked = false;
								akcja_records = [];
							}
							
						});
						
						// po kliknięci funkcjia zaznacza ten wyrenderowany rekord i podświetla go go usunięcia
												
						$( ".check_usun" ).on( "click", function(oEvent) {	
							
							// sprawdzanie czy został zaznaczony checkbox all
							var this_check = $(this).closest('.check_usun:checked').length;
							var this_records_id = $(this).closest('.check_usun').attr("data-id-post");
							
							// jeżeli checbox został zaznaczony to dodajemy zaznaczenie i dodajemy ten rekord to tablicy
							// w przeciwnym wypadku odznaczamy rekord i usuwamy ten rekord z tablicy
							if (this_check == 1) {
								$(this).closest(".tsr-records").css("color", "rgb(255, 255, 255)").css("box-shadow", "inset black 0px 0px 5px").css("background-color", "rgb(210, 73, 73)");
								akcja_records.push(this_records_id);
							}else{
								$(this).closest(".tsr-records").removeAttr("style");
					
								if (~akcja_records.indexOf(this_records_id)) {
									
									// pobieranie id indexu rekurdu w tablicy
									var this_arroy_index = akcja_records.indexOf(this_records_id);
									
									delete akcja_records[this_arroy_index];
									
								}
								
							}
								
						});
						
						
						// metoda ajax wysyła id do usunięcia
						
						$('#usun_post_submit').click('submit', function(){
						
						var d_usun = 0;
						var akcja_post_submit = $('select[name="akcja"]').val();
						
						// sprawdzanie czy użytkownik wybrał akcjie usuń rekordy
						if (akcja_post_submit == "usun"){
							if(akcja_records != ""){
						
								$.ajax({
									type:"POST",
									url:"insert/plik-usun-red.php",
									data:{
										usun_plik:akcja_records,
										d_usun:d_usun,
									}
								})
								.done(function(info){
									$('.tsr-records-submit').append(info);
									$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
								})
								.fail(function(){
									alert("Wystąpił błąd. Spróbuj ponownie później");
								});
							}
						}
						
						// sprawdzanie czy użytkownik wybrał akcjie zmień nazwę folderu
						if (akcja_post_submit == "rename_folder"){
							if(akcja_records != ""){
						
								// pobieranie nazwy nowego folderu
								var nowa_nazwa_folderu = $('input[name="folder_zmien"]').val();
						
								$.ajax({
									type:"POST",
									url:"insert/plik-zmien-folder.php",
									data:{
										pliki:akcja_records,
										nazwa_folderu:nowa_nazwa_folderu
									}
								})
								.done(function(info){
									$('.tsr-records-submit').append(info);
									$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
								})
								.fail(function(){
									alert("Wystąpił błąd. Spróbuj ponownie później");
								});
							}
						}
						
						});

					</script>

END;
					
					
					
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań póżniej!</span>';
		}	

?>