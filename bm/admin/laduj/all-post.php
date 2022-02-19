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
	$status_aktywny = false;
	$szukaj_aktywny = false;
	
	// odnieranie od skryptu metodą post informacji na temat poszukiwanych rekordów w bacie danych
	
	if (isset ($_POST['kategoria'])){
		$kategoria = $_POST['kategoria'];
	}else{
		$kategoria = "all";
	}
	
	if (isset ($_POST['status'])){
		$status = $_POST['status'];
	}else{
		$status = "all";
	}
	
	if (isset ($_POST['ile_load'])){
		$ile_load = $_POST['ile_load'];
		if ($ile_load < 0) {
			$ile_load = 0;
		}
	}else {
		$ile_load = "25";
	}
	
	if (isset ($_POST['szukaj'])){
		$szukaj = $_POST['szukaj'];
	}else{
		$szukaj = "";
	}
	
	// stosowanie filtrowania danych przychodzących z posta (choć jest to nie poczebne)
	
	$kategoria = htmlentities($kategoria, ENT_QUOTES, "UTF-8");
	$status = htmlentities($status, ENT_QUOTES, "UTF-8");
	//$ile_load = htmlentities($ile_load, ENT_QUOTES, "UTF-8");
	//$ile_load = $ile_load;
	$szukaj = htmlentities($szukaj, ENT_QUOTES, "UTF-8");			

	// sprawdzanie który element posta został przesłany i na tej podstawie można zrobić wyszukiwanie selektywne

	if ($kategoria != "all") {
		$kategoria_aktywny = true;
	}
		
	if ($status != "all") {
		$status_aktywny = true;
	}
		
	if ($szukaj != "") {
		$szukaj_aktywny = true;
	}
	
	// wybieranie odpowiedniego wyszukiwania podanego przez osobę szukającą
		
	if ($kategoria != "all") {
		$kategoria = "`kategoria` LIKE '". $kategoria ."'";
	}else {
		$kategoria = "";
	}
		
	if ($status != "all") {
		if (($kategoria_aktywny == false) AND ($status_aktywny == true)) {
			$status = "`status` LIKE '". $status ."'";
		}else{
			$status = "AND `status` LIKE '". $status ."'";
		}
	}else {
		$status ="";
	}
		
	if ($szukaj != "") {
		if (($kategoria_aktywny == false) AND ($status_aktywny == false) AND ($szukaj_aktywny == true)) {
			$szukaj = "`tytul` LIKE '%". $szukaj ."%'";
		}else{
			$szukaj = "AND `tytul` LIKE '%". $szukaj ."%'";
		}
	 }else {
		 $szukaj = "";
	 }
	
	if (($kategoria_aktywny == true) OR ($status_aktywny == true) OR ($szukaj_aktywny == true)) {
		 $where = "WHERE";
	 }else {
		 $where = "";
	}
	
	// otwieranie połączenie z bazą danych i stosowanie określonego zapytania
	// renderowanie odpowiedniego wyniku szukanychh informacji przez użytkownika

		mysqli_report(MYSQLI_REPORT_STRICT);
			
		try 
		{
			global $host, $db_user, $db_password, $db_name, $prefix_table;
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{		
				mysqli_query($polaczenie, "SET CHARSET utf8");
				mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");		

				$rezultat = "SELECT * FROM `".$prefix_table."bm_data_posty` $where $kategoria $status $szukaj ORDER BY `id`DESC, `datetime` DESC LIMIT $ile_load";
				$wynik = $polaczenie->query($rezultat);
					
					$ile = mysqli_num_rows($wynik);
					
					$ile2 = $ile-1;
			
					$one = 1;	
					
					// tworzenie tablicy do przechowywanie każdego wyrenderowanego wyniku (id) 
					
					$all_id = ""; 
					
echo<<<END

						
						<section class="tsr-p-5px tsr-fl tsr fs-70 tsr-border-solid-bottom col-st">
							<section class="col-st5">
								<input type="checkbox" name="zaznacz-blok" class="input tsr-mini tsr-vertical-align-top checked-all checked-all-delete " data-checkall="1" id="checked-all"/>
							</section>
							<section class="col-st35 tsr-algin-left tsr-algin-center-4">
								Tytuł
							</section>
							<section class="col-st10 tsr-algin-center">
								Autor
							</section>
							<section class="col-st10 tsr-algin-center">
								Status
							</section>
							<section class="col-st10 tsr-algin-center">
								Kategoria
							</section>
							<section class="col-st10 tsr-algin-center">
								Tag
							</section>
							<section class="col-st10 tsr-algin-center">
								Kategoria post
							</section>
							<section class="col-st10 tsr-algin-right tsr-algin-center-4">
								Data
							</section>	
						</section>

						<script type="text/javascript">
						
							var akcja_records = [];
						
						</script>

END;
					
					for ($i = 1; $i <= $ile; $i++) 
					{
						
						
						$row = mysqli_fetch_assoc($wynik);
						$id_post = $row['id'];
						$dodajacy_post = $row['dodajacy'];
						$tytul_post = $row['tytul'];
						$url_post = $row['url'];
						$kategoria_post = $row['kategoria'];
						$kategoria_post_post = $row['kategoria_post'];
						$status_post = $row['status'];
						$tagi_post = $row['tagi'];
						$datetime_post = $row['datetime'];
						$datetime_zmiany_post = $row['datetime_zmiany'];
						$kto_edit_post = $row['kto_edit'];
						$tresc_post= $row['tresc'];	
						
						$data_post = date('d-m-Y',strtotime($datetime_post));
						$godzina_post = date('H:i',strtotime($datetime_post));
						$data_zmiany_post = date('d-m-Y',strtotime($datetime_zmiany_post));
						$godzina_zmiany_post = date('H:i',strtotime($datetime_zmiany_post));
						
						$url_post = str_replace(" ","-",$url_post);
						
						$all_id .= '"'.$id_post.'",';
						
						if ($tagi_post === ""){
							$tagi_post = "brak tagu";
						}
						
						if ($kategoria_post == "post") {
							$kategoria_post = 'zwykły post';
						}
						if ($kategoria_post == "info") {
							$kategoria_post = 'informacja';
						}
						if ($kategoria_post == "wazne_info") {
							$kategoria_post = 'ważna informacja';
						}
						if ($kategoria_post == "ostrzezenie") {
							$kategoria_post = 'ostrzeżenie';
						}
						if ($kategoria_post == "najwazniejsze_info") {
							$kategoria_post = 'najważniejsza informacja';
						}
						
						if ($status_post == "public") {
							$status_post = "Publiczny";
							}
							if ($status_post == "private") {
								$status_post = "Prywatny";
							}
							if ($status_post == "protect_password") {
								$status_post = "Zabezpieczony hasłem";
							}
							if ($status_post == "szkic") {
								$status_post = "szkic";
							}
						
						if ($datetime_post === $datetime_zmiany_post) {
							$data_all_post = '<section class="tsr fs-100">Opublikowano: </section>'. $datetime_post;
						}else{
							$data_all_post = '<section class="tsr fs-100">Edytowano Post Dnia: </section>'. $datetime_zmiany_post;
						}

						$url_serwera_bm = BM_SETTINGS["url_server"];

				 if ( $i % 2 == 0 )
				{
	
echo<<<END

						<section class="tsr-p-5px tsr-fl tsr fs-70 record-autner tsr-records id-records-$id_post col-st" data-usun="1" data-id-post="$id_post">
							<section class="col-st5">
								<input type="checkbox" name="check_usun[]" class="input checkbox tsr-mini tsr-vertical-align-top check_usun" value="$id_post" id="check_usun" data-id-post="$id_post" />
							</section>
							<section class="col-st35 fs-90 tsr-overflow-wrap-break-word tsr-algin-center-4">
								$tytul_post
								
								<section class="tsr r-0 fs-100 tsr-visable-hover">
									<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
										<a href="#post_delete_$id_post" rel="modal:open">
											Usuń post
										</a>											
									</section>
									<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
										<a href="admin-edit-post.php?edit=$id_post">
											Edytuj post
										</a>	
									</section>
									<section class="tsr-fr tsr-button tsr-visable-hover-element viev-post">
										<a href="$url_serwera_bm$url_post">
											Zobacz post
										</a>
									</section>
								</section>
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$dodajacy_post
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$status_post
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$kategoria_post
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$tagi_post
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
									$kategoria_post_post
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-right tsr-algin-center-4">
								$data_all_post
							</section>
						</section>

					<div id="post_delete_$id_post" class="tsr modal modal-auto" style="max-width: 350px;">
						<section class="tsr">
							<section class="col-2 fs-70 tsr-p-5px tsr-button">
								<a href="#usun_post_$id_post" id="ptw_delte_post_$id_post" class="cursor-pointer" rel="modal:close">
									Tak, usuń post!
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
						$('#ptw_delte_post_$id_post').click('submit', function(evt1){
						evt1.preventDefault();
						
						akcja_records.push("$id_post");
						//console.log(akcja_records);
						
						var delte_post = akcja_records;
						var d_delete_post = 1;
						
						$.ajax({
							type:"POST",
							url:"insert/post-delete.php",
							data:{
								delte_post:delte_post,
								d_delete_post:d_delete_post,
							}
						})
						.done(function(info){
							$('.id-records-$id_post').text("");
							$('.id-records-$id_post').append(info);
						})
						.fail(function(){
							alert("Wystąpił błąd. Spróbuj ponownie później");
						});
						});	
					</script>								
			
END;
	
  }
  else
  {

echo<<<END

						<section class="tsr-p-5px tsr-fl tsr fs-70 record-autner records-autner tsr-records id-records-$id_post col-st" data-usun="1" data-id-post="$id_post">
							<section class="col-st5">
								<input type="checkbox" name="check_usun[]" class="input checkbox tsr-mini tsr-vertical-align-top check_usun" value="$id_post" id="check_usun" data-id-post="$id_post" />
							</section>
							<section class="col-st35 fs-90 tsr-overflow-wrap-break-word tsr-algin-left tsr-algin-center-4">
								$tytul_post
								
								<section class="tsr r-0 fs-100 tsr-visable-hover">
									<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
										<a href="#post_delete_$id_post" rel="modal:open">
											Usuń post
										</a>											
									</section>
									<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
										<a href="admin-edit-post.php?edit=$id_post">
											Edytuj post
										</a>	
									</section>
									<section class="tsr-fr tsr-button tsr-visable-hover-element viev-post">
										<a href="$url_serwera_bm$url_post">
											Zobacz post
										</a>
									</section>
								</section>
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$dodajacy_post
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$status_post
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$kategoria_post
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$tagi_post
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
									$kategoria_post_post
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-right tsr-algin-center-4">
								$data_all_post
							</section>
						</section>	

					<div id="post_delete_$id_post" class="tsr modal modal-auto" style="max-width: 350px;">
						<section class="tsr">
							<section class="col-2 fs-70 tsr-p-5px tsr-button">
								<a href="#usun_post_$id_post" id="ptw_delte_post_$id_post" class="cursor-pointer" rel="modal:close">
									Tak, usuń post!
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
						$('#ptw_delte_post_$id_post').click('submit', function(evt1){
						evt1.preventDefault();
						
						akcja_records.push("$id_post");
						//console.log(akcja_records);
						
						var delte_post = akcja_records;
						var d_delete_post = 1;
						
						$.ajax({
							type:"POST",
							url:"insert/post-delete.php",
							data:{
								delte_post:delte_post,
								d_delete_post:d_delete_post,
							}
						})
						.done(function(info){
							$('.id-records-$id_post').text("");
							$('.id-records-$id_post').append(info);
						})
						.fail(function(){
							alert("Wystąpił błąd. Spróbuj ponownie później");
						});
						});	
					</script>		
			
END;

  }
					
					//$rezultat->free_result(); 
					}	

echo<<<END

						<section class="tsr-p-5px tsr-fl tsr fs-70 tsr-border-solid-top col-st">
							<section class="col-st5">
								<input type="checkbox" name="zaznacz-blok" class="input tsr-mini tsr-vertical-align-top checked-all " id="checked-all"/>
							</section>
							<section class="col-st35 tsr-algin-left tsr-algin-center-4">
								Tytuł
							</section>
							<section class="col-st10 tsr-algin-center">
								Autor
								</section>
							<section class="col-st10 tsr-algin-center">
								Status
							</section>
							<section class="col-st10 tsr-algin-center">
								Kategoria
							</section>
								<section class="col-st10 tsr-algin-center">
								Tag
							</section>
							<section class="col-st10 tsr-algin-center">
								Kategoria post
							</section>
							<section class="col-st10 tsr-algin-right tsr-algin-center-4">
								Data
							</section>
						</section>
					<form accept-charset="UTF-8"  action="" method="post" id="data-add-post" class="checkall">		
						<section class="tsr-fl tsr tsr-mt-20">
							<input type="submit" value="Usuń post" class="input buttom" id="usun_post_submit"/>
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
									
									//akcja_records.splice(this_arroy_index);
								}
								
								//akcja_records.remove(this_records_id);
								
							}
								
						});
						
						
						// metoda ajax wysyła id do usunięcia
						
						$('#usun_post_submit').click('submit', function(evt1){
						evt1.preventDefault();
						
						var d_delete_post = 0;
						
						if(akcja_records != ""){
						
							$.ajax({
								type:"POST",
								url:"insert/post-delete.php",
								data:{
									delte_post:akcja_records,
									d_delete_post:d_delete_post,
								}
							})
							.done(function(info){
								//$('html').text("");
								$('html').append(info);
							})
							.fail(function(){
								alert("Wystąpił błąd. Spróbuj ponownie później");
							});
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
			//echo '<br />Informacja developerska: '.$e;
		}	

?>