<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyświetlania wszystkich plików wysłanych na serwer i zażądzanie nimi
	
	Black Min cms,
	
	#plik: 2.0
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
	// renderowanie strony która odpowiada za wszystkie pliki na serwerze
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Dysk - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Dysk - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0 load-file-db">
					
					<form accept-charset="UTF-8"  action="all-dysk" method="post" id="blackminload">	
						<section class="tsr tsr-p-5px">
							<section class="col-ms30 col-ms20-5 col-ms20-4 col-ms75-3 col-ms75-2 col-ms100-1 tsr-p-5px">
								<select name="roszerzenie" id="roszerzenie">
									<option value="all">wszystkie Roszerzenia</option>
									<option value="img">grafika</option>
									<option value="film">filmy</option>
									<option value="audio">audio</option>
									<option value="txt">tekstowe</option>
								</select>
							</section>
							<section class="col-ms10 col-ms10-5 col-ms10-4 col-ms25-3 col-ms25-2 col-ms100-1 tsr-p-5px">
								<input type="number" name="ile_load" id="ile_load" class="input" value="25" placeholder="ile załadować?">
							</section>
							<section class="col-ms30 col-ms35-5 col-ms35-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px">
								<section class="tsr tsr-position-relative">
									<input type="search" name="folder" id="folder" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Folder">
									<section type="search" name="folders" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10 load_post" id="load_post">
										<img src="<?php echo BM_SETTINGS["url_server"];?>pliki/ikony/szukaj.png">
									</section>
								</section>
							</section>
							<section class="col-ms30 col-ms35-5 col-ms35-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px">
								<section class="tsr tsr-position-relative">
									<input type="search" name="szukaj" id="szukaj" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj">
									<section type="search" name="szukaj" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10 load_post" id="load_post">
										<img src="<?php echo BM_SETTINGS["url_server"];?>pliki/ikony/szukaj.png">
									</section>
								</section>
							</section>
						</section>
					</form>	
					<section class="tsr" id="blackmin_change_action">
						<section class="col-ms25 col-ms25-3 col-ms100-2 col-ms100-1 tsr-p-5px akcja-post">
							<select name="akcja" id="akcja">
								<option value="usun">usuń</option>
								<option value="rename">ustaw nazwę folderu</option>
							</select>
						</section>
						<section class="col-ms75 col-ms75-3 col-ms100-2 col-ms100-1" id="bm_input_rename" style="display:none;">
							<section class="col-inp-25 tsr-p-10px fs-60 " >
								<span class="tsr-vertical-align-sub">
									Zmień folder pliku:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="folder_zmien" id="folder_zmien" class="input" placeholder="abc" autocomplete="off"/>
							</section>
						</section>	
					</section>
					
					<section class="tsr checkall" id="blackminload_container">							
					</section>	

					<script type="text/javascript">
						$(document).ready(function(){					

							// sprawdzenie czy użytkownik wybrał akcje zmień folder pliku
							// jeeli wybrał to pokazujemy diva do wpisania nowej nazwy folderu
							$('#akcja').change(function(){
								var status_akcja = $('#akcja').val();
								
								if (status_akcja == "rename") {
									$("#bm_input_rename").css("display", "block");
								}else{
									$("#bm_input_rename").css("display", "none");
								}
								
							});	
						});	
					</script>					

				</section>
			</section>
		</section>
	</main>

	<?php require_once "admin-stopka.php"; ?>

</body>
</html>