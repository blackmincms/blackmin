<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do renderowania strony odpowiedzialnej za dodanie nowego posta na stronę
	
	#Zawannsowane szukanie
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Dodaj Post - Admin Panel -  <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>
	
	<script src="../../files/js/admin/file-system-db.js" ></script>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Dodaj Post - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">
					

				<section class="tsr tsr-mt-20">
					<form accept-charset="UTF-8"  action="" method="post" id="add_post" autocomplete="off">	
					
					<section class="tsr-inp"></section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Tytuł posta:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="tytul" class="input" placeholder="Tytuł posta - np. Black Min CMS" autocomplete="off"/>
						</section>
					</section>	
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Adres url posta:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="url" class="input" placeholder="Adres url posta - np. cms Black Min" autocomplete="off"/>
						</section>
					</section>
					<section class="tsr">					
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Status posta:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<select name="status" id="status_post">
								<option value="public">Publiczny</option>
								<option value="private">Prywatny</option>
								<option value="protect_password" >Zabezpieczony hasłem</option>
								<option value="szkic" >szkic</option>
							</select>
						</section>
					</section>
					<section class="tsr" id="protect_password" style="display:none;">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Podaj hasło zabezpieczające:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="password" name="password_post" class="input" placeholder="********" autocomplete="off"/>
						</section>
					</section>	
					<section class="tsr">
						<section class="col-inp-50">
							<section class="col-inp-50 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub"> 
									Podaj kategorie posta:
								</span>
							</section>
							<section class="col-inp-50 tsr-p-10px fs-90" >
								<select name="kategoria" id="kategoria">
									<option value="post">zwykły post</option>
									<option value="info">informacja</option>
									<option value="wazne_info">ważna informacja</option>
									<option value="ostrzezenie">ostrzeżenie</option>
									<option value="najwazniejsze_info">najważniejsza informacja</option>
								</select>
							</section>
						</section>
						
						<section class="col-inp-50">
							<section class="col-inp-50 tsr-p-10px fs-90 " >
								<span class="tsr-vertical-align-sub">
									Podaj kategorie:
								</span>
							</section>
							<section class="col-inp-50 tsr-p-10px fs-90" >
								<select name="kategoria_post">
									<?php get_KT('kategoria'); ?>
								</select>
							</section>
						</section>
					</section>	
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Tagi posta:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >
							<input type="text" name="tag" class="input" placeholder="Tag posta - np. Black Min csm, BM" autocomplete="off"/>
						</section>
						
						<script>
						
						$('input[name="tag"]').timonixSuggestags({
							type : 'timonix_styles_rezult',
							suggestions: [<?php get_KT('tag'); ?>]});
						</script>
						
					</section>
					<section class="tsr">
						<section class="col-inp-25 tsr-p-10px fs-90 " >
							<span class="tsr-vertical-align-sub">
								Miniaturka posta:
							</span>
						</section>
						<section class="col-inp-75 tsr-p-10px fs-90" >

							<div class="aquay-obiect-container" aquay-obiect="get_obiect">
								<div class="aquay-get-obiect" tabindex="0" >
									<div class="aquay-add-media aquay-top-separator tsr-xpmodal" tsr-modal-max="width"  aquay-obiect-put=".aquay-get-miniaturka"  aquay-type="image" aquay-multiply="false" aquay-obiect-type="img">
										Dodaj z Dysku
										<div class="tsr-modal">
											<section class="tsr load-data">
												<section class="tsr-alert tsr-alert-info">Ładowanie danych</section>
											</section>
										</div>
									</div>
									<div class="aquay-get-miniaturka aquay-top-separator"></div>
								</div>
							</div>
						</section>
						
					</section>
					<section class="tsr">
						<section class="tsr-inp tsr-mt-40 l-0">
							Wpisz treść posta.
						</section>

						<!-- Timonix Aquay edytor ON -->

							<div class="tsr aquay-editor-container">
								
							</div>

						<!-- Timonix Aquay edytor OFF -->
						
					</section>	
					<section class="tsr-inp tsr-mt-50">
					<button type="submit" value="Dodaj post" class="input buttom" id="submit_post" >Dodaj post</button>
					</section>	
					
					<section class="tsr-inp tsr-mt-50">
						<div id="contajner_post_add"></div>
					</section>			
					
					</form>	
				</section>
				</section>
				
	<script type="text/javascript">
				
		$('#status_post').change(function(){
		var status_post = $('#status_post').val();
		
		if (status_post == "protect_password") {
			$("#protect_password").css("display", "block");
		}else{
			$("#protect_password").css("display", "none");
		}
		
		});

		aquay(".aquay-editor-container", '<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/');
	</script>				
					
				</section>
			</section>
		</section>
	</main>

	<?php require_once "admin-stopka.php"; ?>

</body>
</html>