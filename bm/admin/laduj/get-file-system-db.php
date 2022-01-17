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

?>

	<form accept-charset="UTF-8"  action="" method="post" bm-action="<?php if(isset($_POST["location_container"])){ echo $_POST["location_container"]; }else{ echo "null"; } ?>" bm-multiply="<?php if(isset($_POST["multiply"])){ echo $_POST["multiply"]; }else{ echo "true"; } ?>" bm-file-type="<?php if(isset($_POST["file_type"])){ echo $_POST["file_type"]; }else{ echo "all"; } ?>"bm-obiect-type="<?php if(isset($_POST["aquay_obiect_type"])){ echo $_POST["aquay_obiect_type"]; }else{ echo "text"; } ?>" class="tsr-mb-20 tsr-display-flex-root bm-get-file-system-db">	
		<section class="tsr tsr-p-5px tsr-mb-10 tsr-display-flex col-flex">
			<section class="tsr-p-5px col-flex-2 col-fl-50-3 col-fl-100-2">
				<select name="roszerzenie">
					<option value="all">wszystkie Roszerzenia</option>
					<option value="image">grafika</option>
					<option value="video">filmy</option>
					<option value="audio">audio</option>
					<option value="text">tekstowe</option>
					<!-- <option value="compressed">Skompresowane</option> -->
				</select>
			</section>
			<section class="tsr-p-5px col-flex-1 tsr-width-min-content col-fl-50-3 col-fl-100-2">
				<input type="number" name="ile_load" class="input" value="<?php echo $get_ustawienia_bm["bm_default_load_upload_file"]; ?>" placeholder="ile załadować?">
			</section>
			<section class="col-ms30 tsr-p-5px col-fl-50-3 col-fl-100-2">
				<section class="tsr tsr-position-relative">
					<input type="search" name="folder" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Folder">
					<section type="search" name="folders" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10 load_post_bm">
						<img src="../../pliki/ikony/szukaj.png">
					</section>
				</section>
			</section>
			<section class="col-ms30 tsr-p-5px col-fl-50-3 col-fl-100-2">
				<section class="tsr tsr-position-relative">
					<input type="search" name="szukaj" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available" placeholder="Szukaj">
					<section type="search" name="szukaj" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10 load_post_bm">
						<img src="../../pliki/ikony/szukaj.png">
					</section>
				</section>
			</section>
		</section>
	
		<section class="tsr">
			<section class="col-ms25 col-ms100-2 col-ms100-1 tsr-p-5px akcja-post">
				<select name="akcja_pliku" class="bm-rename-folder">
					<option value="add_media">dodaj media</option>
					<option value="delete">usuń</option>
					<option value="rename_folder">ustaw nazwę folderu</option>
				</select>
			</section>
			<section class="col-ms75 col-ms100-2 col-ms100-1 akcja_pliku_zmienazwe" style="display:none;">
				<section class="col-inp-25 tsr-p-10px fs-60 " >
					<span class="tsr-vertical-align-sub">
						Zmień folder pliku:
					</span>
				</section>
				<section class="col-inp-75 tsr-p-10px fs-90" >
					<input type="text" name="folder_zmien" class="input" placeholder="abc" autocomplete="off"/>
				</section>
			</section>	
		</section>
	</form>
	<!-- ładowanie plików -->
	<div class="tsr-mt-20 tsr-clear-both">
		<section class="aquay-laduj-file tsr-mb-20 tsr-display-flex-root bm-checkbox-container bm-file-system-db">
			<section class="tsr-alert tsr-alert-info">Ładowanie danych</section>
		</section>
	</div>
	
	<script language="JavaScript" type="text/javascript">
		$(document).ready(function(){	
			// zaznaczenie odpowiedniej opcji
			selectedOption($(".bm-get-file-system-db").find('select[name="roszerzenie"]'), '<?php if(isset($_POST["file_type"])){ echo $_POST["file_type"]; }else{ echo "all"; } ?>');
			changeDisabled('<?php if(isset($_POST["file_type"])){ echo $_POST["file_type"]; }else{ echo "all"; } ?>', $(".bm-get-file-system-db").find('select[name="roszerzenie"]'));
			changeMultiply($(".bm-file-system-db"), ".bm-checkbox", <?php if(isset($_POST["multiply"])){ echo $_POST["multiply"]; }else{ echo "true"; } ?>);
			sentForm($(".bm-get-file-system-db"), ".load_post_bm");
			// zmienne przechowywują konfiguracje ładowanych danych
			let r = ($('select[name="roszerzenie"]').val() != undefined ? $('select[name="roszerzenie"]').val() : "all"),
				i = ($('input[name="ile_load"]').val() != undefined ? $('input[name="ile_load"]').val() : "25"),
				f = ($('input[name="folder"]').val() != "" ? $('input[name="folder"]').val() : "null"),
				s = ($('input[name="szukaj"]').val() != "" ? $('input[name="szukaj"]').val() : "null"),
				a = ($('select[name="akcja_pliku"]').val() != undefined ? $('select[name="akcja_pliku"]').val() : "add_media");
			// ładowanie plików wgranych na serwer	
			load_upload_file_db(i, r, <?php if(isset($_POST["multiply"])){ echo $_POST["multiply"]; }else{ echo "true"; } ?>);
		});
	</script>