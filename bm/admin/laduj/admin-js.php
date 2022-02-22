<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do Załadowania plików bibliotek i skryptów js
	
	Black Min cms,
	
	#plik: 1.2
*/

?>

	<script src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/jquery/jquery.min.js"></script> 
	<script src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/jquery.tabSlideOut.js-master/jquery.tabSlideOut.js"></script> 
 	<script src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/jquery/jquery-ui.min.js"></script>
	<script src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/jquery-modal-master/jquery.modal.min.js"></script>
	<script src="<?php echo BM_SETTINGS["url_server"]; ?>files/js/timonix_styles_rezult.js"></script>
	<script src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-suggestags/js/timonix-suggestags.js"></script>
	<script src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-checkall/timonix-checkall.js"></script>
	<script src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/aquay.js"></script>
	<script src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/aquay-black-min-compiler.js"></script>
	<script src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/aquay-black-min-decompiler.js"></script>

	<?php 
		$sfl->load_js(); 
	?>