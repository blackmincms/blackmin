<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy renderowania strony odpowiedzialnej za aktulizowanie ustawień motywu css serwera black min
	
	Black Min cms,
	
	#plik: 1.2
*/


	// ładowanie jądra black mina
	require_once "black-min.php";
	
?>

<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Dostosuj Motyw - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>
	
	<link rel="stylesheet" href="<?php echo BM_SETTINGS["url_server"]?>files/css/default-style-theme-blackmin.css" />

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Dostosuj Motyw Witryny Black Min - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">

				<section class="tsr tsr-mt-20">
					<form accept-charset="UTF-8" action="" method="post" id="add_post" autocomplete="off">	
					
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Kolor Tła Motywu:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="color" name="tlo_motywu" class="input" placeholder="Black Min CMS" value="#ffffff" autocomplete="off"/>
						</section>
					</section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Kolor Czcionki Motywu:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="color" name="kolor_czcionki_motywu" class="input" placeholder="Black Min CMS" value="#ffffff" autocomplete="off"/>
						</section>
					</section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Kolor Czcionki Linku Motywu:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="color" name="kolor_czcionki_linku_motywu" class="input" placeholder="Black Min CMS" value="#ffffff" autocomplete="off"/>
						</section>
					</section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Kolor Czcionki Linku Motywu:
							</span>
							<span class="tsr-vertical-align-sub fs-70">
								Po Najechaniu
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="color" name="kolor_czcionki_linku_hover_motywu" class="input" placeholder="Black Min CMS" value="#ffffff" autocomplete="off"/>
						</section>
					</section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Kolor Czcionki Linku Motywu:
							</span>
							<span class="tsr-vertical-align-sub fs-70">
								Aktywny Link
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="color" name="kolor_czcionki_linku_aktywny_motywu" class="input" placeholder="Black Min CMS" value="#ffffff" autocomplete="off"/>
						</section>
					</section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Kolor Czcionki Linku Motywu:
							</span>
							<span class="tsr-vertical-align-sub fs-70">
								Po Odwiedzeniu Strony
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="color" name="kolor_czcionki_linku_visitet_motywu" class="input" placeholder="Black Min CMS" value="#ffffff" autocomplete="off"/>
						</section>
					</section>
					
					<section class="tsr tsr-inp tsr-mt-50">
					<button type="submit" class="input buttom" id="submit_post" >Zapisz ustawienia</button>
					</section>	
					
					<section class="tsr-inp tsr-mt-50">
						<div id="contajner_post_add"></div>
					</section>			
					
					</form>	
				</section>
				</section>
	
	<script type="text/javascript">			

		$('input[name="tlo_motywu"]').change(function() {
			var t1 = $('input[name="tlo_motywu"]').val();
			$("body, html").css("background-color", t1);
		});

		$('input[name="kolor_czcionki_motywu"]').change(function() {
			var c1 = $('input[name="kolor_czcionki_motywu"]').val();
			$("body, html").css("color", c1);
		});	

		$('input[name="kolor_czcionki_linku_motywu"]').change(function() {
			var c2 = $('input[name="kolor_czcionki_linku_motywu"]').val();
			$("a").css("color", c2).css("color:link", c2);
		});	

		$('input[name="kolor_czcionki_linku_hover_motywu"]').change(function() {
			var c3 = $('input[name="kolor_czcionki_linku_hover_motywu"]').val();
			$("a:hover").css("color:hover", c3);
		});	

		$('input[name="kolor_czcionki_linku_aktywny_motywu"]').change(function() {
			var c4 = $('input[name="kolor_czcionki_linku_aktywny_motywu"]').val();
			$("a:active").css("color:active", c4);
		});	

		$('input[name="kolor_czcionki_linku_visitet_motywu"]').change(function() {
			var c5 = $('input[name="kolor_czcionki_linku_visitet_motywu"]').val();
			$("a:visited").css("color:visited", c5);
		});	
	
		// wysyłanie danych do skryptu metodą post pobranych z formularza
	
		$('#submit_post').click('submit', function(evt1){	
		evt1.preventDefault();
		var tlo_motywu = $('input[name="tlo_motywu"]').val();
		var kolor_czcionki_motywu = $('input[name="kolor_czcionki_motywu"]').val();
		var kolor_czcionki_linku_motywu = $('input[name="kolor_czcionki_linku_motywu"]').val();
		var kolor_czcionki_linku_hover_motywu = $('input[name="kolor_czcionki_linku_hover_motywu"]').val();
		var kolor_czcionki_linku_aktywny_motywu = $('input[name="kolor_czcionki_linku_aktywny_motywu"]').val();
		var kolor_czcionki_linku_visitet_motywu = $('input[name="kolor_czcionki_linku_visitet_motywu"]').val();
		$.ajax({
			type:"POST",
			url:"insert/update-default-style-theme-blackmin.php",
			data:{
				tlo_motywu:tlo_motywu,
				kolor_czcionki_motywu:kolor_czcionki_motywu,
				kolor_czcionki_linku_motywu:kolor_czcionki_linku_motywu,
				kolor_czcionki_linku_hover_motywu:kolor_czcionki_linku_hover_motywu,
				kolor_czcionki_linku_aktywny_motywu:kolor_czcionki_linku_aktywny_motywu,
				kolor_czcionki_linku_visitet_motywu:kolor_czcionki_linku_visitet_motywu,
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