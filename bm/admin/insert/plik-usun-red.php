<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do usuwania pliku wgranego na serwer
	
	Black Min cms,
	
	#plik: 1.2
*/
	
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	require_once "../../../connect.php";
	require_once "../laduj/class-get-ustawienia.php";
	// Tworzenie nowej klasy i wywołanie jej w celu pobrania ustawień Black Mina
	$url_serwera_bm = $ustawienia_bm["bm_url_server"];
	
	// sprawdzenia czy coś przyszło do pliku 
	// usuwanie wybranych rekordów po id rekordu
	// tworzenie odpowiedniego skryptu który schowa rekord żeby użytkownik wiedział że usunięcie się powiodło
	
	if(isset($_POST['usun_plik']))
	{
		$id_plik = $_POST['usun_plik'];
		
		$ile_deelete = count($id_plik);
		
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
				
				$sciezka = "../../../";
				
				for($i=0; $i < $ile_deelete; $i++)	{
		
					// pobieranie z bazy sciezki do usunięcia pliku
					$rezultat2 = "SELECT `bm_sciezka`,`bm_miniaturka` FROM `".$prefix_table."bm_filemeta` WHERE `id` = '".htmlspecialchars($id_plik[$i])."'";
					$wynik2 = $polaczenie->query($rezultat2);
					
					$ile2 = mysqli_num_rows($wynik2);
				
					if($ile2 != 0){
				
						$row2 = mysqli_fetch_assoc($wynik2);
						$plik_sciezka = $row2['bm_sciezka'];
						$bm_miniaturka = $row2['bm_miniaturka'];
						
						// zamienianie prokotołu http(s) na czytelną scieżkę dla systemu
						$plik_sciezka = str_replace($url_serwera_bm, "", $plik_sciezka);
						$bm_miniaturka = str_replace($url_serwera_bm, "", $bm_miniaturka);
			
						if (@unlink($sciezka . $plik_sciezka) ) {	

							if($bm_miniaturka != 0){
								if(@unlink($sciezka . $bm_miniaturka)){
									
								}
							}

							if ($polaczenie->query("DELETE FROM `".$prefix_table."bm_filemeta` WHERE `id` = '".$id_plik[$i]."'"))
							{

								echo '
										<section class="tsr tsr-alert tsr-alert-success">
											Plik został usunięty poprawnie!
										</section>
								';	
									
								echo '
									<script type="text/javascript">
									var usun_plik = [];
									var hiden_post = $("[data-id-post='."'".$id_plik[$i]."'".']");
											
									$(hiden_post).delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500);
									
									var hiden_post2 = $(".id-records-'."".$id_plik[$i]."".'");
											
									$(hiden_post2).delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500);
									</script>
								';
								
							}else{
								//throw new Exception($polaczenie->error);
							}
						}else{
							echo '
								<section class="tsr tsr-alert tsr-alert-error">
									Kod błędu: [ERROR_DELETE_FILE] - Błąd podczas usuwania pliku!
								</section>
							';
						}

					}
				
				}

				
				$polaczenie->close();
			}
			
		}
		
          
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań w innym terminie!</span>';
		}		
		
	}		
	
?>