<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do renderowania strony odpowiedzialnej za pokazanie konta użytkownika i możliwośći edycji
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";

	$id = htmlspecialchars($_SESSION['id']);

	mysqli_report(MYSQLI_REPORT_STRICT);
		
	try 
	{
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{		
			mysqli_query($polaczenie, "SET CHARSET utf8");
			mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");		

			$rezultat = "SELECT * FROM `".$prefix_table."bm_uzytkownicy` WHERE `id` = '$id'";
			$wynik = $polaczenie->query($rezultat);
				
				$ile = mysqli_num_rows($wynik);
				
				$row = mysqli_fetch_assoc($wynik);
				$nick = $row['nick'];
				$imie = $row['imie'];
				$nazwisko = $row['nazwisko'];
				$mail = $row['email'];
				$plec = $row['plec'];
				$date_dolonczenia = $row['date_dolonczenia'];
				$avatar = $row['avatar'];
				$ranga = $row['ranga'];
					
			$polaczenie->close();
		}
		
	}
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań póżniej!</span>';
	}	
	
?>

<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Profil - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<header class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Profil - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
					
					<section class="tsr tsr-mt-20">
						
						<section class="tsr nick">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Nick:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="nick" class="input tsr-display-none" placeholder="nick" autocomplete="off" value="<?php echo $nick;?>" id="nick-edit"/>
								<section class="tsr tsr-fl tsr-text-algin-left" id="nick">
									<?php echo $nick;?>
								</section>
							</section>
						</section>	
						<section class="tsr imie">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Imie:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="imie" class="input tsr-display-none" placeholder="imie" autocomplete="off" value="<?php echo $imie;?>" id="imie-edit"/>
								<section class="tsr tsr-fl tsr-text-algin-left" id="imie">
									<?php echo $imie;?>
								</section>
							</section>
						</section>
						<section class="tsr nazwisko">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Nazwisko:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="nazwisko" class="input tsr-display-none" placeholder="imie" autocomplete="off" value="<?php echo $nazwisko;?>" id="nazwisko-edit"/>
								<section class="tsr tsr-fl tsr-text-algin-left" id="nazwisko">
									<?php echo $nazwisko;?>
								</section>
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Avatar:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="avatar" class="input tsr-display-none" placeholder="avatar" autocomplete="off" value="<?php echo $avatar;?>" id="avatar-edit"/>
								<section class="tsr tsr-fl tsr-text-algin-left " id="avatar">
									<img src="<?php echo $avatar;?>" class="img avatar" />
								</section>
							</section>
						</section>
						<section class="tsr mail">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Mail:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="email" name="mail" class="input tsr-display-none" placeholder="mail" autocomplete="off" value="<?php echo $mail;?>" id="mail-edit"/>
								<section class="tsr tsr-fl tsr-text-algin-left" id="mail">
									<?php echo $mail;?>
								</section>
							</section>
						</section>
						<section class="tsr " id="plec">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Płeć:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<section class="tsr tsr-fl tsr-text-algin-left">
									<?php echo $plec;?>
								</section>
							</section>
						</section>
						<section class="tsr" id="date_dolonczenia">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Data dołączenia:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<section class="tsr tsr-fl tsr-text-algin-left">
									<?php echo $date_dolonczenia;?>
								</section>
							</section>
						</section>
						<section class="tsr haslo tsr-display-none" id="haslo-edit">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Hasło:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="password" name="haslo" class="input" placeholder="hasło" autocomplete="off"/>
							</section>
						</section>
						<section class="tsr haslo2 tsr-display-none" id="haslo2-edit">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Powtórz Hasło:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="password" name="haslo2" class="input" placeholder="hasło" autocomplete="off"/>
							</section>
						</section>
						<section class="tsr rola" id="ranga">					
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Ranga:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<section class="tsr tsr-fl tsr-text-algin-left">
									<?php echo $ranga;?>
								</section>								
							</section>
						</section>
						
						<section class="tsr tsr-inp tsr-mt-50">
							<button type="submit" value="Edytuj Dane" class="input buttom" id="edytuj_dane" >Edytuj Dane</button>
						</section>
						
						<form accept-charset="UTF-8"  action="" method="post" id="add_post" autocomplete="off">	
						
							<section class="tsr tsr-inp tsr-mt-10 tsr-display-none" id="zapisz_dane">
								<button type="submit" value="Zapisz Dane" class="input buttom" id="submit_post" >Zapisz Dane</button>
							</section>	
							
							<section class="tsr tsr-inp tsr-mt-50">
								<div id="contajner_user_add"></div>
							</section>			
						
						</form>	
					</section>
				</section>
	
	<script type="text/javascript">
		// skrypt do edycji danych użytkownika
		// pokazywanie i howanie pul odpowiedzialnych za edycje profilu
		$( document ).on( "click", "#edytuj_dane", function(oEvent) {
			$("#nick-edit").toggleClass("tsr-display-none");
			$("#nick").toggleClass("tsr-display-none");
			$("#imie-edit").toggleClass("tsr-display-none");
			$("#imie").toggleClass("tsr-display-none");
			$("#nazwisko-edit").toggleClass("tsr-display-none");
			$("#nazwisko").toggleClass("tsr-display-none");
			$("#avatar-edit").toggleClass("tsr-display-none");
			$("#avatar").toggleClass("tsr-display-none");
			$("#mail-edit").toggleClass("tsr-display-none");
			$("#mail").toggleClass("tsr-display-none");
			$("#plec").toggleClass("tsr-display-none");
			$("#date_dolonczenia").toggleClass("tsr-display-none");
			$("#ranga").toggleClass("tsr-display-none");
			$("#haslo-edit").toggleClass("tsr-display-none");
			$("#haslo2-edit").toggleClass("tsr-display-none");
			$("#zapisz_dane").toggleClass("tsr-display-none");
			
			// pobieranie napisu buttona
			var zmiana = $("#edytuj_dane").text();
			
			// zmiana tekstu butona po kliknięciu
			if (zmiana === "Edytuj Dane") {
				$("#edytuj_dane").text("Anuluj Edycje Danych");
			}else{
				$("#edytuj_dane").text("Edytuj Dane");
			}
			
		});

		// Pobieranie danych z pormularza i wysłanie metodą post do pliku sprawdzającego przez ajax
		
		$('#submit_post').click('submit', function(evt1){	
		evt1.preventDefault();
		
			var nick_spr= "<?php echo $nick;?>";
			var imie_spr= "<?php echo $imie;?>";
			var nazwisko_spr= "<?php echo $nazwisko;?>";
			var avatar_spr= "<?php echo $avatar;?>";
			var mail_spr= "<?php echo $mail;?>";
			var nick= $('input[name="nick"]').val();
			var imie= $('input[name="imie"]').val();
			var nazwisko= $('input[name="nazwisko"]').val();
			var avatar= $('input[name="avatar"]').val();
			var mail= $('input[name="mail"]').val();
			var haslo= $('input[name="haslo"]').val();
			var haslo2= $('input[name="haslo2"]').val();
			
			var wszystko_ok = true;
			
			if (nick == nick_spr && imie == imie_spr && nazwisko == nazwisko_spr && avatar == avatar_spr && mail == mail_spr && haslo == "" && haslo2 == "") {
				$("#zapisz_dane").effect( "shake" );
				$("#zapisz_dane").append('<section class="tsr tsr-alert tsr-alert-error"> Pasuje coś zmienić przed zapisaniem! nie sądzisz? </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(500).hide(500, function () { $(this).remove(); });
				var wszystko_ok = false;
			}
			
			if (nick === nick_spr) {
				var nick_spr = true;
			}else{
				var nick_spr = false;
			}
			
			if (mail === mail_spr) {
				var mail_spr = true;
			}else{
				var mail_spr = false;
			}
			
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
			
			if (haslo != haslo2) {
				$(".haslo2").effect( "shake" );
				$(".haslo2").append('<section class="tsr tsr-alert tsr-alert-error"> Hasła są inne! </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(500).hide(500, function () { $(this).remove(); });
				var wszystko_ok = false;
			}	
		
			if (wszystko_ok == true) {
		
				$.ajax({
					type:"POST",
					url:"insert/edit-profil.php",
					data:{
						nick_spr:nick_spr,
						mail_spr:mail_spr,
						nick:nick,
						imie:imie,
						nazwisko:nazwisko,
						avatar:avatar,
						mail:mail,
						haslo:haslo,
						haslo2:haslo2,
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
	</header>

	<?php require_once "admin-stopka.php"; ?>

	<script>
	$(document).ready(function() { 
		console.clear()
	});
	</script>	

</body>
</html>