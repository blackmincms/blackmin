<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy Aktulizacji wszystkich dodatków i rdzenia(core bm)[updating assets and core black min cms]
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
	require_once "laduj/class-camparet-xray.php";
	require_once "laduj/class-db.php";
	require_once "laduj/class-aktulizacja.php";
	// otwieranie nowego połączenia (iniciowanie klasy odpowiedzialenj za sprawdzanie i aktulizowanie black min'a)
	$aupdate_blackmin = new blackmin_aktulizacja;
	// pobieranie danych do sprawdzenia aktulizacjiach
	$aupdate_blackmin->get_info_blackmin(url_serwer_bm(), version_bm(), version_db_bm(), private_aupt_bm());
	
	// pobieranie informacji o danej akcji
	if(isset($_GET['sp'])){
		$akcjia = $_GET['sp'];
	}else{
		$akcjia = "null";
	}
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Admin Aktulizacja - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Panel Aktulizacja - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<?php if($akcjia != "aktulizacja_blackmina"){?>
				<section class="tsr fs-90 l-0">
					Dostępne Aktulizacje....
					<section class="tsr ">
						<section class="tsr fs-70 ">
							Dostępne aktulizacje rdzenia black min'a
						</section>
						<section class="tsr tsr-mt-20">
							<section class="tsr-button tsr-normal sprawdz-update-blackmin">
								<a href="<?php echo url_serwer_bm();?>bm/admin/admin-aktulizacja.php?sp=sprawdz_update">
									Sprawdź Dostępne Aktulizacje BM
								</a>
							</section>
							<section class="tsr tsr-mt-10 fs-70">
								<?php 
									if($akcjia == "sprawdz_update" || "null"){
										echo $aupdate_blackmin->get_aktulizacjia_blackmin_info(); // wyśietlanie informacji o dostępnych aktulizacjiach
									}
								?>
							</section>

							<section class="tsr tsr-mt-10 fs-70">
								Obecnie używasz: V.<?php echo version_bm();?>  wersji black min'a i V.<?php echo version_db_bm();?> wersji bazy danych!
							</section>
						</section>
					</section>
				</section>
				<?php } ?>
				<?php if($akcjia == "aktulizacja_blackmina"){?>
				<section class="tsr fs-90 l-0">
					Pobieranie Aktulizacji....
					<section class="tsr ">
						<section class="tsr fs-70 ">
							z adresu: <?php echo $_SESSION['black_min_update']; ?>
						</section>
						<section class="tsr fs-60 tsr-mt-10">
							Wykonaj kopię bezpieczeństwa black mia przed aktualizacją!
						</section>
						<section class="tsr tsr-mt-20">
							<section class="tsr-button tsr-normal sprawdz-update-blackmin">
								<a href="<?php echo url_serwer_bm();?>bm/admin/admin-aktulizacja.php?sp=sprawdz_update">
									Sprawdź Dostępne Aktulizacje BM
								</a>
							</section>

							<section class="tsr tsr-p-10px tsr-mt-10 tsr-mb-10">
								<section class="tsr-alert tsr-alert-info blackmin-pobierz-nowa-wersjie">
									Rozpoczęto Pobieranie Nowej Wersji Black min'a
								</section>
								<?php $aupdate_blackmin->update_blackmin();  ?>
							</section>

							<section class="tsr tsr-mt-10 fs-70">
								Obecnie używasz: V.<?php echo version_bm();?>  wersji black min'a i V.<?php echo version_db_bm();?> wersji bazy danych!
							</section>
						</section>
					</section>
				</section>
				<?php } ?>
			</section>
		</section>
	</main>

	<?php require_once "admin-stopka.php"; ?>

	<script>
	
	$('.sprawdz-update-blackmin').click('submit', function(){
		var szukaj_post = $('input[name="szukaj_post"]').val();
		location.href="<?php echo url_site_bm();?>?szukaj_post="+szukaj_post+"";
		
	});	
	
	$(document).ready(function() { 
		console.clear()
	});
	</script>	

</body>
</html>