<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do renderowania strony odpowiedzialnej za dodawanie nowego użytkownika do strony
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Dodaj Nowego Użytkownika - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Dodaj Nowego Użytkownika - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
					
					<section class="tsr tsr-mt-20">
						<form accept-charset="UTF-8"  action="" method="post" id="add_post" autocomplete="off">	
						
							<section class="tsr nick">
								<section class="col-inp-25 tsr-p-10px fs-90 " >
									<span class="tsr-vertical-align-sub">
										Nick:
									</span>
								</section>
								<section class="col-inp-75 tsr-p-10px fs-90" >
									<input type="text" name="nick" class="input" placeholder="nick" autocomplete="off"/>
								</section>
							</section>	
							<section class="tsr imie">
								<section class="col-inp-25 tsr-p-10px fs-90 " >
									<span class="tsr-vertical-align-sub">
										Imie:
									</span>
								</section>
								<section class="col-inp-75 tsr-p-10px fs-90" >
									<input type="text" name="imie" class="input" placeholder="imie" autocomplete="off"/>
								</section>
							</section>
							<section class="tsr nazwisko">
								<section class="col-inp-25 tsr-p-10px fs-90 " >
									<span class="tsr-vertical-align-sub">
										Nazwisko:
									</span>
								</section>
								<section class="col-inp-75 tsr-p-10px fs-90" >
									<input type="text" name="nazwisko" class="input" placeholder="nazwisko" autocomplete="off"/>
								</section>
							</section>
							<section class="tsr mail">
								<section class="col-inp-25 tsr-p-10px fs-90 " >
									<span class="tsr-vertical-align-sub">
										Mail:
									</span>
								</section>
								<section class="col-inp-75 tsr-p-10px fs-90" >
									<input type="email" name="mail" class="input" placeholder="mail" autocomplete="off"/>
								</section>
							</section>
							<section class="tsr plec">
								<section class="col-inp-25 tsr-p-10px fs-90 " >
									<span class="tsr-vertical-align-sub">
										Płeć:
									</span>
								</section>
								<section class="col-inp-75 tsr-p-10px fs-90" >
									<section class="col-inp-50 tsr-p-10px fs-90" >
										<input type="radio" id="Mezczyzna" name="plec" value="Mężczyzna" class="radio" checked autocomplete="off">
										<label for="Mezczyzna">Mężczyzna</label>
									</section>
									<section class="col-inp-50 tsr-p-10px fs-90" >
										<input type="radio" id="kobieta" name="plec" value="Kobieta" class="radio" autocomplete="off">
										<label for="kobieta">kobieta</label>
									</section>
								</section>
							</section>
							<section class="tsr haslo">
								<section class="col-inp-25 tsr-p-10px fs-90 " >
									<span class="tsr-vertical-align-sub">
										Hasło:
									</span>
								</section>
								<section class="col-inp-75 tsr-p-10px fs-90" >
									<input type="password" name="haslo" class="input" placeholder="hasło" autocomplete="off"/>
								</section>
							</section>
							<section class="tsr haslo2">
								<section class="col-inp-25 tsr-p-10px fs-90 " >
									<span class="tsr-vertical-align-sub">
										Powtórz Hasło:
									</span>
								</section>
								<section class="col-inp-75 tsr-p-10px fs-90" >
									<input type="password" name="haslo2" class="input" placeholder="hasło" autocomplete="off"/>
								</section>
							</section>
							<section class="tsr rola">					
								<section class="col-inp-25 tsr-p-10px fs-90 " >
									<span class="tsr-vertical-align-sub">
										Ranga:
									</span>
								</section>
								<section class="col-inp-75 tsr-p-10px fs-90" >
									<select name="rola" id="rola">
										<option value="współpracownik">Współpracownik</option>
										<option value="redaktor">Redaktor</option>
										<option value="moderator">Moderator</option>
										<option value="administrator" >Administrator</option>
										<option value="właśćiciel" >Właśćiciel</option>
									</select>
								</section>
							</section>
							<section class="tsr tsr-inp tsr-mt-50">
								<button type="submit" value="Dodaj Użytkownika" class="input buttom" id="submit_post" >Dodaj Użytkownika</button>
							</section>	
							
							<section class="tsr tsr-inp tsr-mt-50">
								<div id="contajner_user_add"></div>
							</section>			
						
						</form>	
					</section>
				</section>
	
	<script type="text/javascript">
		// Pobieranie danych z pormularza i wysłanie metodą post do pliku sprawdzającego przez ajax
		
		$('#submit_post').click('submit', function(evt1){	
		evt1.preventDefault();
		
			var nick= $('input[name="nick"]').val();
			var imie= $('input[name="imie"]').val();
			var nazwisko= $('input[name="nazwisko"]').val();
			var mail= $('input[name="mail"]').val();
			var plec= $('input[name="plec"]:checked').val();
			var haslo= $('input[name="haslo"]').val();
			var haslo2= $('input[name="haslo2"]').val();
			var rola= $('select[name="rola"]').val();
			
			var wszystko_ok = true;
			
			if (nick == "") {
				$(".nick").effect( "shake" );
				$(".nick").append('<section class="tsr tsr-alert tsr-alert-error"> Nie wypełniłeś wszystkich informacji </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(500).hide(500, function () { $(this).remove(); });
				var wszystko_ok = false;
			}
			
			if (imie == "") {
				$(".imie").effect( "shake" );
				$(".imie").append('<section class="tsr tsr-alert tsr-alert-error"> Nie wypełniłeś wszystkich informacji </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(500).hide(500, function () { $(this).remove(); });
				var wszystko_ok = false;
			}
			
			if (nazwisko == "") {
				$(".nazwisko").effect( "shake" );
				$(".nazwisko").append('<section class="tsr tsr-alert tsr-alert-error"> Nie wypełniłeś wszystkich informacji </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(500).hide(500, function () { $(this).remove(); });
				var wszystko_ok = false;
			}
			
			if (mail == "") {
				$(".mail").effect( "shake" );
				$(".mail").append('<section class="tsr tsr-alert tsr-alert-error"> Nie wypełniłeś wszystkich informacji </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(500).hide(500, function () { $(this).remove(); });
				var wszystko_ok = false;
			}
			
			if (plec == "") {
				$(".plec").effect( "shake" );
				;$(".plec").append('<section class="tsr tsr-alert tsr-alert-error"> Nie wypełniłeś wszystkich informacji </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(500).hide(500, function () { $(this).remove(); });
				var wszystko_ok = false;
			}
			
			if (haslo == "") {
				$(".haslo").effect( "shake" );
				;$(".haslo").append('<section class="tsr tsr-alert tsr-alert-error"> Nie wypełniłeś wszystkich informacji </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(500).hide(500, function () { $(this).remove(); });
				var wszystko_ok = false;
			}
			
			if (haslo2 == "") {
				$(".haslo2").effect( "shake" );
				;$(".haslo2").append('<section class="tsr tsr-alert tsr-alert-error"> Nie wypełniłeś wszystkich informacji </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(500).hide(500, function () { $(this).remove(); });
				var wszystko_ok = false;
			}
			
			if (haslo != haslo2) {
				$(".haslo2").effect( "shake" );
				$(".haslo2").append('<section class="tsr tsr-alert tsr-alert-error"> Hasła są inne! </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(500).hide(500, function () { $(this).remove(); });
				var wszystko_ok = false;
			}
			
			if (rola == "") {
				$(".rola").effect( "shake" );
				$(".rola").append('<section class="tsr tsr-alert tsr-alert-error"> Nie wypełniłeś wszystkich informacji </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(500).hide(500, function () { $(this).remove(); });
				var wszystko_ok = false;
			}	
		
			if (wszystko_ok == true) {
		
				$.ajax({
					type:"POST",
					url:"insert/add-uzytkownik.php",
					data:{
						nick:nick,
						imie:imie,
						nazwisko:nazwisko,
						mail:mail,
						plec:plec,
						haslo:haslo,
						haslo2:haslo2,
						rola:rola,
					}
				})
				.done(function(info){
					$('#add_post').append(info);
					$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
				})
				.fail(function(){
					alert("Wystąpił błąd. Spróbuj ponownie później");
				});
			}	
				
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