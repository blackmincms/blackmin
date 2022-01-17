<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy opsługi połączeń cms'a
	
	Black Min cms,
	
	#plik: 1.1
*/


	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
	
		mysqli_query($polaczenie, "SET CHARSET utf8");
		mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");			
		
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM `".$prefix_table."bm_metaposty` ORDER BY `id`ASC")
		 ))
		{
		
			$ile = mysqli_num_rows($rezultat);
			
			for ($i = 1; $i <= $ile; $i++) 
			{
				
				$row = mysqli_fetch_assoc($rezultat);
				$id_KT = $row['id'];
				$nazwa_KT = $row['bm_nazwa'];
				$skr_nazwa_KT = $row['bm_skr_nazwa'];
				$opis_KT = $row['bm_opis'];
				$KT_KT = $row['bm_KT'];	
				
				if($KT_KT =="kategoria"){
					$KT_KT_z = '
						<select name="edit_kategoria_KT_'.$id_KT.'">
							<option value="kategoria">kategoria</option>
							<option value="tag">tag</option>
						</select>
					';
				}else{
					$KT_KT_z = '
						<select name="edit_kategoria_KT_'.$id_KT.'">
							<option value="tag">tag</option>
							<option value="kategoria">kategoria</option>
						</select>
					';
				};
				
				 if ( $i % 2 == 0 )
				{
	
echo<<<END
				<div class="tsr records-autner ">
					<section class="tsr-p-5px tsr-vis-block tsr-fl tsr tsr-colors-table1" id="KT-$id_KT">
						<section class="col-ms19">
							<input type="checkbox" name="check_usun[]" class="input checkbox" value="$id_KT" id="check_usun" />
							
						</section>
						<section class="col-ms1">
							<section class="col-inp-2">
								<section class="col-ms10 tsr-za-wi">
									$nazwa_KT 
								</section>
								<section class="col-ms10 tsr-za-wi">
									$skr_nazwa_KT
								</section>
							</section>
							<section class="col-inp-2">
								<section class="col-ms10 tsr-za-wi">
									$opis_KT
								</section>
								<section class="col-ms10 tsr-za-wi">
									$KT_KT 
								</section>
							</section>
						</section>
						<section class="tsr tsr-visibility-hidden">
								<a href="#ptd_delte_KT_$id_KT" rel="modal:open">
									<section class="r-0 tsr-fr tsr-p-10px cursor-pointer depresed-red destroy-$id_KT">Usuń</section>
								</a>	
								<a href="#ptz_$id_KT" rel="modal:open">
									<section class="r-0 tsr-fr tsr-p-10px cursor-pointer">Zobacz</section>
								</a>
								<a href="#pte_$id_KT" rel="modal:open">
									<section class="r-0 tsr-fr tsr-p-10px cursor-pointer">Edytuj</section>
								</a>
						</section>
					</section>
					
					<!--<table class="tsr-p-5px tsr-vis-block tsr-fl tsr tsr-color-table" id="KT-$id_KT">
						<!--<thead>
							<tr>
								<th class="col-ms19">
									<input type="checkbox" name="check_usun[]" class="input checkbox" value="$id_KT" id="check_usun" />
								</th>
							</tr>
						</thead>--><!--
						<tbody>
							<tr class="tsr-color-table">
								<td >
									<section class="col-ms19">
										<input type="checkbox" name="check_usun[]" class="input checkbox" value="$id_KT" id="check_usun" />
										
									</section>
									<section class="col-ms1">
										<section class="col-inp-2">
											<section class="col-ms10 tsr-za-wi">
												$nazwa_KT 
											</section>
											<section class="col-ms10 tsr-za-wi">
												$skr_nazwa_KT
											</section>
										</section>
										<section class="col-inp-2">
											<section class="col-ms10 tsr-za-wi">
												$opis_KT
											</section>
											<section class="col-ms10 tsr-za-wi">
												$KT_KT 
											</section>
										</section>
									</section>
								</td>
							</tr><tr>
								<td >
									<section class="tsr tsr-visibility-hidden">
										<a href="#ptd_delte_KT_$id_KT" rel="modal:open">
											<section class="r-0 tsr-fr tsr-p-10px cursor-pointer depresed-red destroy-$id_KT">Usuń</section>
										</a>	
										<a href="#ptz_$id_KT" rel="modal:open">
											<section class="r-0 tsr-fr tsr-p-10px cursor-pointer">Zobacz</section>
										</a>
										<a href="#pte_$id_KT" rel="modal:open">
											<section class="r-0 tsr-fr tsr-p-10px cursor-pointer">Edytuj</section>
										</a>
									</section>
								</td>
							</tr>
						</tbody>
						<tfoot>
						</tfoot>
					 

</table>-->
					
					<div id="ptd_delte_KT_$id_KT" class="tsr modal modal-auto" style="max-width: 350px;">
						<section class="tsr">
							<section class="col-2 fs-70 tsr-p-5px">
								<span id="pty_delte_KT_$id_KT" class="cursor-pointer">
									<a href="#" rel="modal:close">
										Tak, usuń post!
									</a>
								</span>
							</section>
							<section class="col-2 error">
								<a href="#" rel="modal:close">
									Anuluj!
								</a>
							</section>
							<section class="tsr">
							</section>
						</section>
						<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/img/control-img/zamknij.png" class="img" /></a>
					</div>	
					
					<div id="ptz_$id_KT" class="tsr modal modal-auto">
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Pełny Tytuł
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								$nazwa_KT 
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Skrócony Tytuł
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								$skr_nazwa_KT
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Opis
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								$opis_KT
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Kategoria/Tag
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								$KT_KT 
							</section>
						</section>
						<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/img/control-img/zamknij.png" class="img" /></a>
					</div>	
					
					<div id="pte_$id_KT" class="tsr modal modal-auto">
						<form accept-charset="UTF-8"  action="" method="post" id="data-add-post">	
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Pełny Tytuł
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								<input type="text" name="edit_tytul_KT_$id_KT" class="input" placeholder="np. black-min cms, black-min" value="$nazwa_KT ">
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Skrócony Tytuł
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								<input type="text" name="edit_tytul_skr_KT_$id_KT" class="input" placeholder="np. black-min, bm" value="$skr_nazwa_KT">
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Opis
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								<textarea name="edit_opis_KT_$id_KT" id="edit_opis_KT_$id_KT" rows="10" cols="80" placeholder="Wpisz opis">$opis_KT</textarea>
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Kategoria/Tag
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								$KT_KT_z
						</section>
						<section class="tsr tsr-mt-20">
							<input type="submit" value="Edytuj Kategorie/Tag" class="input buttom" id="pte_edit_KT_$id_KT"/>
						</section>	
						</form>
						<div id="KT-edit-$id_KT"></div>
						<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/img/control-img/zamknij.png" class="img" /></a>
					</div>	

					<script type="text/javascript">
						$('#pty_delte_KT_$id_KT').click('submit', function(evt1){
						evt1.preventDefault();
						var delte_KT = "$id_KT";
						
						$.ajax({
							type:"POST",
							url:"data/delte-KT-data.php",
							data:{
								delte_KT:delte_KT,
							}
						})
						.done(function(info){
							$('#KT-$id_KT').text("");
							$('#KT-$id_KT').append(info);
						})
						.fail(function(){
							alert("Wystąpił błąd. Spróbuj ponownie później");
						});
						});	
					</script>
					
					<script type="text/javascript">
						$('#pte_edit_KT_$id_KT').click('submit', function(evt2){
						evt2.preventDefault();
						var edit_tytul_KT = $('input[name="edit_tytul_KT_$id_KT"]').val();
						var edit_tytul_skr_KT = $('input[name="edit_tytul_skr_KT_$id_KT"]').val();
						var edit_kategoria_KT = $('select[name="edit_kategoria_KT_$id_KT"]').val();
						var edit_opis_KT = $('textarea[name="edit_opis_KT_$id_KT"]').val();
						var spr_edit_tytul_KT = "$nazwa_KT";
						var spr_edit_tytul_skr_KT = "$skr_nazwa_KT";
						var spr_edit_kategoria_KT = "$KT_KT";
						var spr_edit_opis_KT = "$opis_KT";
						var id_edit_KT = "$id_KT";
						
						$.ajax({
							type:"POST",
							url:"data/edit-KT-data.php",
							data:{
								edit_tytul_KT:edit_tytul_KT,
								edit_tytul_skr_KT:edit_tytul_skr_KT,
								edit_kategoria_KT:edit_kategoria_KT,
								edit_opis_KT:edit_opis_KT,
								spr_edit_tytul_KT:spr_edit_tytul_KT,
								spr_edit_tytul_skr_KT:spr_edit_tytul_skr_KT,
								spr_edit_kategoria_KT:spr_edit_kategoria_KT,
								spr_edit_opis_KT:spr_edit_opis_KT,
								id_edit_KT:id_edit_KT,
							}
						})
						.done(function(info){
							$('#KT-edit-$id_KT').text("");
							$('#KT-edit-$id_KT').append(info);
						})
						.fail(function(){
							alert("Wystąpił błąd. Spróbuj ponownie później");
						});
						});	
					</script>	
				</div>
				
END;
	
  }
  else
  {

echo<<<END
				<div class="tsr records-autner">
					<section class="tsr-p-5px tsr-vis-block tsr-fl tsr tsr-colors-table2" id="KT-$id_KT">
						<section class="col-ms19">
							<input type="checkbox" name="check_usun[]" class="input checkbox" value="$id_KT" id="check_usun" />
							
						</section>
						<section class="col-ms1">
							<section class="col-inp-2">
								<section class="col-ms10 tsr-za-wi">
									$nazwa_KT 
								</section>
								<section class="col-ms10 tsr-za-wi">
									$skr_nazwa_KT
								</section>
							</section>
							<section class="col-inp-2">
								<section class="col-ms10 tsr-za-wi">
									$opis_KT
								</section>
								<section class="col-ms10 tsr-za-wi">
									$KT_KT 
								</section>
							</section>
						</section>
						<section class="tsr tsr-visibility-hidden">
								<a href="#ptd_delte_KT_$id_KT" rel="modal:open">
									<section class="r-0 tsr-fr tsr-p-10px cursor-pointer depresed-red destroy-$id_KT">Usuń</section>
								</a>	
								<a href="#ptz_$id_KT" rel="modal:open">
									<section class="r-0 tsr-fr tsr-p-10px cursor-pointer">Zobacz</section>
								</a>
								<a href="#pte_$id_KT" rel="modal:open">
									<section class="r-0 tsr-fr tsr-p-10px cursor-pointer">Edytuj</section>
								</a>
						</section>
					</section>
					
					<div id="ptd_delte_KT_$id_KT" class="tsr modal modal-auto" style="max-width: 350px;">
						<section class="tsr">
							<section class="col-2 fs-70 tsr-p-5px">
								<span id="pty_delte_KT_$id_KT" class="cursor-pointer">
									<a href="#" rel="modal:close">
										Tak, usuń post!
									</a>
								</span>
							</section>
							<section class="col-2 error">
								<a href="#" rel="modal:close">
									Anuluj!
								</a>
							</section>
							<section class="tsr">
							</section>
						</section>
						<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/img/control-img/zamknij.png" class="img" /></a>
					</div>	
					
					<div id="ptz_$id_KT" class="tsr modal modal-auto">
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Pełny Tytuł
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								$nazwa_KT 
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Skrócony Tytuł
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								$skr_nazwa_KT
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Opis
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								$opis_KT
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Kategoria/Tag
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								$KT_KT 
							</section>
						</section>
						<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/img/control-img/zamknij.png" class="img" /></a>
					</div>	
					
					<div id="pte_$id_KT" class="tsr modal modal-auto">
						<form accept-charset="UTF-8"  action="" method="post" id="data-add-post">	
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Pełny Tytuł
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								<input type="text" name="edit_tytul_KT_$id_KT" class="input" placeholder="np. black-min cms, black-min" value="$nazwa_KT ">
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Skrócony Tytuł
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								<input type="text" name="edit_tytul_skr_KT_$id_KT" class="input" placeholder="np. black-min, bm" value="$skr_nazwa_KT">
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Opis
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								<textarea name="edit_opis_KT_$id_KT" id="edit_opis_KT_$id_KT" rows="10" cols="80" placeholder="Wpisz opis">$opis_KT</textarea>
							</section>
						</section>
						<section class="tsr">
							<section class="col-inp-4 tsr-p-10px">
								Kategoria/Tag
							</section>
							<section class="col-inp-5-5 tsr-p-10px">
								$KT_KT_z
						</section>
						<section class="tsr tsr-mt-20">
							<input type="submit" value="Edytuj Kategorie/Tag" class="input buttom" id="pte_edit_KT_$id_KT"/>
						</section>	
						</form>
						<div id="KT-edit-$id_KT"></div>
						<a href="" class="close-modal2 tsr-aufle-close " rel="modal:close"><img src="$url_serwera_bm/pliki/img/control-img/zamknij.png" class="img" /></a>
					</div>	

					<script type="text/javascript">
						$('#pty_delte_KT_$id_KT').click('submit', function(evt1){
						evt1.preventDefault();
						var delte_KT = "$id_KT";
						
						$.ajax({
							type:"POST",
							url:"data/delte-KT-data.php",
							data:{
								delte_KT:delte_KT,
							}
						})
						.done(function(info){
							$('#KT-$id_KT').text("");
							$('#KT-$id_KT').append(info);
						})
						.fail(function(){
							alert("Wystąpił błąd. Spróbuj ponownie później");
						});
						});	
					</script>
					
					<script type="text/javascript">
						$('#pte_edit_KT_$id_KT').click('submit', function(evt2){
						evt2.preventDefault();
						var edit_tytul_KT = $('input[name="edit_tytul_KT_$id_KT"]').val();
						var edit_tytul_skr_KT = $('input[name="edit_tytul_skr_KT_$id_KT"]').val();
						var edit_kategoria_KT = $('select[name="edit_kategoria_KT_$id_KT"]').val();
						var edit_opis_KT = $('textarea[name="edit_opis_KT_$id_KT"]').val();
						var spr_edit_tytul_KT = "$nazwa_KT";
						var spr_edit_tytul_skr_KT = "$skr_nazwa_KT";
						var spr_edit_kategoria_KT = "$KT_KT";
						var spr_edit_opis_KT = "$opis_KT";
						var id_edit_KT = "$id_KT";
						
						$.ajax({
							type:"POST",
							url:"data/edit-KT-data.php",
							data:{
								edit_tytul_KT:edit_tytul_KT,
								edit_tytul_skr_KT:edit_tytul_skr_KT,
								edit_kategoria_KT:edit_kategoria_KT,
								edit_opis_KT:edit_opis_KT,
								spr_edit_tytul_KT:spr_edit_tytul_KT,
								spr_edit_tytul_skr_KT:spr_edit_tytul_skr_KT,
								spr_edit_kategoria_KT:spr_edit_kategoria_KT,
								spr_edit_opis_KT:spr_edit_opis_KT,
								id_edit_KT:id_edit_KT,
							}
						})
						.done(function(info){
							$('#KT-edit-$id_KT').text("");
							$('#KT-edit-$id_KT').append(info);
						})
						.fail(function(){
							alert("Wystąpił błąd. Spróbuj ponownie później");
						});
						});	
					</script>	
				</div>
				
END;

  }
				
			};		
		};

		$polaczenie->close();
	}

?>