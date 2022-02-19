<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyświetlania wszystkich motywów wysłanych na serwer i zażądzanie nimi
	
	Black Min cms,
	
	#plik: 1.2.1
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
	// renderowanie strony która odpowiada za wszystkie motywy na serwerze
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Wszytkie Motywy - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Wszytkie Motywy - Black Min 
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
	
						$(document).on('click', '.bm-motyw-usun', function(e){
							let usun_motyw = $(e.target).attr("tsr-data");
							tsr_ajax("insert/motyw-usun.php", {usun_motyw: usun_motyw}, "", false, function(t){
								$("[bm-id-post='"+ usun_motyw +"']").html(t);
								tsr_modal_hide();
							});
						});	
						
						$(document).on('click', '.bm-motyw-aktywuj', function(e){
							let aktywuj_motyw = $(e.target).attr("tsr-data");
							tsr_ajax("insert/motyw-aktywuj.php", {aktywuj_motyw: aktywuj_motyw}, "", false, function(t){
								$("[bm-id-post='"+ aktywuj_motyw +"']").html(t);
								tsr_modal_hide();
							});
						});						
						
						$('#load_post').click('submit', function(evt1){
							evt1.preventDefault();
							var ile_load = $('input[name="ile_load"]').val();
							
							$.ajax({
								type:"POST",
								url:"laduj/all-motyw.php",
								data:{
									ile_load:ile_load,
								}
							})
							.done(function(info){
								$('#post_container').text("");
								$('#post_container').append(info);
							})
							.fail(function(){
								alert("Wystąpił błąd. Spróbuj ponownie później");
							});
						});
						
						function evt(){
							var ile_load = "25";
							
							$.ajax({
								type:"POST",
								url:"laduj/all-motyw.php",
								data:{
									ile_load:ile_load,
								}
							})
							.done(function(info){
								$('#post_container').text("");
								$('#post_container').append(info);
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

</body>
</html>