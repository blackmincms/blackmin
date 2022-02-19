<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy renderowania strony odpowiedzialnej za aktulizowanie ustawień serwera mail 
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";	
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Aktualizacja Ustawień Sewera Mail Black Min - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<div class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Aktualizacja Ustawień Sewera Mail - Black Min - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
				
					<section class="tsr tsr-mt-20">
						<form accept-charset="UTF-8"  action="" method="post" id="add_post" autocomplete="off">	
						
						<section class="tsr">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Serwer Mail:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="bm_serwer_mail" class="input" placeholder="Black Min CMS" value="<?php echo BM_SETTINGS["bm_server_mail"]; ?>" autocomplete="off"/>
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Serwer Mail Login:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="bm_serwer_mail_login" class="input" placeholder="Black Min CMS" value="<?php echo BM_SETTINGS["bm_server_mail_login"]; ?>" autocomplete="off"/>
							</section>
						</section>
						<section class="tsr">					
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Serwer Mail Hasło:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="bm_serwer_mail_hasło" class="input" placeholder="Black Min" value="<?php echo BM_SETTINGS["bm_server_mail_password"]; ?>" autocomplete="off"/>
							</section>
						</section>
						<section class="tsr">					
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Serwer Mail Port:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="bm_serwer_mail_port" class="input" placeholder="Black Min" value="<?php echo BM_SETTINGS["bm_server_mail_port"]; ?>" autocomplete="off"/>
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
		var bm_serwer_mail = $('input[name="bm_serwer_mail"]').val();
		var bm_serwer_mail_login = $('input[name="bm_serwer_mail_login"]').val();
		var bm_serwer_mail_hasło = $('input[name="bm_serwer_mail_hasło"]').val();
		var bm_serwer_mail_port = $('input[name="bm_serwer_mail_port"]').val();
		$.ajax({
			type:"POST",
			url:"insert/update-ustawienia-serwera-mail.php",
			data:{
				bm_serwer_mail:bm_serwer_mail,
				bm_serwer_mail_login:bm_serwer_mail_login,
				bm_serwer_mail_hasło:bm_serwer_mail_hasło,
				bm_serwer_mail_port:bm_serwer_mail_port,
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