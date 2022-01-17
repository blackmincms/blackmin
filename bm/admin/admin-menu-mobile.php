<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	W tym pliku jest główne menu mobile ADMINA Black Min cms
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";

?>

	<header>
		<nav class="tsr-nav-menu-mobile" id="tsr-scroll2">
			
			<section class="tsr" >
				<div class="tsr-button-menu-mobile tsr-fr tsr-display-none-3 tsr-display-block-2" onclick="myFunction(this)">
					<div class="bar1"></div>
					<div class="bar2"></div>
					<div class="bar3"></div>
				</div>
			</section>
			
			<ol class="menu-mobile tsr-fl">
				<li><a href="index.php"><?php echo $bm_nazwa_strony_bm_skrucona; ?></a></li>
				<?php  if($_SESSION['flaga'] >= 20 AND $_SESSION['flaga'] <=30 OR $_SESSION['flaga'] >= 10 AND $_SESSION['flaga'] <=14 ){ ?>
				<li><a href="add-post.php">dodaj</a></li>
				<?php };?>
			</ol>
		</nav>
	</header>