<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy renderowania strony odpowiedzialnej za edycje motywów
	
	Black Min cms,
	
	#plik: 1.3.1
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
	// ładowanie wybranego pliku do edycji
	if(isset($_GET['src'])){
		$src = $_GET['src'];
		$load_plik_spr = "true";
	}else{
		$load_plik = '<section class="tsr tsr-p-10px tsr-mt-10" >Wybierz Plik Do Edycji</section>';
		$load_plik_spr = "false";
	}
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Edytuj Motyw - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Edytuj Motyw Witryny Black Min - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
					

				<section class="tsr tsr-mt-20">

					<section class="tsr tsr-mb-50 fs-70">
						Plik Edytowany: <?php if($load_plik_spr == "true"){ echo $src; }else{ echo "nieznany";}?>
					</section>	

					<form accept-charset="UTF-8" action="" method="post" id="add_post" autocomplete="off">	
					
						<pre class="col-ms85 tsr-p-10px fs-70" id="edit_file_theme" name="edit_file_theme" <?php if($load_plik_spr == "true"){ echo 'contenteditable="true"'; } ?>><?php
							
							if($load_plik_spr == "true"){
								$lines = file("../../a/motywy/".BM_SETTINGS["bm_theme_active"]."/".$src);
								
								foreach ($lines as $line_num => $line) {
									echo htmlspecialchars($line, ENT_QUOTES);
								}
							}	
						?></pre>
						<section class="col-ms15 tsr-p-10px"><?php require_once "laduj/all-file-motyw.php"; ?></section>
						
						<section class="tsr tsr-inp tsr-mt-50">
						<button type="submit" class="input buttom" id="submit_post" >Zapisz ustawienia</button>
						</section>	
						
						<section class="tsr-inp tsr-mt-50">
							<div id="contajner_post_add"></div>
						</section>			
					
					</form>	
				</section>
				</section>
	
	<script type="text/javascript">			
		
		$("#edit_file_theme").keypress(function(){
			$("#edit_file_theme").find("br").after("\t\n");
			$("#edit_file_theme").find("br").remove();
			console.log("s");
		});
		
		// wysyłanie danych do skryptu metodą post pobranych z formularza
	
		$('#submit_post').click('submit', function(evt1){	
		evt1.preventDefault();
		var edit_file_theme = $('#edit_file_theme').text();
		var save_file = '<?php echo "$src"?>';
		var theme_active_bm = '<?php echo BM_SETTINGS["bm_theme_active"];?>';
		console.log(edit_file_theme);
		$.ajax({
			type:"POST",
			url:"insert/edit-file-motyw.php",
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