<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyświetlania wszystkich plików wysłanych na serwer i pobranie pliku wybranego przez użytkownika
	
	Black Min cms,
	
	#plik: 1.2
*/
	
	// ładowanie jądra black mina
	require_once "black-min.php";
	
	// pobieranie danych do załadowania pilków z dysku (db)
	$ile_loads = $_POST['ile_load'];
	$multiply = $_POST['multiply'];
	$get_plik = $_POST['get_plik'];	
	$typebox = $_POST['typebox'];
	$button = $_POST['button'];		
	$klucz = $_POST['klucz'];			
	
?>

				<section class="tsr fs-90 l-0 ">
					
					<form accept-charset="UTF-8"  action="" method="post">	
						<section class="tsr tsr-p-5px tsr-mb-10">
							<section class="col-ms25 tsr-p-5px">
								<select name="roszerzenie_<?php echo $klucz;?>">
									<option value="all">wszystkie Roszerzenia</option>
									<option value="img">grafika</option>
									<option value="film">filmy</option>
									<option value="audio">audio</option>
									<option value="txt">tekstowe</option>
									<option value="rar">Skompresowane</option>
								</select>
							</section>
							<section class="col-ms10 tsr-p-5px">
								<input type="number" name="ile_load_<?php echo $klucz;?>" class="input" value="25" placeholder="ile załadować?">
							</section>
							<section class="col-ms30 tsr-p-5px">
								<section class="tsr tsr-position-relative">
									<input type="search" name="folder_<?php echo $klucz;?>" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Folder">
									<section type="search" name="folders" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10 load_post">
										<img src="../../pliki/ikony/szukaj.png">
									</section>
								</section>
							</section>
							<section class="col-ms30 tsr-p-5px">
								<section class="tsr tsr-position-relative">
									<input type="search" name="szukaj_<?php echo $klucz;?>" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj">
									<section type="search" name="szukaj" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10 load_post">
										<img src="../../pliki/ikony/szukaj.png">
									</section>
								</section>
							</section>
						</section>
					</form>	
					
					<section class="tsr">
						<section class="col-ms25 tsr-p-5px akcja-post_<?php echo $button;?>">
							<select name="akcja" id="rename_folder_<?php echo $button;?>">
								<option value="add_media">dodaj media</option>
								<option value="usun">usuń</option>
								<option value="rename_folder">ustaw nazwę folderu</option>
							</select>
						</section>
						<section class="col-inp-75" id="zmien_<?php echo $button;?>" style="display:none;">
							<section class="col-inp-25 tsr-p-10px fs-60 " >
								<span class="tsr-vertical-align-sub">
									Zmień folder pliku:
								</span>
							</section>
							<section class="col-inp-75 tsr-p-10px fs-90" >
								<input type="text" name="folder_zmien_<?php echo $button;?>" class="input" placeholder="abc" autocomplete="off"/>
							</section>
						</section>	
					</section>
					
					<!-- Zmienianie wyświetlania plików -->
						
					<section class="tsr checkall" id="post_container">		
						<section class="tsr-recors-table">
						</section>
						<section class="tsr-recors-miniaturs">
						</section>
					</section>	

					<script type="text/javascript">
					$(document).ready(function(){		
					
					// sprawdzenie czy użytkownik wybrał akcje zmień folder pliku
					// jeeli wybrał to pokazujemy diva do wpisania nowej nazwy folderu
					$('#rename_folder_<?php echo $button;?>').change(function(){
						var status_akcja = $('#rename_folder_<?php echo $button;?>').val();

						if (status_akcja == "rename_folder") {
							$("#zmien_<?php echo $button;?>").css("display", "block");
							//console.log(status_post);
						}else{
							$("#zmien_<?php echo $button;?>").css("display", "none");
						}
						
					});					
	
						$('.load_post').click('submit', function(evt1){
							evt1.preventDefault();
							var roszerzenie_<?php echo $klucz;?> = $('select[name="roszerzenie_<?php echo $klucz;?>"]').val();
							var ile_load_<?php echo $klucz;?> = $('input[name="ile_load_<?php echo $klucz;?>"]').val();
							var szukaj_<?php echo $klucz;?> = $('input[name="szukaj_<?php echo $klucz;?>"]').val();
							var folder_<?php echo $klucz;?> = $('input[name="folder_<?php echo $klucz;?>"]').val();
							
							$.ajax({
								type:"POST",
								url:"laduj/all-dysk-get-media.php",
								data:{
									roszerzenie:roszerzenie_<?php echo $klucz;?>,
									ile_load:ile_load_<?php echo $klucz;?>,
									szukaj:szukaj_<?php echo $klucz;?>,
									folder:folder_<?php echo $klucz;?>,
									multiply:"<?php echo $multiply; ?>",
									get_plik:"<?php echo $get_plik; ?>",
									typebox:"<?php echo $typebox; ?>",
									button:"<?php echo $button; ?>",
								}
							})
							.done(function(info){
								$('<?php echo "$get_plik"; ?>').find(".aquay-modal-container").find(".aquay-modal-load").find("#post_container").text("");
								$('<?php echo "$get_plik"; ?>').find(".aquay-modal-container").find(".aquay-modal-load").find("#post_container").append(info);
								$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
								
								multiply_blocked();
							})
							.fail(function(){
								alert("Wystąpił błąd. Spróbuj ponownie później");
							});
						});
						
						function evt(){
							
							var roszerzenie_<?php echo $klucz;?> = $('select[name="roszerzenie_<?php echo $klucz;?>"]').val();
							var ile_load_<?php echo $klucz;?> = $('input[name="ile_load_<?php echo $klucz;?>"]').val();
							var szukaj_<?php echo $klucz;?> = $('input[name="szukaj_<?php echo $klucz;?>"]').val();
							var folder_<?php echo $klucz;?> = $('input[name="folder_<?php echo $klucz;?>"]').val();
							
							$.ajax({
								type:"POST",
								url:"laduj/all-dysk-get-media.php",
								data:{
									roszerzenie:roszerzenie_<?php echo $klucz;?>,
									ile_load:ile_load_<?php echo $klucz;?>,
									szukaj:szukaj_<?php echo $klucz;?>,
									folder:folder_<?php echo $klucz;?>,
									multiply:"<?php echo $multiply; ?>",
									get_plik:"<?php echo $get_plik; ?>",
									typebox:"<?php echo $typebox; ?>",
									button:"<?php echo $button; ?>",
								}
							})
							.done(function(info){
								//$('<?php echo "$get_plik"; ?>').find(".aquay-modal-container").find(".aquay-modal-load").text("");
								$('<?php echo "$get_plik"; ?>').find(".aquay-modal-container").find(".aquay-modal-load").find("#post_container").append(info);
								$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
								
								multiply_blocked();
							})
							.fail(function(){
								alert("Wystąpił błąd. Spróbuj ponownie później");
							});
						};
						
						evt();


						// sprawdzanie czy opcja multiply jest false
						// jeżeli jest to blokujemy możliwość dodawania kilku elementó jeżeli true to pozostawiamy akcjię domyśną
						function multiply_blocked(oEvent) {
							if (<?php echo $multiply;?> === false){
								console.log("false");
								$(".checked-all_<?php echo $button?>").addClass("tsr-display-none");
								$(".checked-all_<?php echo $button?>").addClass("tsr-display-none");
								$("#checked-all_<?php echo $button?>").addClass("tsr-display-none");
								$(".akcja-post_<?php echo $button;?>").addClass("tsr-display-none");
								
								$(document).on('click', ".check_usun_<?php echo $button?>", function(oEvent){	
									var block_this_check = $(this).closest(".check_usun_<?php echo $button?>");
									$(".check_usun_<?php echo $button?>").removeAttr("style");
									$(this).closest(".check_usun_<?php echo $button?>").addClass("mietka");
									console.log(block_this_check);
								});	
								
							}
						}
						
					})
					</script>
					
	<script>
		$('#cla1').on('click',function(){
		console.log('klikmoles szukaj znajomego');
		var delte_KT_a = $('input[name="check_usun[]"]').val();
		$('#enp_err').val("nowa wartość");
	});
	</script>
				
				
				</section>
				
<?php 

	echo '
		<script type="text/javascript">
			evt();
		</script>
	';

?>				