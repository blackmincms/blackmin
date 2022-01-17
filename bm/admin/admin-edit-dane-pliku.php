<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy renderowania strony odpowiedzialnej za edytowanie danych bazy plików
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";

	$id_edit = htmlspecialchars($_GET['edit']);

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

			if ($rezultat = $polaczenie->query(
			sprintf("SELECT * FROM `".$prefix_table."bm_filemeta` WHERE `id` = '$id_edit'")
			 ))
			{
				$ile = mysqli_num_rows($rezultat);
				
				$row = mysqli_fetch_assoc($rezultat);
				$id = $row['id'];
				$autor_id = $row['bm_autor'];
				$nazwa = $row['bm_nazwa'];
				$nazwa_zmiany = $row['bm_nazwa_zmiany'];
				$datetime_wgrania = $row['bm_datetime_wgrania'];
				$datetime_zmiany = $row['bm_datetime_zmiany'];
				$opis = $row['bm_opis'];
				$typ_pliku = $row['bm_typ_pliku'];
				$bm_miniaturka = $row['bm_miniaturka'];
				$folder = $row['bm_folder'];
				$sciezka = $row['bm_sciezka'];	
			};	
			
			if ($opis === "") {
				$opis = "Brak opisu";
			}
			
			// rozbjianie na czyniki pierwsze rozszerzenia pobranego z tablicy dysku
			$reserch_type = explode("/", $typ_pliku);
			
			// sprawdzenie poprawnośći rozszerzenia
			// zamiana grafiki jeżeli rozpoznano poprawnie rozszerzenie
			if ($reserch_type[0] == "image") {
				$sciezka = $sciezka;
			};
			
			if ($reserch_type[0] == "application") {
				$sciezka =  $ustawienia_bm["bm_url_server"]."pliki/banner/placeholder.jpg";
				
				if ($reserch_type[1] == "rar") {
					$sciezka =  $ustawienia_bm["bm_url_server"]."pliki/banner/placeholder.jpg";
				}
			};
			
			if ($reserch_type[0] == "text") {
				$sciezka =  $ustawienia_bm["bm_url_server"]."pliki/banner/placeholder.jpg";
			};
			
			if ($reserch_type[0] == "audio") {
				$sciezka =  $ustawienia_bm["bm_url_server"]."pliki/banner/placeholder.jpg";
			};
			
			if ($reserch_type[0] == "video") {
				$sciezka =  $ustawienia_bm["bm_url_server"]."pliki/banner/placeholder.jpg";
			};						
			
			if ($datetime_wgrania === $datetime_zmiany) {
				$data_all = '<section class="tsr fs-100">Opublikowano: '.$datetime_wgrania.'</section>';
			}else{
				$data_all = '<section class="tsr fs-100">Edytowano Plik Dnia: '.$datetime_zmiany.'</section>';
			}
			
			$rezultat2 = "SELECT * FROM `bm_uzytkownicy` WHERE `id` = '$autor_id'";
			$wynik2 = $polaczenie->query($rezultat2);
			
			$row2 = mysqli_fetch_assoc($wynik2);
			$autor = $row2['nick'];
			
			// zakończenie połączenia z bazą danych
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

	<title>Edytuj Dane Pliku - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<article class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Edytuj Dane Pliku - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
					

				<section class="tsr">
					<form accept-charset="UTF-8"  action="" method="post" id="add_post" autocomplete="off">	
					
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Pełny Tytuł:
						</section>
						<section class="col-inp-75">
							<?php echo $nazwa; ?>
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Pełny Orginalny Tytuł:
						</section>
						<section class="col-inp-75">
							<?php echo $nazwa_zmiany; ?>
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Folder:
						</section>
						<section class="col-inp-75">
							<?php echo $folder; ?>
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Autor Pliku:
						</section>
						<section class="col-inp-75">
							<?php echo $autor; ?>
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Opis Pliku:
						</section>
						<section class="col-inp-75">
							<?php echo $opis; ?>
						</section>
					</section>					
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Data Wgrania:
						</section>
						<section class="col-inp-75">
							<?php echo $data_all; ?>
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Rozszerzenie Pliku:
						</section>
						<section class="col-inp-75">
							<?php echo $typ_pliku; ?>
						</section>
					</section>
					<section class="tsr fs-70">
						<section class="col-inp-25">
							Ścieżka Pliku:
						</section>
						<section class="tsr-inp-75">
							<a href="<?php echo $sciezka ;?>">
								<?php echo $sciezka; ?>
							</a>	
						</section>
					</section>
					<section class="tsr tsr-mt-20">
						<img src="<?php echo $sciezka ;?>" alt="<?php echo $sciezka ;?>"></img>
					</section>
					<section class="tsr-inp tsr-mt-20"></section>
					<section class="tsr tsr-mt-20">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Pełny Tytuł:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="edit-tytul-pliku" class="input" value="<?php echo $nazwa; ?>" placeholder="Tytuł pliku" autocomplete="off"/>
						</section>
					</section>	
					<section class="tsr tsr-mt-20">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Folder:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="edit-folder-pliku" class="input" value="<?php echo $folder; ?>" placeholder="folder znajdowania się pliku" autocomplete="off"/>
						</section>
					</section>	
					<section class="tsr">
						<section class="tsr-inp tsr-mt-20 l-0">
							Opis:
						</section>
						<section class="tsr-inp tsr-mt-20">
							<textarea name="edit-opis-pliku" id="editor1" rows="10" cols="80" placeholder="Wpisz Opis" autocomplete="off"><?php echo $opis; ?></textarea>
						</section>
					</section>	
					<section class="tsr tsr-inp tsr-mt-50">
						<button type="submit" value="Dodaj Kategorie/Post" class="input buttom" id="submit_post" >Edytuj Dane pliku</buttom>
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
					var id_pliku = '<?php echo "$id_edit"; ?>';
					var tytul_spr = '<?php echo "$nazwa"; ?>';
					var opis_spr = '<?php echo "$opis"; ?>';
					var folder_spr = '<?php echo "$folder"; ?>';
					
					var tytul = $('input[name="edit-tytul-pliku"]').val();
					var opis = $('textarea[name="edit-opis-pliku"]').val();
					var folder = $('input[name="edit-folder-pliku"]').val();
					$.ajax({
						type:"POST",
						url:"insert/edit-dane-pliku.php",
						data:{
							id_pliku:id_pliku,
							tytul_spr:tytul_spr,
							opis_spr:opis_spr,
							folder_spr:folder_spr,
							
							tytul:tytul,
							opis:opis,
							folder:folder,
						}
					})
					.done(function(info){
						$('#contajner_post_add').append(info);
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