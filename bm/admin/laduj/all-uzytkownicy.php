<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyciągania z bazy wszystkich użytkowników
	
	#Zawannsowane szukanie
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "../black-min.php";

	if (isset ($_POST['plec'])){
		$plec = $_POST['plec'];
	}else{
		$plec = "plec";
	}
	
	if (isset ($_POST['dostep'])){
		$dostep = $_POST['dostep'];
	}else {
		$dostep = "";
	}
	
	if (isset ($_POST['ranga'])){
		$ranga = $_POST['ranga'];
	}else {
		$ranga = "";
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

	global $db_bm;
	// filtrowanie danych
	
	$plec = $db_bm->valid($plec);
	$dostep = $db_bm->valid($dostep);
	$ranga = $db_bm->valid($ranga);
	$szukaj = $db_bm->valid($szukaj);
	$ile_load = $db_bm->valid($ile_load);
	
	$plec = ($plec === "all" ? "`plec` LIKE '%%'" : "`plec` LIKE '". $plec ."'");
	$dostep = ($dostep === "all" ? "`dostep` LIKE '%%'" : "`dostep` LIKE '". $dostep ."'");
	$ranga = ($ranga === "all" ? "`ranga` LIKE '%%'" : "`ranga` LIKE '". $ranga ."'");
	$szukaj = (strlen($szukaj) === 0 ? "(`nick` LIKE '%%' OR `imie` LIKE '%%' OR `nazwisko` LIKE '%%' OR `email` LIKE '%%')" : "(`nick` LIKE '%". $szukaj ."%' OR `imie` LIKE '%". $szukaj ."%' OR `nazwisko` LIKE '%". $szukaj ."%' OR `email` LIKE '%". $szukaj ."%')");
	$ile_load = ($ile_load < 0 ? 0 : $ile_load);
	// zapytanie do db
	$zap = $db_bm->query2("SELECT * FROM `bm_uzytkownicy` WHERE $plec AND $dostep AND $ranga AND $szukaj ORDER BY `id` DESC LIMIT $ile_load");

	if ($zap["num_rows"] == 0) {
		echo '<section class="tsr-alert tsr-alert-info">Brak danych do wyświetlenia!</section>';
		exit();
	}else{

		echo '
		<table class="tsr fs-60 tsr-border-groove1-all">
			<thead class="tsr-width-100 fs-120 tsr-border-bottom-solid-black-1">
				<tr>
					<th class="tsr-width-25px" bm-data="bm-r-id">
						<label class="checkboxs">
							<input type="checkbox" class="bm-pcheckbox" bm-data="user">
							<span class="checkbox "></span>
						</label>
					</th>
					<td class="tsr-width-30 tsr-width-30-5 tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="nick">	
						Avatar/Nick
					</td>
					<td class="tsr-width-300px tsr-width-200px-5 tsr-width-100px-4 tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="imie">
						Imie/Nazwisko
					</td>
					<td class="tsr-width-15 tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="email">
						Email
					</td>
					<td class="tsr-width-100px tsr-width-100-4 tsr-display-block-4 tsr-p-5px" bm-data="płeć">
						Płeć
					</td>
					<td class="tsr-width-100px tsr-width-100-4 tsr-display-block-4 tsr-p-5px" bm-data="dostęp">
						Dostęp
					</td>
					<td class="tsr-width-200px tsr-width-100-4 tsr-display-block-4 tsr-p-5px" bm-data="ranga">
						Ranga
					</td>
					<td class="tsr-width-50px tsr-width-100-4 tsr-display-block-4 tsr-p-5px" bm-data="online">
						Online
					</td>
					<td class="tsr-width-175px tsr-width-100px-5 tsr-width-100-4 tsr-display-block-4 tsr-p-5px" bm-data="datetime">
						Data Opublikowania
					</td>
				</tr>
			</thead>
			<tbody class="tsr-width-100 tsr-border-bottom-solid-black-1">
		';

		for ($i=0; $i < $zap["num_rows"]; $i++) {
			$dostep = str_replace("_", " ", $zap[$i]["dostep"]);
			$miniaturka = ($zap[$i]["avatar"] == "null" ? "" : ('<img src="'. $zap[$i]["avatar"] .'" alt="M" title="'. $zap[$i]["nick"] .'" class="img tsr-miniaturka tsr-vertical-align-middle tsr-width-75px tsr-mr-10" loading="lazy">'));
			echo '
				<tr class="tsr-color-table bm-row-dl" bm-row-data="'. $i .'">
					<th bm-data="bm-r-id"> 
						<label class="checkboxs">
							<input type="checkbox" class="bm-checkbox" bm-data="'. $zap[$i]["id"] .'">
							<span class="checkbox "></span>
						</label>
					</th>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="nick"> ' . $miniaturka . $zap[$i]["nick"] .' 
						<section class="tsr fs-80 tsr-visable-hover tsr-visibility-visable-2">
							<section class="fs-100 tsr-button tsr-visable-hover-element tsr-visibility-visable-2 bm-row-delete">		
								
								<span class="tsr-pmodal red" tsr-modal-close="true">
									Usuń
									<section class="tsr-modal" tsr-modal-close="true">
										<section class="tsr">
											<span class="tsr fs-110 tsr-border-bottom-dashed">Potwierdź akcję</span>
											
											<input type="button" class="col-2 fs-70 tsr-p-5px tsr-button bm-button-ac " bm-action-data="'. $zap[$i]["id"] .'" value="Tak, usuń!" />
											<section class="col-2 tsr-button tsr-error tsr-modal-closed  bm-button-delete tsr-modal-closed-button">
												Anuluj!
											</section>
												
										</section>
									</section>
								</span>

							</section>
							<section class="fs-100 tsr-button tsr-visable-hover-element tsr-visibility-visable-2 bm-row-edit">
								<a href="admin-edit-profil-uzytkownika.php?edit='. $zap[$i]["id"] .' ">
									Edytuj	
								</a>
							</section>
						</section>
					</td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="imie"> '. $zap[$i]["imie"] . " " . $zap[$i]["nazwisko"] .' </td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="email"> '. $zap[$i]["email"] .' </td>
					<td class="tsr-display-block-4 tsr-p-5px tsr-word-break" bm-data="płeć"> '. $zap[$i]["plec"] .' </td>
					<td class="tsr-display-block-4 tsr-p-5px tsr-word-break" bm-data="dostęp"> '. $dostep .' </td>
					<td class="tsr-display-block-4 tsr-p-5px tsr-word-break" bm-data="ranga"> '. $zap[$i]["ranga"] .' </td>
					<td class="tsr-display-block-4 tsr-p-5px tsr-word-break" bm-data="online"> '. $zap[$i]["online"] .' </td>
					<td class="tsr-display-block-4 tsr-p-5px tsr-word-break" bm-data="datetime"> '. $zap[$i]["date_dolonczenia"] .' </td>
				</tr>
			';
		}

		echo '
				</tbody>
			</table>

			<section class="tsr tsr tsr-mt-20">
				<input type="submit" value="Wykonaj akcję!" class="input buttom" action="uzytkownik-delete" id="blackmin_action"/>
			</section>
		';
	}


	exit();

	// Tworzenie struktury logiczenej do zawansowanego wszyszukiwania w bazie danych

	$plec_aktywny = false;
	$dostep_aktywny = false;
	$ranga_aktywny = false;
	$szukaj_aktywny = false;
	
	// odnieranie od skryptu metodą post informacji na temat poszukiwanych rekordów w bacie danych
	
	if (isset ($_POST['plec'])){
		$plec = $_POST['plec'];
	}else{
		$plec = "all";
	}
	
	if (isset ($_POST['dostep'])){
		$dostep = $_POST['dostep'];
	}else{
		$dostep = "all";
	}
	
	if (isset ($_POST['ranga'])){
		$ranga = $_POST['ranga'];
	}else{
		$ranga = "all";
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
	
	$plec = htmlentities($plec, ENT_QUOTES, "UTF-8");
	$dostep = htmlentities($dostep, ENT_QUOTES, "UTF-8");
	$ranga = htmlentities($ranga, ENT_QUOTES, "UTF-8");
	$szukaj = htmlentities($szukaj, ENT_QUOTES, "UTF-8");			

	// sprawdzanie który element posta został przesłany i na tej podstawie można zrobić wyszukiwanie selektywne

	if ($plec != "all") {
		$plec_aktywny = true;
	}
		
	if ($dostep != "all") {
		$dostep_aktywny = true;
	}
	
	if ($ranga != "all") {
		$ranga_aktywny = true;
	}
		
	if ($szukaj != "") {
		$szukaj_aktywny = true;
	}
	
	// wybieranie odpowiedniego wyszukiwania podanego przez osobę szukającą
		
	if ($plec != "all") {
		$plec = "`plec` LIKE '". $plec ."'";
	}else {
		$plec = "";
	}
		
	if ($dostep != "all") {
		if (($plec_aktywny == false) AND ($dostep_aktywny == true)) {
			$dostep = "`dostep` LIKE '". $dostep ."'";
		}else{
			$dostep = "AND `dostep` LIKE '". $dostep ."'";
		}
	}else {
		$dostep ="";
	}
	
	if ($ranga != "all") {
		if (($plec_aktywny == false) AND ($dostep_aktywny == false) AND ($ranga_aktywny == true)) {
			$ranga = "`ranga` LIKE '". $ranga ."'";
		}else{
			$ranga = "AND `ranga` LIKE '". $ranga ."'";
		}
	}else {
		$ranga ="";
	}
		
	if ($szukaj != "") {
		if (($plec_aktywny == false) AND ($dostep_aktywny == false) AND ($ranga_aktywny == false) AND ($szukaj_aktywny == true)) {
			$szukaj = "`nick` LIKE '%". $szukaj ."%' OR `imie` LIKE '%". $szukaj ."%' OR `nazwisko` LIKE '%". $szukaj ."%' OR `email` LIKE '%". $szukaj ."%'";
		}else{
			$szukaj = "AND `nick` LIKE '%". $szukaj ."%' OR `imie` LIKE '%". $szukaj ."%' OR `nazwisko` LIKE '%". $szukaj ."%' OR `email` LIKE '%". $szukaj ."%'";
		}
	 }else {
		 $szukaj = "";
	 }
	
	if (($plec_aktywny == true) OR ($dostep_aktywny == true) OR ($ranga_aktywny == true) OR ($szukaj_aktywny == true)) {
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

				$rezultat = "SELECT * FROM `".$prefix_table."bm_uzytkownicy` $where $plec $dostep $ranga $szukaj ORDER BY `id`ASC LIMIT $ile_load";
				$wynik = $polaczenie->query($rezultat);
					
					$ile = mysqli_num_rows($wynik);
					
					$ile2 = $ile-1;
			
					$one = 1;	
					
					// tworzenie tablicy do przechowywanie każdego wyrenderowanego wyniku (id) 
					
					$all_id = ""; 
					$url_serwera_bm = BM_SETTINGS["url_server"];
					
echo<<<END

						
						<section class="tsr-p-5px tsr-fl tsr fs-70 tsr-border-solid-bottom col-st">
							<section class="col-st5">
								<input type="checkbox" name="zaznacz-blok" class="input tsr-mini tsr-vertical-align-top checked-all checked-all-delete " data-checkall="1" id="checked-all"/>
							</section>
							<section class="col-st20 tsr-algin-left tsr-algin-center-4">
								Avatar/Nick
							</section>
							<section class="col-st15 tsr-algin-center">
								Imie/Nazwisko
							</section>
							<section class="col-st10 tsr-algin-center">
								Email
							</section>
							<section class="col-st10 tsr-algin-center">
								Płeć
							</section>
							<section class="col-st10 tsr-algin-center">
								Dostęp
							</section>
							<section class="col-st10 tsr-algin-center">
								Ranga
							</section>
							<section class="col-st10 tsr-algin-center">
								Online
							</section>
							<section class="col-st10 tsr-algin-right tsr-algin-center-4">
								Data Dołączenia
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
						$nick = $row['nick'];
						$imie = $row['imie'];
						$nazwisko = $row['nazwisko'];
						$mail = $row['email'];
						$plec = $row['plec'];
						$date_dolonczenia = $row['date_dolonczenia'];
						$avatar = $row['avatar'];
						$token = $row['token'];
						$dostep = $row['dostep'];
						$ranga = $row['ranga'];
						$online = $row['online'];
						$ostatnio_aktywny = $row['ostatnio_aktywny'];	
						
						$data_post = date('d-m-Y',strtotime($date_dolonczenia));
						$godzina_post = date('H:i',strtotime($date_dolonczenia));
						$data_zmiany_post = date('d-m-Y',strtotime($ostatnio_aktywny));
						$godzina_zmiany_post = date('H:i',strtotime($ostatnio_aktywny));
						
						$all_id .= '"'.$id.'",';

				 if ( $i % 2 == 0 )
				{
	
echo<<<END

						<section class="tsr-p-5px tsr-fl tsr fs-70 record-autner tsr-records id-records-$id col-st" data-id-post="$id">
							<section class="col-st5">
								<input type="checkbox" name="check_usun[]" class="input checkbox tsr-mini tsr-vertical-align-top check_usun" value="$id" id="check_usun" data-id-post="$id" />
							</section>
							<section class="col-st20 fs-90 tsr-overflow-wrap-break-word tsr-vertical-align-middle tsr-algin-center-4">
								<img src="$avatar" class="img avatar tsr-vertical-align-middle" alt="$avatar">
								$nick
								
								<section class="tsr r-0 fs-100 tsr-visable-hover">
									<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
										<a href="#post_delete_$id" rel="modal:open">
											Usuń
										</a>											
									</section>
									<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
										<a href="admin-edit-profil-uzytkownika.php?edit=$id">
											Edytuj
										</a>	
									</section>
									<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
										<a href="#szczegoly_profilu_$id" rel="modal:open">
											Szczegóły Profilu
										</a>	
									</section>
								</section>
							</section>
							<section class="col-st15 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$imie $nazwisko
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$mail
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$plec
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$dostep
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$ranga
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$online
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-right tsr-algin-center-4">
								$date_dolonczenia
							</section>
						</section>

					<div id="szczegoly_profilu_$id" class="tsr modal modal-auto">
						<section class="tsr">
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Nick:
								</section>
								<section class="col-inp-75">
									$nick
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Imie:
								</section>
								<section class="col-inp-75">
									$imie
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Nazwisko:
								</section>
								<section class="col-inp-75">
									$nazwisko
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Email:
								</section>
								<section class="col-inp-75">
									$mail
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Avatar:
								</section>
								<section class="col-inp-75">
									<img src="$avatar" class="img avatar tsr-vertical-align-middle" alt="$avatar">
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Plec:
								</section>
								<section class="col-inp-75">
									$plec
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Dostęp:
								</section>
								<section class="col-inp-75">
									$dostep
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Ranga:
								</section>
								<section class="col-inp-75">
									$ranga
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Online:
								</section>
								<section class="col-inp-75">
									$online
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Token:
								</section>
								<section class="col-inp-75">
									$token
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Data dołączenia:
								</section>
								<section class="col-inp-75">
									$date_dolonczenia
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Ostatnio Aktywny:
								</section>
								<section class="col-inp-75">
									$ostatnio_aktywny
								</section>
							</section>
						</section>
						<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
					</div>
					
					<div id="post_delete_$id" class="tsr modal modal-auto" style="max-width: 350px;">
						<section class="tsr">
							<section class="col-2 fs-70 tsr-p-5px tsr-button">
								<a href="#usun_post_$id" id="ptw_delte_post_$id" class="cursor-pointer" rel="modal:close">
									Tak, usuń użytkownika!
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
						
						var delte_post = akcja_records;
						var d_delete_post = 1;
						
						$.ajax({
							type:"POST",
							url:"insert/uzytkownik-delete.php",
							data:{
								delte_post:delte_post,
								d_delete_post:d_delete_post,
							}
						})
						.done(function(info){
							$('.id-records-$id').text("");
							$('.id-records-$id').append(info);
							$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
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

						<section class="tsr-p-5px tsr-fl tsr fs-70  record-autner records-autner tsr-records id-records-$id col-st" data-id-post="$id">
							<section class="col-st5">
								<input type="checkbox" name="check_usun[]" class="input checkbox tsr-mini tsr-vertical-align-top check_usun" value="$id" id="check_usun" data-id-post="$id" />
							</section>
							<section class="col-st20 fs-90 tsr-overflow-wrap-break-word tsr-vertical-align-middle tsr-algin-center-4">
								<img src="$avatar" class="img avatar tsr-vertical-align-middle" alt="$avatar">
								$nick
								
								<section class="tsr r-0 fs-100 tsr-visable-hover">
									<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
										<a href="#post_delete_$id" rel="modal:open">
											Usuń
										</a>											
									</section>
									<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
										<a href="admin-edit-profil-uzytkownika.php?edit=$id">
											Edytuj
										</a>	
									</section>
									<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
										<a href="#szczegoly_profilu_$id" rel="modal:open">
											Szczegóły Profilu
										</a>	
									</section>
								</section>
							</section>
							<section class="col-st15 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$imie $nazwisko
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$mail
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$plec
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$dostep
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$ranga
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-center">
								$online
							</section>
							<section class="col-st10 fs-90 tsr-overflow-wrap-break-word tsr-algin-right tsr-algin-center-4">
								$date_dolonczenia
							</section>
						</section>

					<div id="szczegoly_profilu_$id" class="tsr modal modal-auto">
						<section class="tsr">
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Nick:
								</section>
								<section class="col-inp-75">
									$nick
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Imie:
								</section>
								<section class="col-inp-75">
									$imie
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Nazwisko:
								</section>
								<section class="col-inp-75">
									$nazwisko
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Email:
								</section>
								<section class="col-inp-75">
									$mail
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Avatar:
								</section>
								<section class="col-inp-75">
									<img src="$avatar" class="img avatar tsr-vertical-align-middle" alt="$avatar">
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Plec:
								</section>
								<section class="col-inp-75">
									$plec
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Dostęp:
								</section>
								<section class="col-inp-75">
									$dostep
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Ranga:
								</section>
								<section class="col-inp-75">
									$ranga
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Online:
								</section>
								<section class="col-inp-75">
									$online
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Token:
								</section>
								<section class="col-inp-75">
									$token
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Data dołączenia:
								</section>
								<section class="col-inp-75">
									$date_dolonczenia
								</section>
							</section>
							<section class="tsr fs-70">
								<section class="col-inp-25">
									Ostatnio Aktywny:
								</section>
								<section class="col-inp-75">
									$ostatnio_aktywny
								</section>
							</section>
						</section>
						<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/ikony/zamknij.png" class="img" /></a>
					</div>
					
					<div id="post_delete_$id" class="tsr modal modal-auto" style="max-width: 350px;">
						<section class="tsr">
							<section class="col-2 fs-70 tsr-p-5px tsr-button">
								<a href="#usun_post_$id" id="ptw_delte_post_$id" class="cursor-pointer" rel="modal:close">
									Tak, usuń użytkownika!
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
						
						var delte_post = akcja_records;
						var d_delete_post = 1;
						
						$.ajax({
							type:"POST",
							url:"insert/uzytkownik-delete.php",
							data:{
								delte_post:delte_post,
								d_delete_post:d_delete_post,
							}
						})
						.done(function(info){
							$('.id-records-$id').text("");
							$('.id-records-$id').append(info);
							$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
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

						<section class="tsr-p-5px tsr-fl tsr fs-70 tsr-border-solid-top col-st">
							<section class="col-st5">
								<input type="checkbox" name="zaznacz-blok" class="input tsr-mini tsr-vertical-align-top checked-all " id="checked-all"/>
							</section>
							<section class="col-st20 tsr-algin-left tsr-algin-center-4">
								Avatar/Nick
							</section>
							<section class="col-st15 tsr-algin-center">
								Imie/Nazwisko
							</section>
							<section class="col-st10 tsr-algin-center">
								Email
							</section>
							<section class="col-st10 tsr-algin-center">
								Płeć
							</section>
							<section class="col-st10 tsr-algin-center">
								Dostęp
							</section>
							<section class="col-st10 tsr-algin-center">
								Ranga
							</section>
							<section class="col-st10 tsr-algin-center">
								Online
							</section>
							<section class="col-st10 tsr-algin-right tsr-algin-center-4">
								Data Dołączenia
							</section>	
						</section>
					<form accept-charset="UTF-8"  action="" method="post" id="data-add-post" class="checkall">		
						<section class="tsr-fl tsr tsr-mt-20">
							<input type="submit" value="Usuń użytkownika" class="input buttom" id="usun_post_submit"/>
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
								url:"insert/uzytkownik-delete.php",
								data:{
									delte_post:akcja_records,
									d_delete_post:d_delete_post,
								}
							})
							.done(function(info){
								//$('#post_container').text("");
								$('#post_container').append(info);
								$(this).closest('.tsr-records').fadeOut(1100);
								$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
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