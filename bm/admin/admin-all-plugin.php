<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyświetlania wszystkich plików (pluginów) wysłanych na serwer i zażądzanie nimi
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
	
	// renderowanie strony która odpowiada za wszystkie pliki (plugunów) na serwerze
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Wszytkie Pluginy - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Wszytkie Pluginy - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0 ">
					
					<form accept-charset="UTF-8"  action="" method="post" id="data-add-post">	
						<section class="tsr tsr-p-5px tsr-mb-10">
							<section class="tsr tsr-p-5px">
								<section class="tsr tsr-position-relative">
									<input type="number" name="ile_load" class="input  tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" value="25" placeholder="ile załadować?">
									<section type="search" name="szukaj" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10" id="load_post">
										<img src="<?php echo BM_SETTINGS["url_server"];?>pliki/ikony/szukaj.png">
									</section>
								</section>
							</section>
						</section>
					</form>	
					
					<!-- Zmienianie wyświetlania plików -->
						
					<section class="tsr col-grid-4 fs-120" id="post_container">		
						<section class="tsr-alert tsr-alert-info">Ładowanie danych</section>
					</section>	

					<script type="text/javascript">
					$(document).ready(function(){					

						$(document).on('click', '.bm-plugin-usun', function(e){
							let usun_plugin = $(e.target).attr("tsr-data");
							tsr_ajax("insert/plugin-usun.php", {usun_plugin: usun_plugin}, "", false, function(t){
								$("[bm-id-post='"+ usun_plugin +"']").html(t);
								tsr_modal_hide();
							});
						});	
						
						$(document).on('click', '.bm-plugin-aktywuj', function(e){
							let aktywuj_plugin_full = $(e.target).attr("tsr-data"),
								aktywuj_plugin = $(e.target).attr("tsr-data2");
							tsr_ajax("insert/plugin-aktywuj.php", {
								aktywuj_plugin_full: aktywuj_plugin_full,
								aktywuj_plugin: aktywuj_plugin,
								aktywny_plugin: "false",
							}, "", false, function(t){
								$("[bm-id-post='"+ aktywuj_plugin_full +"']").html(t);
								tsr_modal_hide();
							});
						});
						
						$(document).on('click', '.bm-plugin-dezaktywuj', function(e){
							let dezaktywuj_plugin_full = $(e.target).attr("tsr-data"),
								dezaktywuj_plugin = $(e.target).attr("tsr-data2");
							tsr_ajax("insert/plugin-aktywuj.php", {
								aktywuj_plugin_full: dezaktywuj_plugin_full,
								aktywuj_plugin: dezaktywuj_plugin,
								aktywny_plugin: "true",
							}, "", false, function(t){
								$("[bm-id-post='"+ dezaktywuj_plugin_full +"']").html(t);
								tsr_modal_hide();
							});
						});
					
						$('#load_post').click('submit', function(evt1){
							evt1.preventDefault();
							var ile_load = $('input[name="ile_load"]').val();
							
							$.ajax({
								type:"POST",
								url:"laduj/all-pluginy.php",
								data:{
									ile_load:ile_load,
								}
							})
							.done(function(info){
								$('#post_container').text("");
								$('#post_container').html(info);
							})
							.fail(function(){
								alert("Wystąpił błąd. Spróbuj ponownie później");
							});
						});
						
						function evt(){
							var ile_load = "25";
							
							$.ajax({
								type:"POST",
								url:"laduj/all-pluginy.php",
								data:{
									ile_load:ile_load,
								}
							})
							.done(function(info){
								$('#post_container').text("");
								$('#post_container').html(info);
							})
							.fail(function(){
								alert("Wystąpił błąd. Spróbuj ponownie później");
							});
						};
						
						evt();
						
					})
					</script>	
				</section>
			</section>
		</section>
	</main>

	<?php require_once "admin-stopka.php"; ?>

	<script>
	$(document).ready(function() { 
		console.clear()
	});
	</script>	

</body>
</html>