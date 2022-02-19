<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy opsługi połączeń cms'a
	
	Black Min cms,
	
	#plik: 1.2
*/


	// ładowanie jądra black mina
	require_once "black-min.php";
	
	// towierdzanie indefikatora serwera
	//require_once "laduj/class-timonix-ttk.php";	
	// iniciowanie klasy token class-timonix-ttk
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Panel Admina - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
					Start z Black Min CMS
					<section class="tsr fs-70">
						O to pomocne linki:
					</section>
					<section class="tsr tsr-mt-20">
						<section class="col-3 fs-80">
							<section class="tsr">
								Start
							</section>	
							<section class="tsr tsr-mt-10"></section>
							<section class="tsr-button tsr-normal">
								<a href="admin-add-post.php"> 
									Dodaj Post
								</a>
							</section>	
						</section>
						<section class="col-3 fs-80">
							<section class="tsr">
								Na Start
							</section>	
							<section class="tsr fs-80">
								<a href="admin-all-motyw.php">Motyw</a>
							</section>
							<section class="tsr fs-80">
								<a href="admin-ustawienia-serwera-black-min.php">Ustawienia</a>
							</section>
							<section class="tsr fs-80">	
								<a href="admin-all-plugin.php">Pluginy</a>
							</section>	
						</section>
						<!--<section class="col-3 fs-80">
							<section class="tsr">
								Inne
							</section>	
							<section class="tsr fs-80">	
								<a href="">Jak Korzystać Z Black Mina'a</a>
								<a href="">O Black Minie</a>
								<!--<a href="">BlackMin</a>--><!--
							</section>
						</section>-->
					</section>
				</section>
			</section>
			<section class="tsr tsr-mt-20">
				<section class="col-2 tsr-p-5px">
					<section class="tsr background-white tsr-p-10px">
						<section class="tsr-ma fs-80 l-0 tsr_Gl_Hall">
							Ostatni dodany post
						</section>
						<section class="lin"> 
						</section>		
						<section class="tsr-ma fs-60 l-0" style=" height: 125px;overflow: hidden;">
							<section class="fs-110">
								Tytuł posta: <?php echo LAST_POST[0]['tytul']; ?>
							</section>
							<section class="">
								Post dodał: <?php echo LAST_POST[0]['dodajacy']; ?> Dnia: <?php echo data_format(LAST_POST[0]['datetime'], BM_SETTINGS["bm_date"]. " " . BM_SETTINGS["bm_time"]); ?>
							</section>
							<section class="fs-130">
								Treść posta: <?php echo LAST_POST[0]['tresc']; ?>
							</section>
							<section class="tsr r-0 fs-100 tsr-visable-hover">
								<section class="tsr-fr tsr-button tsr-visable-hover-element">
									<a href="admin-edit-post.php?edit=<?php echo LAST_POST[0]['id']; ?>">
										Edytuj post
									</a>
								</section>
								<section class="tsr-fr tsr-button tsr-visable-hover-element">
									<a href="<?php echo BM_SETTINGS["url_site"] . LAST_POST[0]['url']; ?>">
										Zobacz post
									</a>
								</section>
							</section>
						</section>	
					</section>
				</section>
			</section>
		</section>
	</main>

	<?php require_once "admin-stopka.php"; ?>

</body>
</html>