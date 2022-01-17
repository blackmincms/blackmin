<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	W tym pliku znajduje się lewe menu admina
	
	Black Min cms,
	
	#plik: 1.2.5
*/

	// ładowanie jądra black mina
	require_once "black-min.php";

?>

	<header>	
       <div class="tsr-nav-menu-left tsr-nav-menu-left2 tsr-menu-background tsr-pt-10px" id="scrollbar1">
  
					<div class="tsr-button-menu-left" onclick="myFunction(this)">
						<div class="bar1"></div>
						<div class="bar2"></div>
						<div class="bar3"></div>
					</div>
					
				<?php  if($_SESSION['flaga'] >= 10 AND $_SESSION['flaga'] <=30 ){ ?>
					<section class="tsr menu-left">
						<a href="admin-panel.php">
							<section class="menu-item">
								<img src="<?php echo url_server_bm();?>pliki/ikony/home.png" class="tsr-nav-menu-img-left">
								<section class="tsr-nav-menu-size2"> panel </section>
							</section>
						</a>
						<?php  if($_SESSION['flaga'] >= 25 AND $_SESSION['flaga'] <=30 ){ ?>
							<section class="menu-left-hover">
								<a href="admin-aktulizacja.php">
									<section class="menu-left-submenu">
										Update
									</section>
								</a>
							</section>
						<?php };?>	
					</section>
					<section class="tsr menu-left">
						<a <?php  if($_SESSION['flaga'] >= 25 AND $_SESSION['flaga'] <=30 OR $_SESSION['flaga'] >= 10 AND $_SESSION['flaga'] <=14 ){ ?>href="admin-add-post.php"<?php };?>>
							<section class="menu-item">
								<img src="<?php echo url_server_bm();?>pliki/ikony/post.png" class="tsr-nav-menu-img-left">
								<section class="tsr-nav-menu-size2"> Dodaj Post </section>
							</section>
						</a>	
							<section class="menu-left-hover">
								<a href="admin-all-post.php">
									<section class="menu-left-submenu">
										Wszystkie Posty
									</section>
								</a>
								<?php  if($_SESSION['flaga'] >= 25 AND $_SESSION['flaga'] <=30 OR $_SESSION['flaga'] >= 10 AND $_SESSION['flaga'] <=14 ){ ?>
								<a href="admin-add-kategoria-tag.php">
									<section class="menu-left-submenu">
										Dodaj Kategoria Tag Posta
									</section>
								</a>
								<?php };?>
							<?php  if($_SESSION['flaga'] >= 15 AND $_SESSION['flaga'] <=30 ){ ?>	
								<a href="admin-all-kategoria-tag.php">
									<section class="menu-left-submenu">
										Kategoria Tag Posta
									</section>
								</a>
							<?php };?>
							</section>
					</section>
					<section class="tsr menu-left">
						<a <?php  if($_SESSION['flaga'] >= 15 AND $_SESSION['flaga'] <=30 ){ ?>	href="admin-dysk.php"<?php };?>>
							<section class="menu-item">
								<img src="<?php echo url_server_bm();?>pliki/ikony/dysk.png" class="tsr-nav-menu-img-left">
								<section class="tsr-nav-menu-size2"> Dysk </section>
							</section>
						</a>	
							<section class="menu-left-hover">
							<?php  if($_SESSION['flaga'] >= 25 AND $_SESSION['flaga'] <=30 OR $_SESSION['flaga'] >= 10 AND $_SESSION['flaga'] <=14 ){ ?>
								<a href="admin-add-file.php">
									<section class="menu-left-submenu">
										Dodaj element
									</section>
								</a>	
							<?php };?>	
							</section>
					</section>
					<?php  if($_SESSION['flaga'] >= 20 AND $_SESSION['flaga'] <=30 ){ ?>
					<section class="tsr menu-left">
						<a <?php  if($_SESSION['flaga'] >= 25 AND $_SESSION['flaga'] <=30 ){ ?>href="admin-all-motyw.php"<?php };?>>
							<section class="menu-item">
								<img src="<?php echo url_server_bm();?>pliki/ikony/motywy.png" class="tsr-nav-menu-img-left">
								<section class="tsr-nav-menu-size2"> Motyw </section>
							</section>
						</a>	
							<section class="menu-left-hover">
								<a href="admin-dostosuj-motyw.php">
									<section class="menu-left-submenu">
										Dostosuj Motyw
									</section>
								</a>	
								<a href="admin-edit-menu.php">	
									<section class="menu-left-submenu">
										Edytuj Menu
									</section>
								</a>	
								<a href="admin-edytuj-motyw.php">	
									<section class="menu-left-submenu">
										Edytuj Motyw
									</section>
								</a>	
								<a href="admin-widzety.php">	
									<section class="menu-left-submenu">
										Widżety
									</section>
								</a>	
							</section>		
					</section>
					<?php };?>
					<?php  if($_SESSION['flaga'] >= 20 AND $_SESSION['flaga'] <=30 ){ ?>
					<section class="tsr menu-left">
						<a href="admin-all-plugin.php">
							<section class="menu-item">
								<img src="<?php echo url_server_bm();?>pliki/ikony/plugin.png" class="tsr-nav-menu-img-left">
								<section class="tsr-nav-menu-size2"> Pluginy </section>
							</section>
						</a>	
					</section>
					<?php };?>
					<section class="tsr menu-left">
						<a <?php  if($_SESSION['flaga'] >= 25 AND $_SESSION['flaga'] <=30 ){ ?> href="admin-all-uzytkownicy.php" <?php };?>>
							<section class="menu-item">
								<img src="<?php echo url_server_bm();?>pliki/ikony/uzytkownicy.png" class="tsr-nav-menu-img-left">
								<section class="tsr-nav-menu-size2"> Użytkownicy </section>
							</section>
						</a>	
							<section class="menu-left-hover">
							<?php  if($_SESSION['flaga'] >= 25 AND $_SESSION['flaga'] <=30 ){ ?>
								<a href="admin-add-uzytkownik.php">
									<section class="menu-left-submenu">
										Dodaj Użytkownika
									</section>
								</a>
							<?php };?>
								<a href="admin-profil.php">	
									<section class="menu-left-submenu">
										Mój Profil
									</section>
								</a>	
							</section>
					</section>
					<?php  if($_SESSION['flaga'] >= 25 AND $_SESSION['flaga'] <=30 ){ ?>
					<section class="tsr menu-left">
						<a href="admin-ustawienia-serwera-black-min.php">
							<section class="menu-item">
								<img src="<?php echo url_server_bm();?>pliki/ikony/ustawienia.png" class="tsr-nav-menu-img-left">
								<section class="tsr-nav-menu-size2"> Ustawienia BM </section>
							</section>
						</a>	
							<section class="menu-left-hover">
								<a href="admin-ustawienia-serwera-black-min.php">
									<section class="menu-left-submenu">
										Ustawienia Serwera BM
									</section>
								</a>	
								<a href="admin-ustawienia-witryny.php">	
									<section class="menu-left-submenu">
										Ustawienia Witryny
									</section>
								</a>	
								<a href="admin-ustawienia-postow.php">	
									<section class="menu-left-submenu">
										Ustawienia Postów
									</section>
								</a>
								<a href="admin-ustawienia-spoleczne.php">	
									<section class="menu-left-submenu">
										Ustawienia Społeczne
									</section>
								</a>
								<a href="admin-tryb-konserwacji.php">	
									<section class="menu-left-submenu">
										Tryb Konserwacji
									</section>
								</a>	
							</section>
					</section>
					<?php };?>
				
				<?php };?>
				
					<section class="tsr menu-left tsr-button-menu-left-minimalize">
						<a >
							<section class="menu-item">
								<img src="<?php echo url_server_bm();?>pliki/ikony/szczalka2.png" class="tsr-nav-menu-img">
								<section class="tsr-nav-menu-size"> Zwiń menu </section>
							</section>
						</a>	
					</section>
  
        </div>		
	</header>	