<?php	

	global $ustawienia_bm, $black_min, $status_bm,$url_serwera_bm;
	
	require_once BMPATH . BM . LADUJ . "date-format.php";
	
?>
<!DOCTYPE html>
<html lang="pl" class="">
<head>
	
	<?php
	
		$head_bm = new head_bm(); 
		$head_bm->add_title("Przerwa Techniczna - ");
		$head_bm->add_css(url_serwer_bm()."files/css/timonix_styles_rezult.css", "bm");
		$head_bm->set_robots(NULL);
		
		$head_bm->load_head();
	
	?>

</head>
<body>
	
	<section class="container">
		<header class="container tsr-p-10px">
			<div class="tsr tsr-mt-20"><?php echo $ustawienia_bm["bm_maintenance_mode_title"]; ?></div>
			<div class="tsr tsr-mt-20"><?php echo $ustawienia_bm["bm_maintenance_mode_description"]; ?></div>
			<div class="tsr tsr-mt-20">Przewidywana Data skończenia prac technicznych: <?php echo data_format($ustawienia_bm["bm_maintenance_mode_datetime"], "m.d.Y H:i"); ?></div>
		</header>
	</section>

</body>
</html>