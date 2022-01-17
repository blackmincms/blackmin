<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyświetlania i ładowanie ustawień(opcji) danego pluginu do zmienienia
	
	Black Min cms,
	
	#plik: 1.2
*/


	require_once "black-min.php";
	
	// renderowanie strony która odpowiada za opcjie w pluginie
	
	// pobieranie zmienych z adresu url
	if(isset($_GET['pl'])){
		$pl_load = htmlspecialchars($_GET['pl']);
	}elseif(isset($_GET['plugin'])){
		$pl_load = htmlspecialchars($_GET['plugin']);
	}else{
		$pl_load = false;
	}
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Ustawienia Pluginu - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<header class="container-right">
		<div class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Ustawienia Pluginu - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0 ">
					
					<?php 
						if($pl_load == false){
					?>		
							<section class="tsr fs-130 tsr-fr tsr-button tsr-error">Wystąpił błąd podczas ładowania Pliku Konfiguracyjnego pluginu!</section>
					<?php	
						}else{
							$plik = "../../a/pluginy/$pl_load/plugin-settings.php"; //deklaracja ścieżki do pliku
							$test = file_exists($plik); //sprawdzenie czy plik istnieje
							if (!$test) //jeżeli plik nie istnieje (zmienna $test=FALSE) 
							{
								echo '<section class="tsr fs-130 tsr-fr tsr-button tsr-error">Brak Pliku Konfiguracyjnego</section>'; //informacja o braku pliku na serwerze
							}else{
								require_once "../../a/pluginy/$pl_load/plugin-settings.php";
							}						
						}
					?>
						
				</section>
			</section>
		</div>
	</header>

	<?php require_once "admin-stopka.php"; ?>

	<script>
	$(document).ready(function() { 
		console.clear()
	});
	</script>	

</body>
</html>