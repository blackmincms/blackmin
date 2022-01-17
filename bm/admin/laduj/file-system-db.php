<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do pobierania wszystkich plików z bazy danych wgranych na serwer
	
	#Zawannsowane szukanie
	
	Black Min cms,
	
	#plik: 1.2.9
*/

	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// sprawdzanie czy klassa db istnieje
	if(class_exists("db_bm")){
		// sprawdzanie czy ustawienia do ustawienia istnieją
		if(isset($_POST["load"]) AND isset($_POST["file_type"]) AND isset($_POST["directory"]) AND isset($_POST["file"])){
			// sprawdzanie czy dane so szukania są ustawione
			$file_type = $db_bm->valid($_POST["file_type"]);
			if($file_type == "all"){
				$file_type = "";
			}elseif($file_type == "image"){
				$file_type = "image";
			}elseif($file_type == "video"){
				$file_type = "video";
			}elseif($file_type == "audio"){
				$file_type = "audio";
			}elseif($file_type == "text"){
				$file_type = "text";
			}else{
				$file_type = "";
			}
			
			$file = $db_bm->valid($_POST["file"]) == "null" ? "" : $db_bm->valid($_POST["file"]);
			$directory = $db_bm->valid($_POST["directory"]) == "null" ? "" : $db_bm->valid($_POST["directory"]);
			
			$db_bm->db_error(false);
			$db_bm->db_error_developers(false);
			
			// pobieranie danych z db
			$w = $db_bm->query2("SELECT * FROM `_prefix_bm_filemeta` WHERE `bm_typ_pliku` LIKE '%".$file_type."%' AND (`bm_nazwa` LIKE '%".$file."%' OR `bm_opis` LIKE '%".$file."%') AND `bm_folder` LIKE '%".$directory."%' ORDER BY `_prefix_bm_filemeta`.`id` DESC LIMIT " . $db_bm->valid($_POST["load"]) . "");
			// sprawdzanie czy zwrucono błąd zapytania
			if($w === false){
				echo '<section class="tsr tsr-alert tsr-alert-error">Kod błędu - [ERROR_SQL_QUERY] -  Błąd serwera! </section>';
				exit();
			}
			// pobieranie nicku po id 
			$u_replace = $db_bm->query2("SELECT `id`, `nick`  FROM `_prefix_bm_uzytkownicy` WHERE `id` IN (".$db_bm->super_unique($w,"bm_autor", true).")");
			// sprawdzanie czy zwrucono błąd zapytania
			if($u_replace === false AND $w["num_rows"] !== 0){
				echo '<section class="tsr tsr-alert tsr-alert-error">Kod błędu - [ERROR_SQL_QUERY] -  Błąd serwera! </section>';
				exit();
			}
			// zamienianie id użytkownika na nick`
			$w_copy = ($w);
			array_shift($w_copy);
			$col_rep = $db_bm->replace_collumn($w_copy, "bm_autor", $u_replace, "id", "nick", true);
			// sprawdzanie czy zwrucono błąd zapytania
			if($col_rep === false AND $w["num_rows"] !== 0){
				echo '<section class="tsr tsr-alert tsr-alert-error">Kod błędu - [ERROR_NOT_DATA_AVALIABLE] -  Błąd serwera! </section>';
				exit();
			}			
			
			// sprawdzanie czy istnieją rekordy do wyświetlenia
			if($w["num_rows"] !== 0) {
			
			// rozpoczynanie nagłowka tabeli
ECHO <<<END
	<section class="tsr bm-file-table fs-80">
		<section class="tsr tsr col-flex-3 tsr-display-flex tsr-flex-aligin-item-center tsr-p-5px tsr-border-solid-bottom tsr-border-solid-top tsr-border-bottom-2px fs-80">
			<section class="col-fl-checkbox"> 
				<label class="checkboxs">
					<input type="checkbox" class="bm-pcheckbox" >
					<span class="checkbox bm-pcheckbox"></span>
				</label>
			</section>
			<section class="col-flex-3 col-fl-100-3 col-fl-30-5 col-fl-30-static tsr-p-5px">Pełna Nazwa/Pełna Orginalna Nazwa</section>
			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-10-static tsr-p-5px">Autor</section>
			<section class="col-flex-2 col-fl-100-3 col-fl-30-5 col-fl-30-static tsr-p-5px">Opis</section>
			<section class="col-flex-1 col-fl-100-3 col-fl-20-5 col-fl-20-static tsr-p-5px">Folder</section>
			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-10-static tsr-p-5px">Data Dodania</section>
		</section>
		<section class="col-fl-row">
END;
				// pętla przetważa dane o plikach
				for($i = 0; $i < $w["num_rows"]; $i++){
					$id = $col_rep[$i]["id"];
					$bm_autor = $col_rep[$i]["bm_autor"];
					$bm_nazwa = $col_rep[$i]["bm_nazwa"];
					$bm_nazwa_zmiany = $col_rep[$i]["bm_nazwa_zmiany"];
					$bm_datetime_wgrania = $col_rep[$i]["bm_datetime_wgrania"];
					$bm_datetime_zmiany = $col_rep[$i]["bm_datetime_zmiany"];
					$bm_opis = $col_rep[$i]["bm_opis"];
					$bm_typ_pliku = $col_rep[$i]["bm_typ_pliku"];
					$bm_miniaturka = $col_rep[$i]["bm_miniaturka"];
					$bm_folder = $col_rep[$i]["bm_folder"];
					$bm_sciezka = $col_rep[$i]["bm_sciezka"];

					// sprawdzanie czy edytowano post
					$bm_datetime_wgrania = ($bm_datetime_wgrania === $bm_datetime_zmiany ? $bm_datetime_wgrania : "Edytowano: \n" . $bm_datetime_zmiany);
					// sprawdzanie czy istnieje miniaturka
					$bm_miniaturka = ($bm_miniaturka === "null" ? $ustawienia_bm["bm_url_server"]."pliki/banner/placeholder.jpg" : $bm_miniaturka);
					// sprawdzanie czy istnieje opis
					$bm_opis = ($bm_opis === "" ? "Brak opisu" : $bm_opis);
					// sprawdzanie czy istnieje folder domysny
					$bm_folder = ($bm_folder === "" ? "domyśny" : $bm_folder);
					
ECHO <<<END
			<section class="tsr col-flex-3 tsr-display-flex tsr-flex-aligin-item-center bm-file-record tsr-p-5px fs-70 tsr-border-bottom-solid tsr-algin-left tsr-algin-center-3" bm-file-type="$bm_typ_pliku">
				<section class="col-fl-checkbox"> 
					<label class="checkboxs">
						<input type="checkbox" class="bm-checkbox" tsr-data="$id">
						<span class="checkbox bm-checkbox"></span>
					</label>
				</section>		
				<section class="col-flex-3 col-fl-100-3 col-fl-30-5 col-fl-30-static tsr-p-5px">
				
					<img src="$bm_miniaturka" title="$bm_nazwa_zmiany" alt="$bm_nazwa" class="img tsr-miniaturka tsr-vertical-align-middle tsr-width-100px tsr-width-250px-3" bm-sciezka="$bm_sciezka" bm-grafika="$bm_miniaturka">
					<span class="tsr-display-block-3">$bm_nazwa</span>
					
					<section class="tsr fs-80 tsr-mt-20">$bm_nazwa_zmiany</section>
					
					<section class="tsr r-0 fs-100 tsr-display-block-3 tsr-visibility-visable-3 tsr-visable-hover">
						<section class="tsr-fr tsr-button red tsr-display-block-3 tsr-visibility-visable-3 tsr-visable-hover-element delete-post">
							<a href="#post_delete_" rel="modal:open">
								Usuń plik
							</a>											
						</section>
						<section class="tsr-fr tsr-button tsr-display-block-3 tsr-visable-hover-element tsr-visibility-visable-3 edit-post">
							<a href="admin-edit-dane-pliku.php?edit=d">
								Edytuj dane
							</a>	
						</section>
						<section class="tsr-fr tsr-button tsr-display-block-3 tsr-visibility-visable-3 tsr-visable-hover-element edit-post">
							<a href="#post_zobacz_id" rel="modal:open">
								Zobacz plik
							</a>	
						</section>
					</section>				
				
				</section>
				<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-10-static tsr-p-5px tsr-algin-center">$bm_autor</section>
				<section class="col-flex-2 col-fl-100-3 col-fl-30-5 col-fl-30-static tsr-p-5px tsr-algin-center">$bm_opis</section>
				<section class="col-flex-1 col-fl-100-3 col-fl-20-5 col-fl-20-static tsr-p-5px tsr-algin-center">$bm_folder</section>
				<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-10-static tsr-p-5px">$bm_datetime_wgrania</section>
			</section>
END;
				}
			// kończenie nagłowka tabeli
ECHO <<<END
		</section>
		<section class="ts tsr col-flex-3 tsr-display-flex tsr-flex-aligin-item-center tsr-p-5px tsr-border-solid-bottom tsr-border-solid-top tsr-border-top-2px fs-80">
			<section class="col-fl-checkbox"> 
				<label class="checkboxs ">
					<input type="checkbox" class="bm-pcheckbox">
					<span class="checkbox bm-pcheckbox"></span>
				</label>
			</section>		
			<section class="col-flex-3 col-fl-100-3 col-fl-30-5 col-fl-30-static tsr-p-5px">Pełna Nazwa/Pełna Orginalna Nazwa</section>
			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-10-static tsr-p-5px">Autor</section>
			<section class="col-flex-2 col-fl-100-3 col-fl-30-5 col-fl-30-static tsr-p-5px">Opis</section>
			<section class="col-flex-1 col-fl-100-3 col-fl-20-5 col-fl-20-static tsr-p-5px">Folder</section>
			<section class="col-flex-1 col-fl-100-3 col-fl-10-5 col-fl-10-static tsr-p-5px">Data Dodania</section>
		</section>
		<section class="tsr-fl tsr tsr-mt-20 tsr-records-submit">
			<button type="button" class="input button" id="action_file_system_db">Wykonaj akcjie</button>
		</section>		
	</section>
END;
		
			}else{
				echo '<section class="tsr-alert tsr-alert-info">Brak plików do wyświetlenia!</section>';
			}		
		}else{
			echo '<section class="tsr-alert tsr-alert-error">[ERROR_IN_DATA_TRANSFER] - Bład połączenia z bazą danych !</section>';
		}
	}else{
		echo '<section class="tsr-alert tsr-alert-error">[ERROR_LOAD_FUNCTION_DATABASE] - Bład połączenia z bazą danych !</section>';
	}

?>
