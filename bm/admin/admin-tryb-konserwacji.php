<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy renderowania strony odpowiedzialnej za aktulizowanie ustawień serwera black min - tryb konserwacji
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Tryb Konserwacji Witryny Black Min - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Tryb Konserwacji Witryny Black Min - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
					
				<section class="tsr tsr-mt-20">
					<form accept-charset="UTF-8" action="" method="post" id="add_post" autocomplete="off">	
					
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Tryb Konserwacji:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<select name="tryb" class="select" utocomplete="off">
								<?php if($get_ustawienia_bm["bm_maintenance_mode"] == "false"){?>
									<option value="false">nie</option>
									<option value="true">tak</option>
								<?php }else if($get_ustawienia_bm["bm_maintenance_mode"] == "true"){?>
									<option value="true">tak</option>
									<option value="false">nie</option>
								<?php }; ?>
							</select>
						</section>
					</section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Tytuł Konserwacji:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="tryb_tytul" class="input" placeholder="Black Min CMS" value="<?php echo $get_ustawienia_bm["bm_maintenance_mode_title"]; ?>" autocomplete="off"/>
						</section>
					</section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Opis Konserwacji:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<textarea name="tryb_opis" rows="10" cols="80" placeholder="Wpisz Opis" autocomplete="off"><?php echo $get_ustawienia_bm["bm_maintenance_mode_description"]; ?></textarea>
						</section>
					</section>
					<section class="tsr">					
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Czas Trwania Konserwacji:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="datetime-local" name="tryb_datetime" class="input" placeholder="Black Min" value="<?php echo $get_ustawienia_bm["bm_maintenance_mode_datetime"]; ?>" autocomplete="off"/>
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
		// wysyłanie danych do skryptu metodą post pobranych z formularza
	
		$('#submit_post').click('submit', function(evt1){	
		evt1.preventDefault();
		var tryb = $('select[name="tryb"]').val();
		var tryb_tytul = $('input[name="tryb_tytul"]').val();
		var tryb_opis = $('textarea[name="tryb_opis"]').val();
		var tryb_datetime = $('input[name="tryb_datetime"]').val();
		$.ajax({
			type:"POST",
			url:"insert/update-ustawienia-tryb-konserwacji.php",
			data:{
				tryb:tryb,
				tryb_tytul:tryb_tytul,
				tryb_opis:tryb_opis,
				tryb_datetime:tryb_datetime,
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