<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyciągania z bazy wszystkich plików wgranych na serwer
	
	Black Min cms,
	
	#plik: 2.0
*/

	// ładowanie jądra black mina
	require_once "../black-min.php";

	// odbieranie od klienta metodą post informacji na temat poszukiwanych rekordów w bazie danych
	
	if (isset ($_POST['roszerzenie'])){
		$roszerzenie = $_POST['roszerzenie'];
	}else{
		$roszerzenie = "all";
	}
	
	if (isset ($_POST['folder'])){
		$folder = $_POST['folder'];
	}else {
		$folder = "";
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
	
	$roszerzenie = $db_bm->valid($roszerzenie);
	$folder = $db_bm->valid($folder);
	$szukaj = $db_bm->valid($szukaj);
	$ile_load = $db_bm->valid($ile_load);
	
	$roszerzenie = ($roszerzenie == "all" ? "`bm_typ_pliku` LIKE '%%'" : "`bm_typ_pliku` LIKE '". $roszerzenie ."'");
	$folder = (strlen($folder) === 0 ? "`bm_folder` LIKE '%%'" : "`bm_folder` LIKE '". $folder ."'");
	$szukaj = (strlen($szukaj) === 0 ? "(`bm_nazwa` LIKE '%%' OR `bm_nazwa_zmiany` LIKE '%%' OR `bm_opis` LIKE '%%')" : "(`bm_nazwa` LIKE '%". $szukaj ."%' OR `bm_nazwa_zmiany` LIKE '%". $szukaj ."%' OR `bm_opis` LIKE '%". $szukaj ."%')");
	$ile_load = ($ile_load < 0 ? 0 : $ile_load);
	// zapytanie do db
	$zap = $db_bm->query2("SELECT `|prefix|bm_filemeta`.*, `|prefix|bm_filemeta`.`|prefix|bm_autor` as 'autor_id' , `|prefix|bm_uzytkownicy`.`nick` as 'autor' FROM `bm_filemeta` LEFT JOIN `|prefix|bm_uzytkownicy` ON `|prefix|bm_filemeta`.`bm_autor` = `|prefix|bm_uzytkownicy`.`id` WHERE $roszerzenie AND $folder AND $szukaj ORDER BY `id` DESC LIMIT $ile_load");

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
							<input type="checkbox" class="bm-pcheckbox" bm-data="dysk">
							<span class="checkbox "></span>
						</label>
					</th>
					<td class="tsr-width-35 tsr-width-30-5 tsr-display-block-2 tsr-p-5px" bm-data="bm-tytul">
						Pełna Nazwa/Pełna Orginalna Nazwa
					</td>
					<td class="tsr-width-150px tsr-display-block-2 tsr-p-5px" bm-data="bm-dodajacy">
						Autor
					</td>
					<td class="tsr-width-30 tsr-width-25-5 tsr-display-block-2 tsr-p-5px" bm-data="bm-roszerzenie">
						Opis
					</td>
					<td class="tsr-width-100px tsr-width-150px-3 tsr-display-block-2 tsr-p-5px" bm-data="bm-kategoria">
						Folder
					</td>
					<td class="tsr-width-100px tsr-display-block-2 tsr-p-5px" bm-data="bm-tagi">
						Rozszerzenie
					</td>
					<td class="tsr-width-100px tsr-width-50px-3 tsr-display-block-2 tsr-p-5px" bm-data="bm-datetime">
						Data Opublikowania
					</td>
				</tr>
			</thead>
			<tbody class="tsr-width-100 tsr-border-bottom-solid-black-1">
		';

		for ($i=0; $i < $zap["num_rows"]; $i++) {
			$data = ($zap[$i]["bm_datetime_wgrania"] == $zap[$i]["bm_datetime_zmiany"] ? $zap[$i]["bm_datetime_wgrania"] : ("Edytowano: " . $zap[$i]["bm_datetime_zmiany"])); 
			$opis = (trim($zap[$i]["bm_opis"]) == "" ? "brak" : $zap[$i]["bm_opis"]);
			$miniaturka = ($zap[$i]["bm_miniaturka"] == "null" ? "" : ('<img src="'. $zap[$i]["bm_miniaturka"] .'" alt="M" title="'. $zap[$i]["bm_nazwa"] .'" class="img tsr-miniaturka tsr-vertical-align-middle tsr-width-75px tsr-mr-10" loading="lazy">'));
			echo '
				<tr class="tsr-color-table bm-row-dl" bm-row-data="'. $i .'">
					<th bm-data="bm-r-id"> 
						<label class="checkboxs">
							<input type="checkbox" class="bm-checkbox" bm-data="'. $zap[$i]["id"] .'">
							<span class="checkbox "></span>
						</label>
					</th>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-tytul"> ' . $miniaturka . $zap[$i]["bm_nazwa"] .' 
					<section class="tsr fs-80 tsr-mt-20">'. $zap[$i]["bm_nazwa_zmiany"] .'</section>
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
								<a href="admin-edit-dane-pliku.php?edit='. $zap[$i]["id"] .' ">
									Edytuj	
								</a>
							</section>
						</section>
					</td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-dodajacy"> '. $zap[$i]["autor"] .' </td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-bm_opis"> '. $opis .' </td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-bm_folder"> '. $zap[$i]["bm_folder"] .' </td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-bm_typ_pliku"> '. $zap[$i]["bm_typ_pliku"] .' </td>
					<td class="tsr-display-block-2 tsr-p-5px tsr-word-break" bm-data="bm-kategoria_post"> '. $data .' </td>
				</tr>
			';
		}

		echo '
				</tbody>
			</table>

			<section class="tsr tsr tsr-mt-20">
				<input type="submit" value="Wykonaj akcję!" class="input buttom" action="plik-usun" rename="plik-zmien-folder" id="blackmin_action"/>
			</section>
		';
	}