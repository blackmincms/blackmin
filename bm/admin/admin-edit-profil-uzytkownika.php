<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do renderowania strony odpowiedzialnej za edytowanie swojego profilu
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";

	$id = $_GET['edit'];

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
				//$id = $row['id'];
				$nick = $row['nick'];
				$imie = $row['imie'];
				$nazwisko = $row['nazwisko'];
				$mail = $row['email'];
				$plec = $row['plec'];
				$date_dolonczenia = $row['date_dolonczenia'];
				$avatar = $row['avatar'];
				$token = $row['token'];
				$dostep = $row['dostep'];
				$ranga = $row['ranga'];
				$online = $row['online'];
				$ostatnio_aktywny = $row['ostatnio_aktywny'];
					
			$polaczenie->close();
		}
		
	}
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań póżniej!</span>';
	}	

	// pokazwywanie dostępu do konta użytkownika
	if ($dostep == "aktywacja_konta") {
		$dostep_option = '<option value="aktywacja_konta">Aktywacja Konta</option>';
	}
	
	if ($dostep == "dostęp") {
		$dostep_option = '<option value="dostęp">Dostęp</option>';
	}
	
	if ($dostep == "brak_dostępu") {
		$dostep_option = '<option value="brak_dostępu">Brak Dostępu</option>';
	}
	
	if ($dostep == "zawieszony") {
		$dostep_option = '<option value="zawieszony" >Zawieszony</option>';
	}
	
	if ($dostep == "zablokowany") {
		$dostep_option = '<option value="zablokowany" >Zablokowany</option>';
	}
	
	if ($dostep == "zbanowany") {
		$dostep_option = '<option value="zbanowany" >Zbanowany</option>';
	}
	
	// pokazywanie rangi yżytkownika
	if ($ranga == "współpracownik") {
		$ranga_option = '<option value="współpracownik">Współpracownik</option>';
	}
	
	if ($ranga == "redaktor") {
		$ranga_option = '<option value="redaktor">Redaktor</option>';
	}
	
	if ($ranga == "moderator") {
		$ranga_option = '<option value="moderator">Moderator</option>';
	}
	
	if ($ranga == "administrator") {
		$ranga_option = '<option value="administrator" >Administrator</option>';
	}
	
	if ($ranga == "właśćiciel") {
		$ranga_option = '<option value="właśćiciel" >Właśćiciel</option>';
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
	
	<main class="container-right">
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
						<section class="tsr ">
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
						<section class="tsr dostep">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Dostęp:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<select name="dostep" class="tsr-display-none" id="dostep-edit">
									<?php echo $dostep_option?>
									<option value="aktywacja_konta">Aktywacja Konta</option>
									<option value="dostęp">Dostęp</option>
									<option value="brak_dostępu">Brak Dostępu</option>
									<option value="zawieszony" >Zawieszony</option>
									<option value="zablokowany" >Zablokowany</option>
									<option value="zbanowany" >Zbanowany</option>
								</select>
								<section class="tsr tsr-fl tsr-text-algin-left " id="dostep">
									<?php echo $dostep;?>
								</section>
							</section>
						</section>
						<section class="tsr ranga">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Ranga:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<select name="ranga" class="tsr-display-none" id="ranga-edit">
									<?php echo $ranga_option?>
									<option value="współpracownik">Współpracownik</option>
									<option value="redaktor">Redaktor</option>
									<option value="moderator">Moderator</option>
									<option value="administrator" >Administrator</option>
									<option value="właśćiciel" >Właśćiciel</option>
								</select>
								<section class="tsr tsr-fl tsr-text-algin-left " id="ranga">
									<?php echo $ranga;?>
								</section>
							</section>
						</section>
						<section class="tsr" id="online">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Online:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<section class="tsr tsr-fl tsr-text-algin-left">
									<?php echo $online;?>
								</section>
							</section>
						</section>
						<section class="tsr" id="ostatnio_aktywny">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Ostatnio Aktywny:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<section class="tsr tsr-fl tsr-text-algin-left">
									<?php echo $ostatnio_aktywny;?>
								</section>
							</section>
						</section>	
						<section class="tsr" id="token">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Token:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<section class="tsr tsr-fl tsr-text-algin-left">
									<?php echo $token;?>
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
			$("#dostep-edit").toggleClass("tsr-display-none");
			$("#dostep").toggleClass("tsr-display-none");
			$("#online").toggleClass("tsr-display-none");
			$("#ostatnio_aktywny").toggleClass("tsr-display-none");
			$("#token").toggleClass("tsr-display-none");
			$("#ranga-edit").toggleClass("tsr-display-none");
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
			var dostep= $('select[name="dostep"]').val();
			var ranga= $('select[name="ranga"]').val();
			
			var wszystko_ok = true;
			
			if (nick == nick_spr && imie == imie_spr && nazwisko == nazwisko_spr && avatar == avatar_spr && mail == mail_spr && dostep == "" && ranga == "") {
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

			if (ranga == "") {
				$(".rola").effect( "shake" );
				$(".rola").append('<section class="tsr tsr-alert tsr-alert-error"> Nie wypełniłeś wszystkich informacji </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(500).hide(500, function () { $(this).remove(); });
				var wszystko_ok = false;
			}	

			if (dostep == "") {
				$(".dostep").effect( "shake" );
				$(".dostep").append('<section class="tsr tsr-alert tsr-alert-error"> Nie wypełniłeś wszystkich informacji </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(500).hide(500, function () { $(this).remove(); });
				var wszystko_ok = false;
			}				
			
			var id = "<?php echo $id; ?>";
		
			if (wszystko_ok == true) {
		
				$.ajax({
					type:"POST",
					url:"insert/edit-profil-uzytkownika.php",
					data:{
						id:id,
						nick_spr:nick_spr,
						mail_spr:mail_spr,
						nick:nick,
						imie:imie,
						nazwisko:nazwisko,
						avatar:avatar,
						mail:mail,
						dostep:dostep,
						ranga:ranga,
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