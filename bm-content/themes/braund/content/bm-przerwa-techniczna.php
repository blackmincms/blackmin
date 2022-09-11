	
	<section class="container">
		<header class="container tsr-p-10px">
			<div class="tsr tsr-mt-20"><?php echo BM_SETTINGS["bm_maintenance_mode_title"]; ?></div>
			<div class="tsr tsr-mt-20"><?php echo BM_SETTINGS["bm_maintenance_mode_description"]; ?></div>
			<div class="tsr tsr-mt-20">Przewidywana Data skończenia prac technicznych: <?php echo data_format(BM_SETTINGS["bm_maintenance_mode_datetime"], "m.d.Y H:i"); ?></div>
		</header>
	</section>

</body>
</html>