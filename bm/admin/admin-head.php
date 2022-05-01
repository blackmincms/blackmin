<?php	
/**
*	"Black Min" 
*	
*	For the full copyright and license information, please view the LICENSE
*	file that was distributed with this source code.
*
*	@package BlackMin
*	
*	#file: 2.0
*
*	This file is head page | admin panel
*/

	use BlackMin\Menu\menuAdmin;
	use BlackMin\Head\HeadAdmin;
?>

<!DOCTYPE html>
<html lang="<?php echo BM_SETTINGS["bm_lang_site"] ?>" class="">
<head>

	<?php 
		$BM_HEAD = new HeadAdmin ();
		$BM_HEAD->load();
		$SFL->load_css();
		$SFL->load_js();
		$SFL->load_php();
	?>

</head>
<body>

	<header>
		<nav class="tsr-nav-menu tsr-p-5px tsr-nav-menu tsr-position-fixed tsr-menu-background">
			<section class="col-ms90 tsr-menu-hiden">
				<section class="col-ms20 tsr-height-100 tsr-height-50px">
					<section class="img logo tsr-height-webkit-fill-available" style="background-image: url(<?php echo BM_SETTINGS["url_server"];?>pliki/logo/logo_bm_cale_black_2_100_600.png);"></section>
				</section>
				<section class="col-ms80 ">
					<ol class="menu">
						<li><a href="<?php echo BM_SETTINGS["url_site"];?>"><?php echo BM_SETTINGS["bm_name_site"]; ?></a></li>
						</li>
						<?php  if($_SESSION['flag'] >= 20 AND $_SESSION['flag'] <=30 OR $_SESSION['flag'] >= 10 AND $_SESSION['flag'] <=14 ){ ?>
						<li><a href="admin-add-post.php">dodaj</a>
						<?php }?>
						<?php  if($_SESSION['flag'] >= 15 AND $_SESSION['flag'] <=30 ){ ?>
						<?php };?>
					</ol>
				</section>
			</section>
			<section class="col-ms10 tsr-width-50-2 tsr-height-40px-3 tsr-float-right-3">
				<section class="tsr tsr-menu-avatar  tsr-height-40px-3">
					<img src="<?php echo $_SESSION['avatar']; ?>" alt="avatar" class="tsr-menu-avatar-img-right">
					<section class="tsr-menu-avatar-left tsr-vertical-align-baseline-1">
						<?php echo $_SESSION['nick']; ?>
					</section>
					<section class="tsr-menu-avatar-right-submenu">
						<img src="<?php echo $_SESSION['avatar']; ?>" alt="avatar" class="avatar tsr-fl">
						<section class="tsr-fl tsr-p-10px l-0">
							<section class="">
								<?php echo $_SESSION['nick']; ?>
							</section>
							<section class="tsr-mt-5">
								<a href="admin-profil.php">
									Mój Profil
								</a>	
							</section>
							<section class="tsr-mt-5">
								<a href="../logout.php">
									Wyloguj się
								</a>
							</section>
						</section>
					</section>
				</section>
			</section>
			
			<div class="tsr-button-menu-left" onclick="myFunction(this)">
				<div class="bar1"></div>
				<div class="bar2"></div>
				<div class="bar3"></div>
			</div>
					
			<div class="tsr-button-menu-mobile" onclick="myFunction(this)">
				<div class="bar1"></div>
				<div class="bar2"></div>
				<div class="bar3"></div>
			</div>
			
			<!-- logo Black Min CMS mała (fon) -->
			<div class="tsr tsr-display-none tsr-display-block-3 tsr-width-50-3 tsr-width-50px-2 tsr-height-40px tsr-float-right tsr-ma">
				<img src="<?php echo BM_SETTINGS["url_server"];?>pliki/logo/logo_bm_black_2_100_100.png" alt="logo" class="tsr">
			</div>
					
		</nav>
	</header>
	
	<?php
		$menuAdmin = new menuAdmin();

		$menuAdmin->renderViewOnly();
	?>
	
	<header>
		<nav class="tsr-nav-menu-mobile">
			
			<section class="tsr" >
				<div class="tsr-button-menu-mobile tsr-fr tsr-display-none-3 tsr-display-block-2" onclick="myFunction(this)">
					<div class="bar1"></div>
					<div class="bar2"></div>
					<div class="bar3"></div>
				</div>
			</section>
			
			<ol class="menu-mobile tsr-fl">
				<li><a href="index.php"><?php echo BM_SETTINGS["bm_name_site"]; ?></a></li>
				<?php  if($_SESSION['flag'] >= 20 AND $_SESSION['flag'] <=30 OR $_SESSION['flag'] >= 10 AND $_SESSION['flag'] <=14 ){ ?>
				<li><a href="add-post.php">dodaj</a></li>
				<?php };?>
			</ol>
		</nav>
	</header>

	<!-- Black Min CMS :: Container Content View -->
	<main class="container-right">
		<section class="container tsr-p-10px">