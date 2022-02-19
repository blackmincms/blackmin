<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy renderowania strony odpowiedzialnej za aktulizowanie ustawień postów
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Aktualizacja Ustawień Postów Black Min - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<div class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Aktualizacja Ustawień Postów Black Min - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">

				<section class="tsr tsr-mt-20">
					<form accept-charset="UTF-8"  action="" method="post" id="add_post" autocomplete="off">	
					
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Domyśny Status Postów:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<?php
								if (BM_SETTINGS["bm_default_format_post"] == "public") {
									echo '
										<select name="bm_domysny_status_posta" id="status_post">
											<option value="public">Publiczny</option>
											<option value="private">Prywatny</option>
											<option value="protect_password" >Zabezpieczony hasłem</option>
											<option value="szkic" >szkic</option>
										</select>
									';
								}
								
								if (BM_SETTINGS["bm_default_format_post"] == "private") {
									echo '
										<select name="bm_domysny_status_posta" id="status_post">
											<option value="private">Prywatny</option>
											<option value="public">Publiczny</option>
											<option value="protect_password" >Zabezpieczony hasłem</option>
											<option value="szkic" >szkic</option>
										</select>
									';
								}
								
								if (BM_SETTINGS["bm_default_format_post"] == "protect_password") {
									echo '
										<select name="bm_domysny_status_posta" id="status_post">
											<option value="protect_password" >Zabezpieczony hasłem</option>
											<option value="private">Prywatny</option>
											<option value="public">Publiczny</option>
											<option value="szkic" >szkic</option>
										</select>
									';
								}
								
								if (BM_SETTINGS["bm_default_format_post"] == "szkic") {
									echo '
										<select name="bm_domysny_status_posta" id="status_post">
											<option value="szkic" >szkic</option>
											<option value="protect_password" >Zabezpieczony hasłem</option>
											<option value="private">Prywatny</option>
											<option value="public">Publiczny</option>
										</select>
									';
								}
							?>
						</section>
					</section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Domyśny Format posta:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<?php
								if (BM_SETTINGS["bm_default_status_post"] == "post") {
									echo '
										<select name="bm_domysny_format_posta" id="kategoria">
											<option value="post">zwykły post</option>
											<option value="info">informacja</option>
											<option value="wazne_info">ważna informacja</option>
											<option value="ostrzezenie">ostrzeżenie</option>
											<option value="najwazniejsze_info">najważniejsza informacja</option>
										</select>
									';
								}
								
								if (BM_SETTINGS["bm_default_status_post"] == "info") {
									echo '
										<select name="bm_domysny_format_posta" id="kategoria">
											<option value="info">informacja</option>
											<option value="post">zwykły post</option>
											<option value="wazne_info">ważna informacja</option>
											<option value="ostrzezenie">ostrzeżenie</option>
											<option value="najwazniejsze_info">najważniejsza informacja</option>
										</select>
									';
								}
								
								if (BM_SETTINGS["bm_default_status_post"] == "wazne_info") {
									echo '
										<select name="bm_domysny_format_posta" id="kategoria">
											<option value="wazne_info">ważna informacja</option>
											<option value="post">zwykły post</option>
											<option value="info">informacja</option>
											<option value="ostrzezenie">ostrzeżenie</option>
											<option value="najwazniejsze_info">najważniejsza informacja</option>
										</select>
									';
								}
								
								if (BM_SETTINGS["bm_default_status_post"] == "ostrzezenie") {
									echo '
										<select name="bm_domysny_format_posta" id="kategoria">
											<option value="ostrzezenie">ostrzeżenie</option>
											<option value="post">zwykły post</option>
											<option value="info">informacja</option>
											<option value="wazne_info">ważna informacja</option>
											<option value="najwazniejsze_info">najważniejsza informacja</option>
										</select>
									';
								}
								
								if (BM_SETTINGS["bm_default_status_post"] == "najwazniejsze_info") {
									echo '
										<select name="bm_domysny_format_posta" id="kategoria">
											<option value="najwazniejsze_info">najważniejsza informacja</option>
											<option value="post">zwykły post</option>
											<option value="info">informacja</option>
											<option value="wazne_info">ważna informacja</option>
											<option value="ostrzezenie">ostrzeżenie</option>
										</select>
									';
								}
								
								if (BM_SETTINGS["bm_default_status_post"] == "szkic") {
									echo '
										<select name="bm_domysny_format_posta" id="kategoria">
											<option value="szkic">szkic</option>
											<option value="najwazniejsze_info">najważniejsza informacja</option>
											<option value="post">zwykły post</option>
											<option value="info">informacja</option>
											<option value="wazne_info">ważna informacja</option>
											<option value="ostrzezenie">ostrzeżenie</option>
										</select>
									';
								}
							?>
						</section>
					</section>
					<section class="tsr">					
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Domyśne Ładowanie Postów:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="number" name="bm_domysne_laduj_posty" class="input" placeholder="Black Min" value="<?php echo BM_SETTINGS["bm_default_load_post"]; ?>" autocomplete="off"/>
						</section>
					</section>
					
					<section class="tsr tsr-inp tsr-mt-50">
					<button type="submit" value="Dodaj Kategorie/Post" class="input buttom" id="submit_post" >Zapisz ustawienia</button>
					</section>	
					
					<section class="tsr-inp tsr-mt-50">
						<div id="contajner_post_add"></div>
					</section>			
					
					</form>	
				</section>
				</section>
	
	<script type="text/javascript">			
		// wysyłanie danych do skryptu metodą post pobranych z formularza
	
		$('#submit_post').click('submit', function(evt1){	
		evt1.preventDefault();
		var bm_domysny_status_posta = $('select[name="bm_domysny_status_posta"]').val();
		var bm_domysny_format_posta = $('select[name="bm_domysny_format_posta"]').val();
		var bm_domysne_laduj_posty = $('input[name="bm_domysne_laduj_posty"]').val();
		$.ajax({
			type:"POST",
			url:"insert/update-ustawienia-postow.php",
			data:{
				bm_domysny_status_posta:bm_domysny_status_posta,
				bm_domysny_format_posta:bm_domysny_format_posta,
				bm_domysne_laduj_posty:bm_domysne_laduj_posty,
			}
		})
		.done(function(info){
			$('#contajner_post_add').append(info);
			$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
		})
		.fail(function(){
			alert("Wystąpił błąd. Spróbuj ponownie później");
		});
		});	
	</script>				
					
				</section>
			</section>
		</div>
	</main>

	<?php require_once "admin-stopka.php"; ?>

	<script>
	$(document).ready(function() { 
		console.clear()
	});
	</script>	

</body>
</html>