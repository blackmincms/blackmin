<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do renderowania strony odpowiedzialnej za aktulizowanie ustawień witryny serwera black min
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";	
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Aktualizacja Ustawień Witryny Black Min - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<div class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Aktualizacja Ustawień Witryny Black Min - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
					
					<section class="tsr tsr-mt-20">
						<form accept-charset="UTF-8"  action="" method="post" id="add_post" autocomplete="off">	
						
						<section class="tsr">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Tytuł Witryny:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="tytul_witryny" class="input" placeholder="Black Min CMS" value="<?php echo BM_SETTINGS["bm_name_site"]; ?>" autocomplete="off"/>
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Opis Witryny:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<textarea name="opis_witryny" rows="10" cols="80" placeholder="Wpisz Opis" autocomplete="off"><?php echo BM_SETTINGS["bm_description_site"]; ?></textarea>
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Słowa Kluczone Witryny:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="slowa_kluczowe_witryny" class="input" placeholder="Black Min CMS" value="<?php echo BM_SETTINGS["bm_keywords"]; ?>" autocomplete="off"/>
								<label class="fs-70">Słowa kluczowe odzielone po "," przecinku.</label>
							</section>
						</section>
						<section class="tsr">					
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Ikona Witryny:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="icone_ico_witryny" class="input" placeholder="Black Min" value="<?php echo BM_SETTINGS["bm_icon_site"]; ?>" autocomplete="off"/>
								<label class="fs-70">Typ pliku (.ico).</label>
							</section>
						</section>
						<section class="tsr">					
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Ikona Witryny:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="icone_witryny" class="input" placeholder="Black Min" value="<?php echo BM_SETTINGS["bm_icon_png_site"]; ?>" autocomplete="off"/>
								<label class="fs-70">Typ pliku (.png, .jpg).</label>
							</section>
						</section>
						<section class="tsr">					
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Logo Witryny:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="logo_witryny" class="input" placeholder="Black Min" value="<?php echo BM_SETTINGS["bm_logo"]; ?>" autocomplete="off"/>
								<label class="fs-70">Typ pliku (.png, jpg, itp).</label>
							</section>
						</section>
						<section class="tsr">					
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Banner Witryny:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="banner_witryny" class="input" placeholder="Black Min" value="<?php echo BM_SETTINGS["bm_banner"]; ?>" autocomplete="off"/>
								<label class="fs-70">Typ pliku (.png, .jpg, itp).</label>
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
		var tytul_witryny = $('input[name="tytul_witryny"]').val();
		var opis_witryny = $('textarea[name="opis_witryny"]').val();
		var slowa_kluczowe_witryny = $('input[name="slowa_kluczowe_witryny"]').val();
		var icone_ico_witryny = $('input[name="icone_ico_witryny"]').val();
		var icone_witryny = $('input[name="icone_witryny"]').val();
		var logo_witryny = $('input[name="logo_witryny"]').val();
		var banner_witryny = $('input[name="banner_witryny"]').val();
		$.ajax({
			type:"POST",
			url:"insert/update-ustawienia-witryny.php",
			data:{
				tytul_witryny:tytul_witryny,
				opis_witryny:opis_witryny,
				slowa_kluczowe_witryny:slowa_kluczowe_witryny,
				icone_ico_witryny:icone_ico_witryny,
				icone_witryny:icone_witryny,
				logo_witryny:logo_witryny,
				banner_witryny:banner_witryny,
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