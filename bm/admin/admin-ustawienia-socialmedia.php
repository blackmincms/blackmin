<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy renderowania strony odpowiedzialnej za aktulizowanie ustawień socialmediów 
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";

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
				
			$rezultat2 = "SELECT * FROM `".$prefix_table."bm_postmeta`";
			$wynik2 = $polaczenie->query($rezultat2);
			
			$ile2 = mysqli_num_rows($wynik2);
				
				for ($i=0; $i < $ile2; $i++) {
					$row2 = mysqli_fetch_assoc($wynik2);
					$bm_nazwa = $row2['bm_nazwa'];
					
					if ($bm_nazwa == "facebook") {
						$bm_social_fb = $row2['bm_wartosc'];
					}
					
					if ($bm_nazwa == "youtube") {
						$bm_social_yt = $row2['bm_wartosc'];
					}
					
					if ($bm_nazwa == "google_plus") {
						$bm_social_google_plus = $row2['bm_wartosc'];
					}
					
					if ($bm_nazwa == "instagram") {
						$bm_social_instagram = $row2['bm_wartosc'];
					}
					
					if ($bm_nazwa == "twitter") {
						$bm_social_twitter = $row2['bm_wartosc'];
					}
					
				}	
					
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

	<title>Aktualizacja Ustawień SocialMediów - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Aktualizacja Ustawień SocialMediów - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
					
					<section class="tsr tsr-mt-20">
						<form accept-charset="UTF-8"  action="" method="post" id="add_post" autocomplete="off">	
						
						<section class="tsr">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Facebook:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="bm_social_fb" class="input" placeholder="Black Min CMS" value="<?php echo $bm_social_fb; ?>" autocomplete="off"/>
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Youtube:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="bm_social_yt" class="input" placeholder="Black Min CMS" value="<?php echo $bm_social_yt; ?>" autocomplete="off"/>
							</section>
						</section>
						<section class="tsr">					
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Google+:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="bm_social_google_plus" class="input" placeholder="Black Min" value="<?php echo $bm_social_google_plus; ?>" autocomplete="off"/>
							</section>
						</section>
						<section class="tsr">					
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Insagram:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="bm_social_instagram" class="input" placeholder="Black Min" value="<?php echo $bm_social_instagram; ?>" autocomplete="off"/>
							</section>
						</section>
						<section class="tsr">					
							<section class="col-inp-25 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Twitter:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="bm_social_twitter" class="input" placeholder="Black Min" value="<?php echo $bm_social_twitter; ?>" autocomplete="off"/>
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
		var bm_social_fb = $('input[name="bm_social_fb"]').val();
		var bm_social_yt = $('input[name="bm_social_yt"]').val();
		var bm_social_google_plus = $('input[name="bm_social_google_plus"]').val();
		var bm_social_instagram = $('input[name="bm_social_instagram"]').val();
		var bm_social_twitter = $('input[name="bm_social_twitter"]').val();
		$.ajax({
			type:"POST",
			url:"insert/update-ustawienia-socialmedia.php",
			data:{
				bm_social_fb:bm_social_fb,
				bm_social_yt:bm_social_yt,
				bm_social_google_plus:bm_social_google_plus,
				bm_social_instagram:bm_social_instagram,
				bm_social_twitter:bm_social_twitter,
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