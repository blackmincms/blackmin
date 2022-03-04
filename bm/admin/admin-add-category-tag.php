<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy renderowania strony odpowiedzialnej za dodawanie nowych kategori i tagów 
	
	Black Min cms,
	
	#plik: 2.0
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Dodaj Kategorie/Tag - Admin Panel - <?php echo $black_min ?></title>
	
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
					<form accept-charset="UTF-8"  action="add-kategoria-tag" method="post" id="blackminsend" autocomplete="off">	
					
					<section class="tsr-inp"></section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Pełny Tytuł:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="tytul" class="input" placeholder="Black Min" autocomplete="off"/>
						</section>
					</section>	
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Uproszczony Tytuł:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="tytul_skrucony" class="input" placeholder="Black Min CMS" autocomplete="off"/>
						</section>
					</section>
					<section class="tsr">					
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Kategoria/Tag:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<select name="kategoria">
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
							<textarea name="opis" placeholder="Wpisz Opis" autocomplete="off"></textarea>
						</section>
					</section>	
					<section class="tsr tsr-inp tsr-mt-50">
						<button type="submit" value="Dodaj Kategorie/Post" class="input buttom" id="submit_data" >Dodaj Kategorie/Tag</button>
					</section>	
					
					<section class="tsr tsr-inp tsr-mt-50">
						<div id="blackminsend_container"></div>
					</section>			
					
					</form>	
				</section>
				</section>
					
				</section>
			</section>
		</section>
	</main>

	<?php require_once "admin-stopka.php"; ?>

</body>
</html>