<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy renderowania strony odpowiedzialnej za dodawanie nowych kategori i tagów 
	
	Black Min cms,
	
	#plik: 1.3
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Dodaj Kategoria/Tag - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Dodaj Kategorie/Tag - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
					

				<section class="tsr tsr-mt-20">
					<form accept-charset="UTF-8"  action="" method="post" id="get_data" autocomplete="off">	
					
					<section class="tsr-inp"></section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Pełny Tytuł:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="tytul_KT" class="input" placeholder="Black Min" autocomplete="off"/>
						</section>
					</section>	
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Uproszczony Tytuł:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="tytul_skrucony_KT" class="input" placeholder="Black Min CMS" autocomplete="off"/>
						</section>
					</section>
					<section class="tsr">					
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Kategoria/Tag:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<select name="kategoria_KT">
								<option value="kategoria">kategoria</option>
								<option value="tag">tag</option>
							</select>
						</section>
					</section>
					<section class="tsr">
						<section class="tsr-inp tsr-mt-40 l-0">
							Opis:
						</section>
						<section class="tsr-inp tsr-mt-20">
							<textarea name="opis_KT" id="editor1" rows="10" cols="80" placeholder="Wpisz Opis" autocomplete="off"></textarea>
						</section>
					</section>	
					<section class="tsr tsr-inp tsr-mt-50">
					<button type="submit" value="Dodaj Kategorie/Post" class="input buttom" id="submit_post" >Dodaj Kategorie/Tag</button>
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
					var tytul_KT = $('input[name="tytul_KT"]').val();
					var tytul_skrucony_KT = $('input[name="tytul_skrucony_KT"]').val();
					var kategoria_KT = $('select[name="kategoria_KT"]').val();
					var opis_KT = $('textarea[name="opis_KT"]').val();
					$.ajax({
						type:"POST",
						url:"insert/add-kategoria-tag.php",
						data:{
							tytul_KT:tytul_KT,
							tytul_skrucony_KT:tytul_skrucony_KT,
							kategoria_KT:kategoria_KT,
							opis_KT:opis_KT,
						}
					})
					.done(function(info){
						$('#contajner_post_add').text("");
						$('#contajner_post_add').append(info);
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

</body>
</html>