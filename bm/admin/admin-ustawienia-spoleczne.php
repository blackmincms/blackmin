<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do renderowania strony odpowiedzialnej za aktulizowanie ustawień społecznych
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Aktualizacja Ustawień Społecznych - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<div class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Aktualizacja Ustawień Społecznych - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
					
					<section class="tsr tsr-mt-20">
						<form accept-charset="UTF-8"  action="" method="post" id="add_post" autocomplete="off">	
						
						<section class="tsr">
							<section class="col-inp-25 tsr-p-10px fs-70 " >
								<span class="tsr-vertical-align-sub">
									Skrócona Polityka Prywatnośći:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="bm_spolecznosc_opis" class="input" placeholder="Black Min CMS" value="<?php echo BM_SETTINGS["bm_cookie_description"]; ?>" autocomplete="off"/>
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-25 tsr-p-10px fs-70 " >
								<span class="tsr-vertical-align-sub">
									Link do Polityki Prywatnośći:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="bm_spolecznosc_link" class="input" placeholder="Black Min CMS" value="<?php echo BM_SETTINGS["bm_cookie_link"]; ?>" autocomplete="off"/>
							</section>
						</section>
						<section class="tsr">					
							<section class="col-inp-25 tsr-p-10px fs-70 " >
								<span class="tsr-vertical-align-sub">
									Link do Informacji o Ciasteczkach:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="bm_spolecznosc_link_info_cookies" class="input" placeholder="Black Min" value="<?php echo BM_SETTINGS["bm_cookie_privacy_policy_link"]; ?>" autocomplete="off"/>
							</section>
						</section>
						<section class="tsr">					
							<section class="col-inp-25 tsr-p-10px fs-70 " >
								<span class="tsr-vertical-align-sub">
									Tekst Akceptujący Ciasteczka:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="bm_spolecznosc_text_akcept" class="input" placeholder="Black Min" value="<?php echo BM_SETTINGS["bm_cookie_accept"]; ?>" autocomplete="off"/>
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
		var bm_spolecznosc_opis = $('input[name="bm_spolecznosc_opis"]').val();
		var bm_spolecznosc_link = $('input[name="bm_spolecznosc_link"]').val();
		var bm_spolecznosc_link_info_cookies = $('input[name="bm_spolecznosc_link_info_cookies"]').val();
		var bm_spolecznosc_text_akcept = $('input[name="bm_spolecznosc_text_akcept"]').val();
		$.ajax({
			type:"POST",
			url:"insert/update-ustawienia-spoleczne.php",
			data:{
				bm_spolecznosc_opis:bm_spolecznosc_opis,
				bm_spolecznosc_link:bm_spolecznosc_link,
				bm_spolecznosc_link_info_cookies:bm_spolecznosc_link_info_cookies,
				bm_spolecznosc_text_akcept:bm_spolecznosc_text_akcept,
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