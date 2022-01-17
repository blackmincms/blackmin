<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyświetlania wszystkich plików wysłanych na serwer i zażądzanie nimi
	
	Black Min cms,
	
	#plik: 1.2
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
					
					<form accept-charset="UTF-8"  action="" method="post" id="data-add-post">	
						<section class="tsr tsr-p-5px tsr-mb-10">
							<section class="col-ms25 tsr-p-5px">
								<select name="roszerzenie">
									<option value="all">wszystkie Roszerzenia</option>
									<option value="img">grafika</option>
									<option value="film">filmy</option>
									<option value="audio">audio</option>
									<option value="txt">tekstowe</option>
									<!--<option value="rar">Skompresowane</option>-->
								</select>
							</section>
							<section class="col-ms10 tsr-p-5px">
								<input type="number" name="ile_load" class="input" value="25" placeholder="ile załadować?">
							</section>
							<section class="col-ms30 tsr-p-5px">
								<section class="tsr tsr-position-relative">
									<input type="search" name="folder" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Folder">
									<section type="search" name="folders" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10 load_post" id="load_post">
										<img src="<?php echo $ustawienia_bm["bm_url_server"];?>pliki/ikony/szukaj.png">
									</section>
								</section>
							</section>
							<section class="col-ms30 tsr-p-5px">
								<section class="tsr tsr-position-relative">
									<input type="search" name="szukaj" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj">
									<section type="search" name="szukaj" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10 load_post" id="load_post">
										<img src="<?php echo $ustawienia_bm["bm_url_server"];?>pliki/ikony/szukaj.png">
									</section>
								</section>
							</section>
						</section>
						<section class="tsr">
							<section class="col-ms25 tsr-p-5px akcja-post">
								<select name="akcja" id="rename_folder">
									<option value="usun">usuń</option>
									<option value="rename_folder">ustaw nazwę folderu</option>
								</select>
							</section>
							<section class="col-inp-75" id="zmien" style="display:none;">
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
					
					<section class="tsr checkall" id="post_container">		
					
					</section>
					
					<!-- Zmienianie wyświetlania plików -->	

					<script type="text/javascript">
					$(document).ready(function(){					

						// sprawdzenie czy użytkownik wybrał akcje zmień folder pliku
						// jeeli wybrał to pokazujemy diva do wpisania nowej nazwy folderu
						$('#rename_folder').change(function(){
							var status_akcja = $('#rename_folder').val();

							if (status_akcja == "rename_folder") {
								$("#zmien").css("display", "block");
							}else{
								$("#zmien").css("display", "none");
							}
							
						});	
	
						$('.load_post').click('submit', function(evt1){
							evt1.preventDefault();
							var roszerzenie = $('select[name="roszerzenie"]').val();
							var ile_load = $('input[name="ile_load"]').val();
							var szukaj = $('input[name="szukaj"]').val();
							var folder = $('input[name="folder"]').val();
							
							$.ajax({
								type:"POST",
								url:"laduj/all-dysk.php",
								data:{
									roszerzenie:roszerzenie,
									ile_load:ile_load,
									szukaj:szukaj,
									folder:folder,
								}
							})
							.done(function(info){
								$('#post_container').text("");
								$('#post_container').append(info);
								
							})
							.fail(function(){
								alert("Wystąpił błąd. Spróbuj ponownie później");
							});
						});
						
						function evt(){
							var roszerzenie = $('select[name="roszerzenie"]').val();
							var ile_load = $('input[name="ile_load"]').val();
							var szukaj = $('input[name="szukaj"]').val();
							var folder = $('input[name="folder"]').val();
							
							var ile_load = "25";
							
							$.ajax({
								type:"POST",
								url:"laduj/all-dysk.php",
								data:{
									roszerzenie:roszerzenie,
									ile_load:ile_load,
									szukaj:szukaj,
									folder:folder,
								}
							})
							.done(function(info){
								$('#post_container').append(info);
							})
							.fail(function(){
								alert("Wystąpił błąd. Spróbuj ponownie później");
							});
						};
						
						evt();
						
					})
					</script>
					
				</section>
			</section>
		</section>
	</main>

	<?php require_once "admin-stopka.php"; ?>

</body>
</html>