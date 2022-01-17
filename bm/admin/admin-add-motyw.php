<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do dodawania nowych motywów black mina
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Dodaj Motyw - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Dodaj Motyw - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
					

				<section class="tsr tsr-mt-20">

					<section class="tsr tsr-mb-50 fs-120">
						Błąd podczas łączenia z serwerem!
					</section>	


				</section>
				</section>
	
	<script type="text/javascript">			
		
		// wysyłanie danych do skryptu metodą post pobranych z formularza
	
		$('#submit_post').click('submit', function(evt1){	
		evt1.preventDefault();
		var edit_file_theme = $('#edit_file_theme').text();
		var save_file = '<?php echo "$src"?>';
		var theme_active_bm = '<?php echo theme_active_bm();?>';
		console.log(edit_file_theme);
		$.ajax({
			type:"POST",
			url:"insert/edit-file-motywadasd.php",
			data:{
				edit_file_theme:edit_file_theme,
				save_file:save_file,
				theme_active_bm:theme_active_bm,
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