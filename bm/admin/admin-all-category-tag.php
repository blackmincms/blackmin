<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyświetlania wszystkich kategorie tagów i zarządzanie nimi
	
	Black Min cms,
	
	#plik: 2.0
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
	// renderowanie strony która odpowiada za wszystkie kategorie tagi
	
?>


<!DOCTYPE html>
<html lang="<?php echo BM_LANG; ?>" class="">
<head>

	<title>Wszystkie Kategorie/Tagi - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Kategoria/tag - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0 ">
					
					<form accept-charset="UTF-8"  action="all-kategoria-tag" method="post" id="blackminload">	
						<section class="tsr tsr-p-5px tsr-mb-10">
							<section class="col-ms25 tsr-p-5px">
								<select name="kategoria_KT">
									<option value="all">wszystkie kategoria/tag</option>
									<option value="kategoria">kategoria</option>
									<option value="tag">tag</option>
								</select>
							</section>
							<section class="col-ms15 tsr-p-5px">
								<input type="number" name="ile_load" class="input" value="25" placeholder="ile załadować?">
							</section>
							<section class="col-ms60 tsr-p-5px">
								<section class="tsr tsr-position-relative">
									<input type="search" name="szukaj" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj">
									<section type="search" name="szukaj" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10" id="load_post">
										<img src="<?php echo BM_SETTINGS["url_server"];?>pliki/ikony/szukaj.png">
									</section>
								</section>
							</section>
						</section>
					</form>	
						
					<section class="tsr checkall" id="post_container">							
					</section>	

					<script type="text/javascript">
					$(document).ready(function(){					
	
						$('#load_post').click('submit', function(evt1, oEvent){
							evt1.preventDefault();
							var kategoria_KT = $('select[name="kategoria_KT"]').val();
							var ile_load = $('input[name="ile_load"]').val();
							var szukaj = $('input[name="szukaj"]').val();
							
							$.ajax({
								type:"POST",
								url:"laduj/all-kategoria-tag.php",
								data:{
									kategoria_KT:kategoria_KT,
									ile_load:ile_load,
									szukaj:szukaj,
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
						
						function evt(oEvent){
							var kategoria_KT = "all";
							var ile_load = "25";
							var szukaj = "";
							
							$.ajax({
								type:"POST",
								url:"laduj/all-kategoria-tag.php",
								data:{
									kategoria_KT:kategoria_KT,
									ile_load:ile_load,
									szukaj:szukaj,
								}
							})
							.done(function(info){
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