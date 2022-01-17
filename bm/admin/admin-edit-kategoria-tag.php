<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy renderowania strony odpowiedzialnej za dodawanie nowych kategori i tagów 
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";

	$id_KT = $_GET['edit'];

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
			sprintf("SELECT * FROM `".$prefix_table."bm_metaposty` WHERE `id` = '$id_KT'")
			 ))
			{
				$ile = mysqli_num_rows($rezultat);
				
				$row = mysqli_fetch_assoc($rezultat);
				$nazwa_KT = $row['bm_nazwa'];
				$skrucona_nazwa_KT = $row['bm_skr_nazwa'];
				$opis_KT = $row['bm_opis'];
				$KT_KT = $row['bm_KT'];		
			};	
					
			$polaczenie->close();
		}
		
	}
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań póżniej!</span>';
		echo '<br />Informacja developerska: '.$e;
	}	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Edytuj Kategoria/Tag - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Edytuj Kategorie/Tag - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
					

				<section class="tsr tsr-mt-20">
					<form accept-charset="UTF-8"  action="" method="post" id="add_post" autocomplete="off">	
					
					<section class="tsr-inp"></section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Pełny Tytuł:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="edit-tytul_KT" class="input" value="<?php echo $nazwa_KT; ?>" placeholder="Black Min" autocomplete="off"/>
						</section>
					</section>	
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Uproszczony Tytuł:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="edit-tytul_skrucony_KT" class="input" value="<?php echo $skrucona_nazwa_KT; ?>" placeholder="Black Min CMS" autocomplete="off"/>
						</section>
					</section>
					<section class="tsr">					
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Kategoria/Tag:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<select name="edit-kategoria_KT">
								<?php 
									if ($KT_KT == "kategoria") {
										echo '
											<option value="kategoria">kategoria</option>
											<option value="tag">tag</option>		
										';
									}
									if ($KT_KT == "tag") {
										echo '
											<option value="tag">tag</option>	
											<option value="kategoria">kategoria</option>											
										';
									}
								?>
							</select>
						</section>
					</section>
					<section class="tsr">
						<section class="tsr-inp tsr-mt-40 l-0">
							Opis:
						</section>
						<section class="tsr-inp tsr-mt-20">
							<textarea name="edit-opis_KT" id="editor1" rows="10" cols="80" placeholder="Wpisz Opis" autocomplete="off"><?php echo $opis_KT; ?></textarea>
						</section>
					</section>	
					<section class="tsr tsr-inp tsr-mt-50">
						<button type="submit" value="Dodaj Kategorie/Post" class="input buttom" id="submit_post" >Edytuj Kategorie/Tag</buttom>
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
		var id_KT = '<?php echo "$id_KT"; ?>';
		var tytul_KT_spr = '<?php echo "$nazwa_KT"; ?>';
		var tytul_skrucony_KT_spr ='<?php echo "$skrucona_nazwa_KT"; ?>';
		var KT_KT_spr = '<?php echo "$KT_KT"; ?>';
		var opis_KT_spr = '<?php echo "$opis_KT"; ?>';
		
		var tytul_KT = $('input[name="edit-tytul_KT"]').val();
		var tytul_skrucony_KT = $('input[name="edit-tytul_skrucony_KT"]').val();
		var kategoria_KT = $('select[name="edit-kategoria_KT"]').val();
		var opis_KT = $('textarea[name="edit-opis_KT"]').val();
		$.ajax({
			type:"POST",
			url:"insert/edit-kategoria-tag.php",
			data:{
				id_KT:id_KT,
				tytul_KT_spr:tytul_KT_spr,
				tytul_skrucony_KT_spr:tytul_skrucony_KT_spr,
				KT_KT_spr:KT_KT_spr,
				opis_KT_spr:opis_KT_spr,
				
				tytul_KT:tytul_KT,
				tytul_skrucony_KT:tytul_skrucony_KT,
				kategoria_KT:kategoria_KT,
				opis_KT:opis_KT,
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