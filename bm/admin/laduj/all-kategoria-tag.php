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
	
	require_once "class-get-ustawienia.php";

	// Tworzenie struktury logiczenej do zawansowanego wszyszukiwania w bazie danych

	$kategoria_KT_aktywny = false;
	$szukaj_aktywny = false;
	
	// odnieranie od skryptu metodą post informacji na temat poszukiwanych rekordów w bacie danych
	
	if (isset ($_POST['kategoria_KT'])){
		$kategoria_KT = $_POST['kategoria_KT'];
	}else{
		$kategoria_KT = "all";
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
	
	// stosowanie filtrowania danych przychodzących z posta (choć jest to nie poczebne)
	
	$kategoria_KT = htmlentities($kategoria_KT, ENT_QUOTES, "UTF-8");
	$szukaj = htmlentities($szukaj, ENT_QUOTES, "UTF-8");			

	// sprawdzanie który element posta został przesłany i na tej podstawie można zrobić wyszukiwanie selektywne
		
	if ($kategoria_KT != "all") {
		$kategoria_KT_aktywny = true;
	}
		
	if ($szukaj != "") {
		$szukaj_aktywny = true;
	}
	
	// wybieranie odpowiedniego wyszukiwania podanego przez osobę szukającą
		
	if ($kategoria_KT != "all") {
		$kategoria_KT = "`bm_KT` LIKE '". $kategoria_KT ."'";
	}else {
		$kategoria_KT ="";
	}
		
	if ($szukaj != "") {
		if (($kategoria_KT_aktywny == false) AND ($szukaj_aktywny == true)) {
			$szukaj = "`bm_nazwa` LIKE '%". $szukaj ."%'";
		}else{
			$szukaj = "AND `bm_nazwa` LIKE '%". $szukaj ."%'";
		}
	 }else {
		 $szukaj = "";
	 }
	
	if (($kategoria_KT_aktywny == true) OR ($szukaj_aktywny == true)) {
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

				$rezultat = "SELECT * FROM `".$prefix_table."bm_metaposty` $where $kategoria_KT $szukaj ORDER BY `id`DESC LIMIT $ile_load";
				$wynik = $polaczenie->query($rezultat);
					
					$ile = mysqli_num_rows($wynik);
					
					$ile2 = $ile-1;
			
					$one = 1;	
					
					// tworzenie tablicy do przechowywanie każdego wyrenderowanego wyniku (id) 
					
					$all_id = ""; 
					
echo<<<END

						
						<section class="tsr-p-5px tsr-fl tsr fs-70 tsr-border-solid-bottom col-st">
							<section class="col-st5">
								<input type="checkbox" name="zaznacz-blok" class="input tsr-mini tsr-vertical-align-top checked-all checked-all-delete " id="checked-all"/>
							</section>
							<section class="col-st25 tsr-algin-left tsr-algin-center-4">
								Pełna Nazwa
							</section>
							<section class="col-st20 tsr-algin-center">
								Skrócona Nazwa
							</section>
							<section class="col-st35 tsr-algin-center">
								Opis
							</section>
							<section class="col-st15 tsr-algin-center">
								Kategoria/Tag
							</section>
						</section>

						<script type="text/javascript">
						
							var akcja_records = [];
						
						</script>

END;
					
					for ($i = 0; $i < $ile; $i++) 
					{
						
						
						$row = mysqli_fetch_assoc($wynik);
						$id_KT = $row['id'];
						$nazwa_KT = $row['bm_nazwa'];
						$skrucona_nazwa_KT = $row['bm_skr_nazwa'];
						$opis_KT = $row['bm_opis'];
						$KT_KT = $row['bm_KT'];	
						
						//array_push($all_id, $id_KT);
						//echo $all_id[$i];
						$all_id .= '"'.$id_KT.'",';

				 if ( $i % 2 == 0 )
				{
	
echo<<<END

						<section class="tsr-p-5px tsr-fl tsr fs-70 record-autner tsr-records id-records-$id_KT col-st" data-id-post="$id_KT">
							<section class="col-st5">
								<input type="checkbox" name="check_usun[]" class="input checkbox tsr-mini tsr-vertical-align-top check_usun" value="$id_KT" id="check_usun" data-id-post="$id_KT" />
							</section>
							<section class="col-st25 fs-90 tsr-overflow-wrap-break-word tsr-algin-center-4">
								$nazwa_KT
								
								<section class="tsr r-0 fs-100 tsr-visable-hover">
									<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
										<a href="#post_delete_$id_KT" rel="modal:open">
											Usuń KT
										</a>											
									</section>
									<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
										<a href="admin-edit-kategoria-tag.php?edit=$id_KT">
											Edytuj kKT
										</a>	
									</section>
								</section>
							</section>
							<section class="col-st20 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$skrucona_nazwa_KT
							</section>
							<section class="col-st35 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$opis_KT
							</section>
							<section class="col-st15 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$KT_KT
							</section>
						</section>

					<div id="post_delete_$id_KT" class="tsr modal modal-auto" style="max-width: 500px;">
						<section class="tsr">
							<section class="col-2 fs-70 tsr-p-5px tsr-button">
								<a href="#usun_post_$id_KT" id="ptw_delte_post_$id_KT" class="cursor-pointer" rel="modal:close">
									Tak, usuń Kategoria/Tag!
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
						$('#ptw_delte_post_$id_KT').click('submit', function(evt1){
						evt1.preventDefault();
						
						delete_KT.push("$id_KT");
						
						var delte_KT = delete_KT;
						var d_delete_KT = 1;
						
						$.ajax({
							type:"POST",
							url:"insert/kategoria-tag-delete.php",
							data:{
								delte_KT:delte_KT,
								d_delete_KT:d_delete_KT,
							}
						})
						.done(function(info){
							$('.id-records-$id_KT').text("");
							$('.id-records-$id_KT').append(info);
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

						<section class="tsr-p-5px tsr-fl tsr fs-70 record-autner tsr-records id-records-$id_KT col-st" data-id-post="$id_KT">
							<section class="col-st5">
								<input type="checkbox" name="check_usun[]" class="input checkbox tsr-mini tsr-vertical-align-top check_usun" value="$id_KT" id="check_usun" data-id-post="$id_KT" />
							</section>
							<section class="col-st25 fs-90 tsr-overflow-wrap-break-word tsr-algin-center-4">
								$nazwa_KT
								
								<section class="tsr r-0 fs-100 tsr-visable-hover">
									<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
										<a href="#post_delete_$id_KT" rel="modal:open">
											Usuń KT
										</a>											
									</section>
									<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
										<a href="admin-edit-kategoria-tag.php?edit=$id_KT">
											Edytuj KT
										</a>	
									</section>
								</section>
							</section>
							<section class="col-st20 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$skrucona_nazwa_KT
							</section>
							<section class="col-st35 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$opis_KT
							</section>
							<section class="col-st15 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$KT_KT
							</section>
						</section>

					<div id="post_delete_$id_KT" class="tsr modal modal-auto" style="max-width: 500px;">
						<section class="tsr">
							<section class="col-2 fs-70 tsr-p-5px tsr-button">
								<a href="#usun_post_$id_KT" id="ptw_delte_post_$id_KT" class="cursor-pointer" rel="modal:close">
									Tak, usuń Kategoria/Tag!
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
						$('#ptw_delte_post_$id_KT').click('submit', function(evt1){
						evt1.preventDefault();
						
						delete_KT.push("$id_KT");
						
						var delte_KT = delete_KT;
						var d_delete_KT = 1;
						
						$.ajax({
							type:"POST",
							url:"insert/kategoria-tag-delete.php",
							data:{
								delte_KT:delte_KT,
								d_delete_KT:d_delete_KT,
							}
						})
						.done(function(info){
							$('.id-records-$id_KT').text("");
							$('.id-records-$id_KT').append(info);
						})
						.fail(function(){
							alert("Wystąpił błąd. Spróbuj ponownie później");
						});
						});	
					</script>		
			
END;

  }
					
					}	

echo<<<END

						<section class="tsr-p-5px tsr-fl tsr fs-70 tsr-border-solid-bottom col-st">
							<section class="col-st5">
								<input type="checkbox" name="zaznacz-blok" class="input tsr-mini tsr-vertical-align-top checked-all checked-all-delete " id="checked-all"/>
							</section>
							<section class="col-st25 tsr-algin-left tsr-algin-center-4">
								Pełna Nazwa
							</section>
							<section class="col-st20 tsr-algin-center">
								Skrócona Nazwa
							</section>
							<section class="col-st35 tsr-algin-center">
								Opis
							</section>
							<section class="col-st15 tsr-algin-center">
								Kategoria/Tag
							</section>
						</section>
					<form accept-charset="UTF-8"  action="" method="post" id="data-add-post" class="checkall">		
						<section class="tsr-fl tsr tsr-mt-20">
							<input type="submit" value="Usuń Kategoria/Tag" class="input buttom" id="usun_post_submit"/>
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
						
						$('#usun_post_submit').click('submit', function(evt1){
						evt1.preventDefault();
						
						var d_delete_KT = 0;
						
						if(akcja_records != ""){
						
							$.ajax({
								type:"POST",
								url:"insert/kategoria-tag-delete.php",
								data:{
									delte_KT:akcja_records,
									d_delete_KT:d_delete_KT,
								}
							})
							.done(function(info){
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
		}	

?>