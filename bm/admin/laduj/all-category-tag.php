<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyciągania z bazy wszystkich kategori i tagów
	
	Black Min cms,
	
	#plik: 2.0
*/

	// ładowanie jądra black mina
	require_once "../black-min.php";

	
	// odbieranie od klienta metodą post informacji na temat poszukiwanych rekordów w bazie danych
	
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

	global $db_bm;
	// filtrowanie danych
	
	$kategoria_KT = $db_bm->valid($kategoria_KT);
	$szukaj = $db_bm->valid($szukaj);
	$ile_load = $db_bm->valid($ile_load);
	
	$kategoria_KT = ($kategoria_KT == "all" ? "`bm_KT` LIKE '%%'" : "`bm_KT` LIKE '". $kategoria_KT ."'");
	$szukaj = (strlen($szukaj) === 0 ? "(`bm_nazwa` LIKE '%%' OR `bm_skr_nazwa` LIKE '%%' OR `bm_opis` LIKE '%%')" : "(`bm_nazwa` LIKE '%". $szukaj ."%' OR `bm_skr_nazwa` LIKE '%". $szukaj ."%' OR `bm_opis` LIKE '%". $szukaj ."%')");
	$ile_load = ($ile_load < 0 ? 0 : $ile_load);
	// zapytanie do db
	$zap = $db_bm->query2("SELECT * FROM `|prefix|bm_metaposty` WHERE $kategoria_KT AND $szukaj ORDER BY `id` DESC LIMIT $ile_load");

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
							<input type="checkbox" class="bm-pcheckbox" bm-data="kt">
							<span class="checkbox "></span>
						</label>
					</th>
					<td class="tsr-display-block-2 tsr-width-100-2 tsr-p-5px" bm-data="bm-nazwa">
						Nazwa
					</td>
					<td class="tsr-display-block-2 tsr-width-100-2 tsr-p-5px" bm-data="bm-skr-nazwa">
						Skr.Nazwa
					</td>
					<td class="tsr-width-40 tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-opis">
						Opis
					</td>
					<td class="tsr-width-100px tsr-width-100-2 tsr-display-block-2 tsr-p-5px" bm-data="bm-kt">
						typ
					</td>
				</tr>
			</thead>
			<tbody class="tsr-width-100 tsr-border-bottom-solid-black-1">
		';

		for ($i=0; $i < $zap["num_rows"]; $i++) { 
			echo '
				<tr class="tsr-color-table bm-row-dl" bm-row-data="'. $i .'">
					<th bm-data="bm-r-id"> 
						<label class="checkboxs">
							<input type="checkbox" class="bm-checkbox" bm-data="'. $zap[$i]["id"] .'">
							<span class="checkbox "></span>
						</label>
					</th>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-nazwa"> '. $zap[$i]["bm_nazwa"] .' 
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
								<a href="admin-edit-kategoria-tag.php?edit='. $zap[$i]["id"] .' ">
									Edytuj	
								</a>
							</section>
						</section>
					</td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-skr-nazwa"> '. $zap[$i]["bm_skr_nazwa"] .' </td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-opis"> '. $zap[$i]["bm_opis"] .' </td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-kt"> '. $zap[$i]["bm_KT"] .' </td>
				</tr>
			';
		}

		echo '
				</tbody>
			</table>

			<section class="tsr tsr tsr-mt-20">
				<input type="submit" value="Wykonaj akcję!" class="input buttom" action="kategoria-tag-delete" id="blackmin_action"/>
			</section>
		';

	}