<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyświetlania wszystkich użytkowników i zarządzanie nimi
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
	// renderowanie strony która odpowiada za wszystkich użytkowników
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Wszyscy Użytkownicy - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Wszyscy Użytkownicy - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0 ">
					
					<form accept-charset="UTF-8"  action="" method="post" id="data-add-post">	
						<section class="tsr tsr-p-5px tsr-mb-10">
							<section class="col-ms15 tsr-p-5px">
								<select name="plec" id="plec">
									<option value="all">wszystkie kategorie</option>
									<option value="Mężczyzna">Mężczyzna</option>
									<option value="Kobieta">Kobieta</option>
								</select>
							</section>
							<section class="col-ms15 tsr-p-5px">
								<select name="dostep" id="dostep">
									<option value="all">każdy rodzaj dostępu</option>
									<option value="dostęp">dostęp</option>
									<option value="brak dostępu">brak dostępu</option>
									<option value="konto zawieszone" >konto zawieszone</option>
									<option value="zablokowano" >zablokowano</option>
									<option value="zbanowano" >zbanowano</option>
								</select>
							</section>
							<section class="col-ms15 tsr-p-5px">
								<select name="ranga" id="ranga">
									<option value="all">każdy użytkownik</option>
									<option value="użytkownik">użytkownik</option>
									<option value="współpracownik">współpracownik</option>
									<option value="redaktor" >redaktor</option>
									<option value="moderator" >moderator</option>
									<option value="administrator" >administrator</option>
									<option value="właśćiciel" >właśćiciel</option>
								</select>
							</section>
							<section class="col-ms10 tsr-p-5px">
								<input type="number" name="ile_load" class="input" value="25" placeholder="ile załadować?">
							</section>
							<section class="col-ms40 tsr-p-5px">
								<section class="tsr tsr-position-relative">
									<input type="search" name="szukaj" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj">
									<section type="search" name="szukaj" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10" id="load_post">
										<img src="<?php echo url_server_bm();?>pliki/ikony/szukaj.png">
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
							var plec = $('select[name="plec"]').val();
							var dostep = $('select[name="dostep"]').val();
							var ranga = $('select[name="ranga"]').val();
							var ile_load = $('input[name="ile_load"]').val();
							var szukaj = $('input[name="szukaj"]').val();
							
							$.ajax({
								type:"POST",
								url:"laduj/all-uzytkownicy.php",
								data:{
									plec:plec,
									dostep:dostep,
									ranga:ranga,
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
							var plec = "all";
							var dostep = "all";
							var ranga = "all";
							var ile_load = "25";
							var szukaj = "";
							
							$.ajax({
								type:"POST",
								url:"laduj/all-uzytkownicy.php",
								data:{
									plec:plec,
									dostep:dostep,
									ranga:ranga,
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
						
						var delete_post = $('input[name="check_usun[]"]').val();
						
						console.log(delete_post);
						
						if(delete_post != []){
						
							$.ajax({
								type:"POST",
								url:"insert/uzytkownik-delete.php",
								data:{
									ddelte_post:delete_post,
								}
							})
							.done(function(info){
								$('#post_container').append(info);
								$(this).closest('.tsr-records').fadeOut(1100);
								$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
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
		var delete_post = $('input[name="check_usun[]"]').val();
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