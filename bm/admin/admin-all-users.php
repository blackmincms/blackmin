<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyświetlania wszystkich użytkowników i zarządzanie nimi
	
	Black Min cms,
	
	#plik: 2.0
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
	// renderowanie strony która odpowiada za wszystkich użytkowników
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Wszyscy Użytkownicy - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Wszyscy Użytkownicy - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0 ">
					
					<form accept-charset="UTF-8"  action="all-uzytkownicy" method="post" id="blackminload">	
						<section class="tsr tsr-p-5px tsr-mb-10">
							<section class="col-ms15 col-ms15-5 col-ms30-4 col-ms30-3 col-ms40-2 col-ms100-1 tsr-p-5px">
								<select name="plec" id="plec">
									<option value="all">wszystkie kategorie</option>
									<option value="Mężczyzna">Mężczyzna</option>
									<option value="Kobieta">Kobieta</option>
								</select>
							</section>
							<section class="col-ms15 col-ms15-5 col-ms30-4 col-ms30-3 col-ms60-2 col-ms100-1 tsr-p-5px">
								<select name="dostep" id="dostep">
									<option value="all">każdy rodzaj dostępu</option>
									<option value="dostęp">dostęp</option>
									<option value="brak_dostępu">brak dostępu</option>
									<option value="konto_zawieszone" >konto zawieszone</option>
									<option value="zablokowano" >zablokowano</option>
									<option value="zbanowano" >zbanowano</option>
								</select>
							</section>
							<section class="col-ms15 col-ms15-5 col-ms40-4 col-ms40-3 col-ms70-2 col-ms100-1 tsr-p-5px">
								<select name="ranga" id="ranga">
									<option value="all">każdy użytkownik</option>
									<option value="użytkownik">użytkownik</option>
									<option value="współpracownik">współpracownik</option>
									<option value="redaktor" >redaktor</option>
									<option value="moderator" >moderator</option>
									<option value="administrator" >administrator</option>
									<option value="właśćiciel" >właśćiciel</option>
								</select>
							</section>
							<section class="col-ms10 col-ms10-5 col-ms25-4 col-ms25-3 col-ms30-2 col-ms100-1 tsr-p-5px">
								<input type="number" name="ile_load" class="input" value="25" placeholder="ile załadować?">
							</section>
							<section class="col-ms45 col-ms45-5 col-ms75-4 col-ms75-3 col-ms100-2 col-ms100-1 tsr-p-5px">
								<section class="tsr tsr-position-relative">
									<input type="search" name="szukaj" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj">
									<section type="search" name="szukaj" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10" id="load_post">
										<img src="<?php echo BM_SETTINGS["url_server"];?>pliki/ikony/szukaj.png">
									</section>
								</section>
							</section>
						</section>
					</form>	
						
					<section class="tsr checkall" id="blackminload_container">							
					</section>				
				
				</section>
			</section>
		</section>
	</main>

	<?php require_once "admin-stopka.php"; ?>

</body>
</html>