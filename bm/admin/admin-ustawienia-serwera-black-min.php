<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy renderowania strony odpowiedzialnej za aktulizowanie ustawień serwera black min
	
	Black Min cms,
	
	#plik: 1.1
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Aktualizacja Ustawień Serwera Black Min - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<article class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Aktualizacja Ustawień Serwera Black Min - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
					

				<section class="tsr tsr-mt-20">
					<form accept-charset="UTF-8"  action="" method="post" id="add_post" autocomplete="off">	
					
					<section class="tsr-inp"></section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Url Serwera Black Min:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="url" name="url_serwera_bm" class="input" placeholder="Black Min" value="<?php echo BM_SETTINGS["url_server"]; ?>" autocomplete="off"/>
						</section>
					</section>	
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Url Witryny Black Min:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="url" name="url_witryny_bm" class="input" placeholder="Black Min CMS" value="<?php echo BM_SETTINGS["url_site"]; ?>" autocomplete="off"/>
						</section>
					</section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Adres email Witryny:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="email" name="mail_witryny" class="input" placeholder="Black Min CMS" value="<?php echo BM_SETTINGS["bm_mail_site"]; ?>" autocomplete="off"/>
							<label class="fs-70">Mail będzie używany do celach administracyjnych i powiadomień.</label>
						</section>
					</section>
					<section class="tsr">					
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Domyśna rola nowych użytkowników:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<select name="ranga_witryny" class="select" utocomplete="off">
							<?php 
								if (BM_SETTINGS["bm_new_user"] == "współpracownik") {
									echo '
										<option value="współpracownik">Współpracownik</option>
										<option value="redaktor">Redaktor</option>
										<option value="moderator">Moderator</option>
										<option value="administrator" >Administrator</option>
										<option value="właśćiciel" >Właśćiciel</option>
									';
								}
								
								if (BM_SETTINGS["bm_new_user"] == "redaktor") {
									echo '
										<option value="redaktor">Redaktor</option>
										<option value="współpracownik">Współpracownik</option>
										<option value="moderator">Moderator</option>
										<option value="administrator" >Administrator</option>
										<option value="właśćiciel" >Właśćiciel</option>
									';
								}
								
								if (BM_SETTINGS["bm_new_user"] == "moderator") {
									echo '
										<option value="moderator">Moderator</option>
										<option value="redaktor">Redaktor</option>
										<option value="współpracownik">Współpracownik</option>
										<option value="administrator" >Administrator</option>
										<option value="właśćiciel" >Właśćiciel</option>
									';
								}
								
								if (BM_SETTINGS["bm_new_user"] == "administrator") {
									echo '
										<option value="administrator" >Administrator</option>
										<option value="moderator">Moderator</option>
										<option value="redaktor">Redaktor</option>
										<option value="współpracownik">Współpracownik</option>
										<option value="właśćiciel" >Właśćiciel</option>
									';
								}
								
								if (BM_SETTINGS["bm_new_user"] == "właśćiciel") {
									echo '
										<option value="właśćiciel" >Właśćiciel</option>
										<option value="administrator" >Administrator</option>
										<option value="moderator">Moderator</option>
										<option value="redaktor">Redaktor</option>
										<option value="współpracownik">Współpracownik</option>
									';
								}
							?>
							</select>
						</section>
					</section>
					<section class="tsr">					
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Język Witryny:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<select name="jezyk_witryny" class="select" utocomplete="off">
								<option value="pl_PL">Polski</option>
							</select>
						</section>
					</section>
					<section class="tsr">					
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Strfa Czasowa:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<select name="strefa_czasowa_witryny" class="select" utocomplete="off">
								<option value="warsaw">Warszawa</option>
							</select>
						</section>
					</section>
					<section class="tsr">					
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Format Daty:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="date_witryny" class="input" placeholder="m.d.Y" value="<?php echo BM_SETTINGS["bm_date"]; ?>" autocomplete="off"/>
						</section>
					</section>
					<section class="tsr">					
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Format Godziny:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="time_witryny" class="input" placeholder="H:i" value="<?php echo BM_SETTINGS["bm_time"]; ?>" autocomplete="off"/>
						</section>
					</section>
					<section class="tsr">					
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Nick Głównego Administratora Witryny:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="admin_witryny" class="input" placeholder="Black Min" value="<?php echo BM_STATUS["bm_installation_admin"]; ?>" autocomplete="off"/>
							<label class="fs-70">Nick głównego administratora witryny. Będzie on wykorzystywany do kontaktu w razie problemów z stroną (Dostęp Tylko dla administracji).</label>
						</section>
					</section>
					<section class="tsr">					
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Email Głównego Administratora Witryny:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="email" name="email_admin_witryny" class="input" placeholder="Black Min" value="<?php echo BM_STATUS["bm_admin_mail"]; ?>" autocomplete="off"/>
							<label class="fs-70">Email głównego administratora witryny. Będzie on wykorzystywany do kontaktu w razie problemów z stroną (Będzie wyświetlany w razie ploblemów z witryną).</label>
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
		var url_serwera_bm = $('input[name="url_serwera_bm"]').val();
		var url_witryny_bm = $('input[name="url_witryny_bm"]').val();
		var mail_witryny = $('input[name="mail_witryny"]').val();
		var ranga_witryny = $('select[name="ranga_witryny"]').val();
		var jezyk_witryny = $('select[name="jezyk_witryny"]').val();
		var strefa_czasowa_witryny = $('select[name="strefa_czasowa_witryny"]').val();
		var date_witryny = $('input[name="date_witryny"]').val();
		var time_witryny = $('input[name="time_witryny"]').val();
		var admin_witryny = $('input[name="admin_witryny"]').val();
		var email_admin_witryny = $('input[name="email_admin_witryny"]').val();
		$.ajax({
			type:"POST",
			url:"insert/update-ustawienia-serwera-black-min.php",
			data:{
				url_serwera_bm:url_serwera_bm,
				url_witryny_bm:url_witryny_bm,
				mail_witryny:mail_witryny,
				ranga_witryny:ranga_witryny,
				jezyk_witryny:jezyk_witryny,
				strefa_czasowa_witryny:strefa_czasowa_witryny,
				date_witryny:date_witryny,
				time_witryny:time_witryny,
				admin_witryny:admin_witryny,
				email_admin_witryny:email_admin_witryny,
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
		</article>
	</main>

	<?php require_once "admin-stopka.php"; ?>

	<script>
	$(document).ready(function() { 
		console.clear()
	});
	</script>	

</body>
</html>