<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyświetlania wszystkich postów i zarządzanie nimi
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
	// renderowanie strony która odpowiada za wszystkie posty
	
?>

<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Wszystkie Posty - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Wszystkie posty - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0 ">
					
					<form accept-charset="UTF-8"  action="" method="post" id="data-add-post">	
						<section class="tsr tsr-p-5px tsr-mb-10">
							<section class="col-ms20 tsr-p-5px">
								<select name="kategoria" id="kategoria">
									<option value="all">wszystkie kategorie</option>
									<option value="post">zwykły post</option>
									<option value="info">informacja</option>
									<option value="wazne_info">ważna informacja</option>
									<option value="ostrzezenie">ostrzeżenie</option>
									<option value="najwazniejsze_info">najważniejsza informacja</option>
								</select>
							</section>
							<section class="col-ms20 tsr-p-5px">
								<select name="status" id="status">
									<option value="all">każdy status</option>
									<option value="public">Publiczny</option>
									<option value="private">Prywatny</option>
									<option value="protect_password" >Zabezpieczony hasłem</option>
									<option value="szkic" >szkic</option>
								</select>
							</section>
							<section class="col-ms15 tsr-p-5px">
								<input type="number" name="ile_load" class="input" value="25" placeholder="ile załadować?">
							</section>
							<section class="col-ms45 tsr-p-5px">
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
	
						$('#load_post').click('submit', function(evt1){
							evt1.preventDefault();
							var kategoria = $('select[name="kategoria"]').val();
							var status = $('select[name="status"]').val();
							var ile_load = $('input[name="ile_load"]').val();
							var szukaj = $('input[name="szukaj"]').val();
							
							$.ajax({
								type:"POST",
								url:"laduj/all-post.php",
								data:{
									kategoria:kategoria,
									status:status,
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
						
						function evt(){
							var kategoria = "all";
							var status = "all";
							var ile_load = "25";
							var szukaj = "";
							
							$.ajax({
								type:"POST",
								url:"laduj/all-post.php",
								data:{
									kategoria:kategoria,
									status:status,
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
					
						$('#usun_post_submit').click('submit', function(evt1){
						evt1.preventDefault();
						
						if(delete_post != []){
						
							$.ajax({
								type:"POST",
								url:"insert/post-delete.php",
								data:{
									delte_KT_a:akcja_records,
								}
							})
							.done(function(info){
								$(this).closest('.tsr-records').fadeOut(1100);
							})
							.fail(function(){
								alert("Wystąpił błąd. Spróbuj ponownie później");
							});
						}	
						});
						
					})
					</script>
					
					<script>
						$('#cla1').on('click',function(){
						console.log('klikmoles szukaj znajomego');
						var delte_KT_a = $('input[name="check_usun[]"]').val();
						$('#enp_err').val("nowa wartość");
					});
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