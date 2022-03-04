<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyciągania z bazy wszystkich postów które admin będzie poczebował
	
	Black Min cms,
	
	#plik: 2.0
*/

	// ładowanie jądra black mina
	require_once "../black-min.php";

	// odbieranie od klienta metodą post informacji na temat poszukiwanych rekordów w bazie danych
	
	if (isset ($_POST['status'])){
		$status = $_POST['status'];
	}else{
		$status = "all";
	}
	
	if (isset ($_POST['typ'])){
		$typ = $_POST['typ'];
	}else {
		$typ = "all";
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
	
	$status = $db_bm->valid($status);
	$typ = $db_bm->valid($typ);
	$szukaj = $db_bm->valid($szukaj);
	$ile_load = $db_bm->valid($ile_load);
	
	$status = ($status == "all" ? "`status` LIKE '%%'" : "`status` LIKE '". $status ."'");
	$typ = ($typ == "all" ? "`kategoria` LIKE '%%'" : "`kategoria` LIKE '". $typ ."'");
	$szukaj = (strlen($szukaj) === 0 ? "(`tytul` LIKE '%%' OR `url` LIKE '%%' OR `tagi` LIKE '%%' OR `tresc` LIKE '%%')" : "(`tytul` LIKE '%". $szukaj ."%' OR `url` LIKE '%". $szukaj ."%' OR `tagi` LIKE '%". $szukaj ."%' OR `tresc` LIKE '%". $szukaj ."%')");
	$ile_load = ($ile_load < 0 ? 0 : $ile_load);
	// zapytanie do db
	$zap = $db_bm->query2("SELECT * FROM `|prefix|bm_data_posty` WHERE $status AND $typ AND $szukaj ORDER BY `id` DESC LIMIT $ile_load");

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
							<input type="checkbox" class="bm-pcheckbox" bm-data="post">
							<span class="checkbox "></span>
						</label>
					</th>
					<td class="tsr-width-40 tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-tytul">
						Tytuł
					</td>
					<td class="tsr-width-150px tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-dodajacy">
						Dodający
					</td>
					<td class="tsr-width-150px tsr-width-40 tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-status">
						Status
					</td>
					<td class="tsr-width-100px tsr-width-150px-3 tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-kategoria">
						Typ
					</td>
					<td class="tsr-width-100px tsr-width-150px-3 tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-tagi">
						Tag
					</td>
					<td class="tsr-width-150px tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-kategoria_post">
						Kategoria Post
					</td>
					<td class="tsr-width-100px tsr-width-50px-3  tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-datetime">
						Data Opublikowania
					</td>
				</tr>
			</thead>
			<tbody class="tsr-width-100 tsr-border-bottom-solid-black-1">
		';

		for ($i=0; $i < $zap["num_rows"]; $i++) {
			$data = ($zap[$i]["datetime"] == $zap[$i]["datetime_zmiany"] ? $zap[$i]["datetime"] : ("Edytowano: " . $zap[$i]["datetime_zmiany"])); 
			$tag = (trim($zap[$i]["tagi"]) == "" ? "brak" : $zap[$i]["tagi"]);
			$kategoria = (trim($zap[$i]["kategoria_post"]) == "" ? "brak" : $zap[$i]["kategoria_post"]);
			echo '
				<tr class="tsr-color-table bm-row-dl" bm-row-data="'. $i .'">
					<th bm-data="bm-r-id"> 
						<label class="checkboxs">
							<input type="checkbox" class="bm-checkbox" bm-data="'. $zap[$i]["id"] .'">
							<span class="checkbox "></span>
						</label>
					</th>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-tytul"> '. $zap[$i]["tytul"] .' 
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
								<a href="admin-edit-post.php?edit='. $zap[$i]["id"] .' ">
									Edytuj	
								</a>
							</section>
							<section class="fs-100 tsr-button tsr-visable-hover-element tsr-visibility-visable-2 bm-row-view">
								<a href="'. BM_SETTINGS["url_site"] . $zap[$i]["url"] .'">
									Zobacz	
								</a>
							</section>
						</section>
					</td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-dodajacy"> '. $zap[$i]["dodajacy"] .' </td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-status"> '. str_replace("_", " ", $zap[$i]["status"]) .' </td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-kategoria"> '. str_replace("_", " ", $zap[$i]["kategoria"]) .' </td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-tagi"> '. $tag .' </td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-kategoria_post"> '. $kategoria .' </td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-kategoria_post"> '. $data .' </td>
				</tr>
			';
		}

		echo '
				</tbody>
			</table>

			<section class="tsr tsr tsr-mt-20">
				<input type="submit" value="Wykonaj akcję!" class="input buttom" action="post-delete" id="blackmin_action"/>
			</section>
		';

	}