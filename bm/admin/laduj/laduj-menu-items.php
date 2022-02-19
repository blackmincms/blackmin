<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyciągania z bazy struktury całego menu głównego
	
	#Zawannsowane szukanie
	
	Black Min cms,
	
	#plik: 1.1.1
*/

	// przyłączanie pliku do połączenia z bazą danych 
	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	// funkcja sortująca itemu menu według kolejnośći
	// tablica z danymi do posortowania, tablica z strukturom sortującą, nazwa głównego kontenerta na sortowanie, box do przeciągania, box do przeczymywania itemów
	function menu_sort($t, $x, $sort = "tsr-sortiner", $sorthandle = "tsr-sort-handle", $sort_item = "tsr-sort-item", $sortitem = "tsr-sortitem"){
		if((isset($t)) AND isset($x)){
			// sprawdzanie czy dane są w tablicy
			if((is_array($t)) AND (is_array($x))){
				// pobieranie indexu tablicy strukturalnej
				$ile_sort = count($x);
				// sprawdzanie czy tablica nie jest pusta
				if($ile_sort != 0){
						// zmienna przechowywująca strukture menu
						$r = "";
						// pętla do operacji na danych
						for($i = 0; $i < $ile_sort; $i++){
							$r .= '<div class="'. $sort .'" tsr-index="'. $x[$i]["id"] .'">';
								$r .= '<div class="'. $sorthandle .'">';
									$rev = array_search($x[$i]["id"], array_column($t, "id"));
									$menu_items = json_decode($t[$rev]["bm_wartosc"], true);
									$r .= $menu_items[0];
									
									
									
								$r .= '</div>';
								$r .= '<div class="'. $sort_item .'">';
								$r .= '
									<section class="tsr fs-100">
										<section class="col-ms40 tsr-mt-10">
											Własny url
										</section>
										<section class="col-ms60">
											<input type="text" name="adres-url-rename" class="input" placeholder="Edytuj url" value="'.$menu_items[1].'"/>
										</section>
									</section>
									<section class="tsr fs-100">									
										<section class="col-ms40 tsr-mt-10">
											Własny Tytuł
										</section>
										<section class="col-ms60">
											<input type="text" name="tytul-menu-rename" class="input" placeholder="Edytuj Tytuł" value="'.$menu_items[0].'"/>
											<input type="hidden" name="item_type" class="input tsr-display-none" value="'.$menu_items[2].'"/>
										</section>
									</section>	
									<section class="tsr tsr-mt-20">
										<button type="button" class="submit edytuj_element_menu" value="Edytuj element menu"  >
											Edytuj element menu
										</button>
									</section>
									<section class="tsr r-0 fs-100 tsr-visable-hover add-text-alert-rename">
										<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
											<a class="sortiner-delete-buton">
												Usuń post
											</a>											
										</section>
										<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
											<a class="tsr-sort-item--hiden-button">
												schowaj/anuluj
											</a>	
										</section>
									</section>
									<section class="tsr-mt-5">
										edytuj element menu > '.$menu_items[2].'
									</section>
								';
								
								$r .= '</div>';
								
								if(isset($x[$i]["children"])){
									$r .= '<div class="'. $sortitem .'">';
									$r .= menu_sort($t, $x[$i]["children"]);
									$r .= '</div>';
								}
							
							$r .= '<section class="tsr-sort-item-button">+</section>';
							$r .= '</div>';
						}
						
						// zwracanie danych posortowanych
						return $r;
				}else{
					return "error_data_is_empty";
				}
			}else{
				return "error_data_not_array";
			}
		}else{
			return "error_data_is_empty";
		}
	} 
	
	// otwieranie połączenie z bazą danych i stosowanie określonego zapyta
	// renderowanie odpowiedniego wyniku struktury menu

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
				
				$menu_structur = BM_SETTINGS["bm_menu_structur"];
				
				// rozkładanie na czyniki pierwsze struktury menu głównego for id
				$menu_structur = json_decode($menu_structur, true);
				
				// pobieranie wszsytkich itemów menu	
				$rezultat22 = "SELECT * FROM `".$prefix_table."bm_postmeta` WHERE `bm_kontent` LIKE 'menu'";
				$wynik22 = $polaczenie->query($rezultat22);
					
				$ile22 = mysqli_num_rows($wynik22);
				
				// zmienna przechowywująca dane o menu
				$menu_item_array = [];
				
				for ($i = 0; $i < $ile22; $i++) 
				{
					
					// pobieranie wartości z bazy danych
					$row22 = mysqli_fetch_assoc($wynik22);
					$id_menu = $row22['id'];
					$nazwa_menu = $row22['bm_nazwa'];
					$menu_item = $row22['bm_wartosc'];
					// dodawanie rezultatów do tablicy głównej
					array_push($menu_item_array, $row22);
					// sprawdzanie czy istnieje nowy item
					if($nazwa_menu == "new_menu_item"){
						$id_menu_ = ["id" => $id_menu];
						array_push($menu_structur, $id_menu_);
					}
				}
				
				// zliczanie zawartości id struktury menu
				$ile_load = count($menu_structur);
				
				// sprawdzenie czy menu ma jakiś item
				if ($ile_load >= 1){

echo<<<END

	<div class="cf sortiner-lists animation-cler">

		<div class="tsr">
			<div class="tsr-psort-container tsr-sortbox ">

END;
				
					echo menu_sort($menu_item_array, $menu_structur);
				
echo<<<END
			</div>
			<section class="tsr tsr-mt-20">
				<button type="tsr-button tsr-normal" class="submit" value="Zapisz menu" id="zapisz_menu" >
					Zapisz menu
				</button>
			</section>			
		</div>
	</div>
END;

				}else{
					echo "Brak danych do wyświetlenia";
					exit();
				}	
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o powtórzenie działań póżniej!</span>';
		}	

?>