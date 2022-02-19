<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy renderowania strony odpowiedzialnej za aktulizowanie widżetów pokazywanych na stronie
	
	Black Min cms,
	
	#plik: 1.2
*/

	// ładowanie jądra black mina
	require_once "black-min.php";

	// tworzenie zmienych odpowieddzialnych za przechowywanie onformcji o pluginac
	$nazwa_pluginu = [];
	$wartosc_pluginu = [];

	// pobieranie z bazy danych aktywnych pluginów(widżetów) do zastosowania ich na stronie
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
				sprintf("SELECT * FROM `".$prefix_table."bm_postmeta` WHERE `bm_kontent` LIKE 'plugin'")
				 ))
				{
				
					$ile_aktywnych_pluginow = mysqli_num_rows($rezultat);
					
					for ($i = 0; $i < $ile_aktywnych_pluginow; $i++) {
					
						$row = mysqli_fetch_assoc($rezultat);
						array_push($nazwa_pluginu, $row['bm_nazwa']);
						array_push($wartosc_pluginu, $row['bm_wartosc']);
					}
	
				};		
			
			$polaczenie->close();
		}
		
	}
	
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań w innym terminie!</span>';
	}	
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Widżety - Admin Panel - <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<div class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Widżety - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">
				<section class="tsr fs-90 l-0">

				<section class="tsr tsr-mt-20">

					<form accept-charset="UTF-8" action="" method="post" id="add_post" autocomplete="off">	
					
						<section class="col-ms20 tsr-p-10px bm-drag-container">
							<section class="tsr tsr-mb-20 tsr-mt-20 fs-60 ">
								<section section="tsr fs-90 bm-disable-sort">Wbudowane Widżety Black Min'a</section>
								<div class="tsr-psort-container r1 tsr-m0">
								
									<div class="tsr-sortiner" tsr-index="1" tsr-data="blackmin" ><div class="tsr-sort-handle cursor-all-scrol">Wyszukiwarka</div></div>
									<div class="tsr-sortiner" tsr-index="2" tsr-data="blackmin" ><div class="tsr-sort-handle cursor-all-scrol">Logowanie</div></div>
								
								</div>				
							</section>
							<section class="tsr tsr-mb-20 tsr-mt-20 fs-60">
								<section section="tsr fs-90 bm-disable-sort">Widżety(pluginy) Wgrane Na Serwer</section>	

								<div class="tsr-psort-container r2 tsr-m0">
									
									<?php
									
										// rozkładanie na czyniki pierwsze struktury menu głównego for id
										$bm_plugin = json_decode(BM_SETTINGS["bm_plugin"], true);	
										
										// wyświetlanie wszystkich aktywnych pluginów
										for ($i = 0; $i < count($bm_plugin); $i++) {
										
											echo '<div class="tsr-sortiner" tsr-data="'. $bm_plugin[$i]["plugin_full"] .'"><div class="tsr-sort-handle cursor-all-scroll">'. $bm_plugin[$i]["plugin"] .'</div></div>';
											
										}										
									
									?>
								
								</div>
								
							</section>
							<section class="tsr"></section>
						</section>
						<section class="col-ms80 tsr-p-10px">
							<section class="col-ms20 tsr-p-10px">
								<section section="tsr fs-90 bm-disable-sort">Top Box</section>

								<div class="tsr-psort-container r3 tsr-sortbox4 tsr-m0">
									
									<?php
										// sprawdzanie czy widget nie jest pusty
										if(json_decode(BM_SETTINGS["bm_top_widget"])  !== "NULL"){
											// rozkładanie na czyniki pierwsze struktury menu głównego for id
											$bm_plugin = json_decode(BM_SETTINGS["bm_top_widget"], true);	
											
											// wyświetlanie wszystkich aktywnych pluginów
											for ($i = 0; $i < count($bm_plugin); $i++) {
												
												// renderowanie itemu w danym widgetie
												echo '<div class="tsr-sortiner" tsr-data="'. $bm_plugin[$i]["plugin_full"] .'"><div class="tsr-sort-handle cursor-all-scroll">'. $bm_plugin[$i]["plugin"] .'</div><section class="tsr-sort-item-button cursor-pointer tsr-remove">x</section></div>';
												
											}	
										}
									
									?>
								
								</div>
								
							</section>
							<section class="col-ms20 tsr-p-10px ">
								<section section="tsr fs-90 bm-disable-sort">Left Box</section>	

								<div class="tsr-psort-container r4 tsr-sortbox4 tsr-m0">
									<?php
										// sprawdzanie czy widget nie jest pusty
										if(json_decode(BM_SETTINGS["bm_left_widget"]) !== "NULL"){
												// rozkładanie na czyniki pierwsze struktury menu głównego for id
												$bm_plugin = json_decode(BM_SETTINGS["bm_left_widget"], true);	
												
												// wyświetlanie wszystkich aktywnych pluginów
												for ($i = 0; $i < count($bm_plugin); $i++) {
												
												// renderowanie itemu w danym widgetie
												echo '<div class="tsr-sortiner" tsr-data="'. $bm_plugin[$i]["plugin_full"] .'"><div class="tsr-sort-handle cursor-all-scroll">'. $bm_plugin[$i]["plugin"] .'</div><section class="tsr-sort-item-button cursor-pointer tsr-remove">x</section></div>';
												
											}	
										}
									
									?>
								</div>
								
							</section>
							<section class="col-ms20 tsr-p-10px ">
								<section section="tsr fs-90 bm-disable-sort">Right Box</section>	

								<div class="tsr-psort-container r5 tsr-sortbox4 tsr-m0">
									<?php
										// sprawdzanie czy widget nie jest pusty
										if(json_decode(BM_SETTINGS["bm_right_widget"]) !== "NULL"){
												// rozkładanie na czyniki pierwsze struktury menu głównego for id
												$bm_plugin = json_decode(BM_SETTINGS["bm_right_widget"], true);	
												
												// wyświetlanie wszystkich aktywnych pluginów
												for ($i = 0; $i < count($bm_plugin); $i++) {
												
												// renderowanie itemu w danym widgetie
												echo '<div class="tsr-sortiner" tsr-data="'. $bm_plugin[$i]["plugin_full"] .'"><div class="tsr-sort-handle cursor-all-scroll">'. $bm_plugin[$i]["plugin"] .'</div><section class="tsr-sort-item-button cursor-pointer tsr-remove">x</section></div>';
												
											}	
										}
									
									?>
								</div>
								
							</section>
							<section class="col-ms20 tsr-p-10px ">
								<section section="tsr fs-90 bm-disable-sort">Bottom Box</section>

								<div class="tsr-psort-container r6 tsr-sortbox4 tsr-m0">
									<?php
										// sprawdzanie czy widget nie jest pusty
										if(json_decode(BM_SETTINGS["bm_bottom_widget"]) !== "NULL"){
											// rozkładanie na czyniki pierwsze struktury menu głównego for id
											$bm_plugin = json_decode(BM_SETTINGS["bm_bottom_widget"], true);	
											
											// wyświetlanie wszystkich aktywnych pluginów
											for ($i = 0; $i < count($bm_plugin); $i++) {
												
												// renderowanie itemu w danym widgetie
												echo '<div class="tsr-sortiner" tsr-data="'. $bm_plugin[$i]["plugin_full"] .'"><div class="tsr-sort-handle cursor-all-scroll">'. $bm_plugin[$i]["plugin"] .'</div><section class="tsr-sort-item-button cursor-pointer tsr-remove">x</section></div>';
												
											}	
										}
									
									?>
								</div>
								
							</section>
							<section class="col-ms20 tsr-p-10px">
								<section section="tsr fs-90 bm-disable-sort">Footer Box</section>
								
								<div class="tsr-psort-container r7 tsr-sortbox4 tsr-m0">
									<?php
										// sprawdzanie czy widget nie jest pusty
										if(json_decode(BM_SETTINGS["bm_footer_widget"]) !== "NULL"){
											// rozkładanie na czyniki pierwsze struktury menu głównego for id
											$bm_plugin = json_decode(BM_SETTINGS["bm_footer_widget"], true);	
											
											// wyświetlanie wszystkich aktywnych pluginów
											for ($i = 0; $i < count($bm_plugin); $i++) {
												
												// renderowanie itemu w danym widgetie
												echo '<div class="tsr-sortiner" tsr-data="'. $bm_plugin[$i]["plugin_full"] .'"><div class="tsr-sort-handle cursor-all-scroll">'. $bm_plugin[$i]["plugin"] .'</div><section class="tsr-sort-item-button cursor-pointer tsr-remove">x</section></div>';
												
											}	
										}
									
									?>
								</div>
								
							</section>							
						</section>
	
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
		
		$(document).ready(function() { 
		
			tsr_sortiner("tsr-data",".r1, .r2",".tsr-sortiner",".tsr-sortitem",1,".tsr-sortbox4",true, 50);
			tsr_sortiner("tsr-data",".r3, .r4, .r5, .r6, .r7",".tsr-sortiner",".tsr-sortitem",1,".tsr-sortbox4",false, 50);
		
			// usuwanie elementów po podwójnym kliknięciu na nazwę bloku
			$(document).on("dblclick", ".tsr-remove", function(oEvent){
				oEvent.preventDefault();
				$(this).closest(".tsr-sortiner").remove();

			});
		
		});			
		
		// wysyłanie danych do skryptu metodą post pobranych z formularza
	
		$('#submit_post').click('submit', function(evt1){
			evt1.preventDefault();
			
			$.ajax({
				type:"POST",
				url:"insert/update-widzety.php",
				data:{
					tab_top_box:JSON.stringify(tsr_index(".r3", ".tsr-sortiner", "title", ".tsr-sortitem", ".tsr-sort-handle")),
					tab_left_box:JSON.stringify(tsr_index(".r4", ".tsr-sortiner", "title", ".tsr-sortitem", ".tsr-sort-handle")),
					tab_right_box:JSON.stringify(tsr_index(".r5", ".tsr-sortiner", "title", ".tsr-sortitem", ".tsr-sort-handle")),
					tab_bottom_box:JSON.stringify(tsr_index(".r6", ".tsr-sortiner", "title", ".tsr-sortitem", ".tsr-sort-handle")),
					tab_footer_box:JSON.stringify(tsr_index(".r7", ".tsr-sortiner", "title", ".tsr-sortitem", ".tsr-sort-handle")),
					tab_top_box2:JSON.stringify(tsr_index(".r3", ".tsr-sortiner", "tsr-data", ".tsr-sortitem", ".tsr-sort-handle", "text")),
					tab_left_box2:JSON.stringify(tsr_index(".r4", ".tsr-sortiner", "tsr-data", ".tsr-sortitem", ".tsr-sort-handle", "text")),
					tab_right_box2:JSON.stringify(tsr_index(".r5", ".tsr-sortiner", "tsr-data", ".tsr-sortitem", ".tsr-sort-handle", "text")),
					tab_bottom_box2:JSON.stringify(tsr_index(".r6", ".tsr-sortiner", "tsr-data", ".tsr-sortitem", ".tsr-sort-handle", "text")),
					tab_footer_box2:JSON.stringify(tsr_index(".r7", ".tsr-sortiner", "tsr-data", ".tsr-sortitem", ".tsr-sort-handle", "text")),
				}
			})
			.done(function(info){
				$('#contajner_post_add').append(info);
				$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
			})
			.fail(function(){
				alert("Wystąpił błąd. Spróbuj ponownie później");
			});
		})
	</script>				
					
				</section>
			</section>
		</div>
	</main>

	<?php require_once "admin-stopka.php"; ?>

</body>
</html>