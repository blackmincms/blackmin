<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyświetlania wszystkich postów i zarządzanie nimi
	
	Black Min cms,
	
	#plik: 2.0
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
	// renderowanie strony która odpowiada za wszystkie posty
	
?>

<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Wszystkie Posty - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Wszystkie posty - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0 ">
					
					<form accept-charset="UTF-8"  action="all-post" method="post" id="blackminload">	
						<section class="tsr tsr-p-5px tsr-mb-10">
							<section class="col-ms20 col-ms20-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px">
								<select name="typ" id="typ">
									<option value="all">wszystkie kategorie</option>
									<option value="post">zwykły post</option>
									<option value="info">informacja</option>
									<option value="wazne_info">ważna informacja</option>
									<option value="ostrzezenie">ostrzeżenie</option>
									<option value="najwazniejsze_info">najważniejsza informacja</option>
								</select>
							</section>
							<section class="col-ms20 col-ms20-4 col-ms50-3 col-ms50-2 col-ms100-1 tsr-p-5px">
								<select name="status" id="status">
									<option value="all">każdy status</option>
									<option value="public">Publiczny</option>
									<option value="private">Prywatny</option>
									<option value="protect_password" >Zabezpieczony hasłem</option>
									<option value="szkic" >szkic</option>
								</select>
							</section>
							<section class="col-ms15 col-ms10-4 col-ms15-3 col-ms20-2 col-ms100-1 tsr-p-5px">
								<input type="number" name="ile_load" class="input" value="<?php echo BM_SETTINGS["bm_default_load_post"];?>" placeholder="ile załadować?">
							</section>
							<section class="col-ms45 col-ms50-4 col-ms85-3 col-ms80-2 col-ms100-1 tsr-p-5px">
								<section class="tsr tsr-position-relative">
									<input type="search" name="szukaj" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj">
									<section type="search" name="szukaj" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10" id="load_post">
										<img src="<?php echo BM_SETTINGS["url_server"];?>pliki/ikony/szukaj.png">
									</section>
								</section>
							</section>
						</section>
					</form>	
						
					<section class="tsr checkall" id="blackminload_container">							
					</section>			
				
				</section>
			</section>
		</section>
	</main>

	<?php require_once "admin-stopka.php"; ?>

</body>
</html>