<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyciągania wszystkich plików(Pluginów) wgranych na serwer
	
	#Zawannsowane szukanie
	
	Black Min cms,
	
	#plik: 1.1
*/

	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	require_once "class-get-ustawienia.php";
	require_once "class-timonix-ttk.php";
	require_once "cut.php";
	
	// iniciowanie klasy token class-timonix-ttk
	//$token_ttk = new blackmin_token_access();
	
	// odbieranie od Pluginu metodą post informacji na temat poszukiwanych rekordów w bacie danych
	
	if (isset ($_POST['ile_load'])){
		$ile_load = $_POST['ile_load'];
	}else {
		$ile_load = "25";
	}
	
	// renderowanie odpowiedniego wyniku szukanychh informacji przez użytkownika

	// tworzenie tablicy do przechowywania nazw folderów skryptów black min'a
	$all_katolog = [];

	// ścieżka główna do katalogu pluginów
	$bm_plugin_path = realpath("../../../a/pluginy/"). "/";
	
	// pobieranie wszystkich katologów pluginów zainstalowanych na serwerze
	foreach (glob('../../../a/pluginy/*', GLOB_ONLYDIR) as $katalog) {
		array_push($all_katolog, basename($katalog));
	}

	// tworzenie tablicy do przecowywania rekordów pobranych z plików iniciujących Skryptach
	$kontent_plugin_load = [];
	
	// schemat dla przerchowyania danych o pluginie
	$bm_name = "";
	$bm_description = "";
	$bm_autor = "";
	$bm_date_create = "";
	$bm_url_plugin_bm = "";
	$bm_patt_bm = "";
	$bm_versions = "";
	$bm_autor_website = "";

	// zmiene do przechowywania zainstalowanych folderów(czyli zaindexowanych)
	$aktywny_nazwa_plugin_bm = [];
	$aktywny_plugin_bm = [];

	// zliczanie zajnstalowanych pluginów
	$ile_plugin = count($all_katolog);	
	
	// obliczanie ile użytkownik chciał mieć pokazane Skryptów a ile można wyświetlić
	if ($ile_load > $ile_plugin) {
		$ile_load = $ile_plugin;
	}elseif ($ile_load <= 0) {
		$ile_load = 0;
	}			
	
	if ($ile_load == 0) {
		echo('<section class="tsr-alert tsr-alert-info">Brak pluginów do wyświetlenia</section>');
		exit();
	}
	
	// otwieranie plików i pobieranie danych do odczytania Pluginu
	for ($i = 0; $i < $ile_load; $i++) {
		
		// ładowanie zainstalowanych skryptów
		$open_plugin_kontent = file_get_contents($bm_plugin_path . $all_katolog[$i] ."/plugin.php");

		if (strstr($open_plugin_kontent, "bm_name:")===False) {
			$bm_name = false;
		}else{
			// przypisywanie zmienych do informacji o pluginie
			$bm_name = explode("bm_name:", "$open_plugin_kontent");
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_name = explode("//", $bm_name[1]);		
			$bm_name = $bm_name[0];
		};		
		if (strstr($open_plugin_kontent, "bm_description:")===False) {
			$bm_description = false;
		}else{
			// przypisywanie zmienych do informacji o pluginie
			$bm_description = explode("bm_description:", "$open_plugin_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_description = explode("//", $bm_description[1]);
			$bm_description = $bm_description[0];
		};
		if (strstr($open_plugin_kontent, "bm_author:")===False) {
			$bm_author = false;
		}else{
			// przypisywanie zmienych do informacji o pluginie
			$bm_author = explode("bm_author:", "$open_plugin_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_author = explode("//", $bm_author[1]);
			$bm_author = $bm_author[0];
		};
		if (strstr($open_plugin_kontent, "bm_date_create:")===False) {
			$bm_date_create = false;
		}else{
			// przypisywanie zmienych do informacji o pluginie
			$bm_date_create = explode("bm_date_create:", "$open_plugin_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_date_create = explode("//", $bm_date_create[1]);			
			$bm_date_create = $bm_date_create[0];
		};
		/* if (strstr($open_plugin_kontent, "bm_url_plugin_bm:")===False) {
			$bm_url_plugin_bm = false;
		}else{
			// przypisywanie zmienych do informacji o pluginie
			$bm_url_plugin_bm = explode("bm_url_plugin_bm:", "$open_plugin_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_url_plugin_bm = explode("//", $bm_url_plugin_bm[1]);		
			$bm_url_plugin_bm = $bm_url_plugin_bm[0];
		}; */
		/* if (strstr($open_plugin_kontent, "bm_patt_bm:")===False) {
			$bm_patt_bm = false;
		}else{
			// przypisywanie zmienych do informacji o pluginie
			$bm_patt_bm = explode("bm_patt_bm:", "$open_plugin_kontent");	
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_patt_bm = explode("//", $bm_patt_bm[1]);			
			$bm_patt_bm = $bm_patt_bm[0];
		}; */
		if (strstr($open_plugin_kontent, "bm_versions:")===False) {
			$bm_versions = false;
		}else{
			// przypisywanie zmienych do informacji o pluginie
			$bm_versions = explode("bm_versions:", "$open_plugin_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_versions = explode("//", $bm_versions[1]);			
			$bm_versions = $bm_versions[0];
		};
		
		/* if (strstr($open_plugin_kontent, "bm_autor_website:")===False) {
			$bm_autor_website = false;
		}else{
			// przypisywanie zmienych do informacji o pluginie
			$bm_autor_website = explode("bm_autor_website:", "$open_plugin_kontent");	
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_autor_website = explode("//", $bm_autor_website[1]);
			$bm_autor_website = $bm_autor_website[0];
		}; */

		if ($bm_name === false){
			echo '<section class="tsr-alert tsr-alert-error"> Kod Błędu: ERROR_THEME_NAME </section>';
			echo '<section class="tsr-alert tsr-alert-error"> Error w pluginie:  '.$all_katolog[$i].' </section>';
			exit();
		}		
		
		if ($bm_description === false){
			echo '<section class="tsr-alert tsr-alert-error"> Kod Błędu: ERROR_PLUGIN_DESCRIPTION </section>';
			echo '<section class="tsr-alert tsr-alert-error"> Error w pluginie:  '.$all_katolog[$i].' </section>';
			exit();
		}
		
		if ($bm_author === false){
			echo '<section class="tsr-alert tsr-alert-error"> Kod Błędu: ERROR_PLUGIN_AUTHOR </section>';
			echo '<section class="tsr-alert tsr-alert-error"> Error w pluginie:  '.$all_katolog[$i].' </section>';
			exit();
		}
		
		if ($bm_date_create === false){
			$bm_date_create = "Nie Podano Daty Stworzenia Pluginu!";
		}
		
		// if ($bm_url_plugin_bm === false){
			// echo '<section class="tsr-alert tsr-alert-error"> Kod Błędu: ERROR_PLUGIN_URL </section>';
			// echo '<section class="tsr-alert tsr-alert-error"> Error w pluginie:  '.$all_katolog[$i].' </section>';
			// exit();
		// }
		
		// if ($bm_patt_bm === false){
			// echo '<section class="tsr-alert tsr-alert-error"> Kod Błędu: ERROR_PLUGIN_PATT </section>';
			// echo '<section class="tsr-alert tsr-alert-error"> Error w pluginie:  '.$all_katolog[$i].' </section>';
			// exit();
		// }
		
		if ($bm_versions === false){
			$bm_versions = "Nie Podano Dokładnej Wersji! : Alfa?";
		}
		
		if ($bm_autor_website === false){
			$bm_autor_website = "Autor Pluginu Nie Podał Własnej Strony!";
		}
		
		$check_img = file_exists($bm_plugin_path . $all_katolog[$i] . "/miniaturka.png");
		
		if ($check_img === false) {
			$bm_miniaturka = $url_serwera_bm."/pliki/banner/placeholder.jpg";
		}else{
			$bm_miniaturka = $url_serwera_bm."a/pluginy/$all_katolog[$i]/miniaturka.png";
		}

		$check_img = file_exists($bm_plugin_path . $all_katolog[$i] . "/thumbnail.png");
		
		if ($check_img === true) {
			$bm_miniaturka = $url_serwera_bm."a/pluginy/$all_katolog[$i]/thumbnail.png";
		}	
		
		$schemat_skrypt = [
		'bm_name' => $aktywny_nazwa_plugin_bm,
		'bm_description' => $bm_description,
		'bm_author' => $bm_author,
		'bm_date_create' => $bm_date_create,
		'bm_url_plugin_bm' => $bm_url_plugin_bm,
		'bm_patt_bm' => $bm_patt_bm,
		'bm_versions' => $bm_versions,
		'bm_autor_website' => $bm_autor_website,
		'bm_logo_plugin' => $bm_miniaturka,
		];
		
		array_push($kontent_plugin_load, $schemat_skrypt);
		
		// pobieranie informacji do sprawdzenia patt
		$bm_patt_bm2 = str_replace(" ","",$bm_patt_bm);
		//$bm_patt_bm2 = substr($bm_patt_bm1, 0, -2);
		$bm_name2 = str_replace(" ","_",$aktywny_nazwa_plugin_bm);
		$bm_author2 = substr($bm_author, 1, -2);
		//$token_ttk->get_plugin_patt($bm_patt_bm2,$bm_name2,$bm_author2);
		//$token_ttk->get_patt_info();
					
		$id_plugin = $i;
		$bm_name = $bm_name;
		$bm_description = $bm_description;
		$bm_autor = $bm_author;
		$bm_date_create = $bm_date_create;
		$bm_url_plugin_bm = $bm_url_plugin_bm;
		$bm_patt_bm = $bm_patt_bm;
		$bm_versions = $bm_versions;
		$bm_autor_website = $bm_autor_website;
		$bm_logo_plugin = $bm_miniaturka;
		$bm_path = realpath($bm_plugin_path.trim($all_katolog[$i]));
		
		// pełna nazwa pluginu
		$bm_name_full = trim($all_katolog[$i]);
		// usuwanie znaków  spacji, tablulacji
		$bm_name = trim($bm_name);
		// pełena nazwa
		$bm_name_ = $bm_name;
		
		// rozkładanie na czyniki pierwsze struktury menu głównego for id
		$bm_plugin = json_decode($bm_ustawienia["bm_plugin"], true);	
		
		// sprawdzanie czy plugin jest aktywn
		$jest_akywny = array_search($bm_name_full, array_column($bm_plugin, "plugin_full"));
		
		// sprawdzanie który plugin jest aktywny
		if ($jest_akywny !== false) {
			$bm_name = cut($bm_name , 40);
			
echo<<<END
	
						<section class="tsr fs-60 tsr-p-5px tsr-height-275px" bm-id-post="$bm_name_full">
							<section class=" background-gray">
								<a class="img-efect-normalize2 tsr-pmodal">
									<img src="$bm_logo_plugin" title="$bm_name" class="img tsr-miniaturka tsr-vertical-align-middle" style="width: 100%;height: 200px;object-fit: fill;">
									<section class="img-efect-normalize-subtitle2">
										Zobacz
									</section>
									<!-- modal box z informacjami o pluginie -->
									<section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false" tsr-modal-max="true">
										<section class="tsr">
											<section class="fs-90 tsr mt-20">Plugin $bm_name</section>
											
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Pełny Tytuł PLuginu:
												</section>
												<section class="col-inp-75">
													$bm_name
												</section>
											</section>
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Autor Mowywu:
												</section>
												<section class="col-inp-75">
													 $bm_autor
												</section>
											</section>
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Opis PLuginu:
												</section>
												<section class="col-inp-75">
													 $bm_description
												</section>
											</section>					
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Data Stworzenia Pluginu:
												</section>
												<section class="col-inp-75">
													$bm_date_create
												</section>
											</section>
											<!--<section class="tsr fs-70">
												<section class="col-inp-25">
													Strona Pluginu Black Min:
												</section>
												<section class="col-inp-75">
													<span href="" class="tsr-click-link link">
														$bm_url_plugin_bm
													</span>
												</section>
											</section>
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Klucz id Pluginu:
												</section>
												<section class="col-inp-75 tsr-word-wrap">
													 $bm_patt_bm
												</section>
											</section>-->
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Wersja Pluginu:
												</section>
												<section class="col-inp-75">
													 $bm_versions
												</section>
											</section>
											<!--<section class="tsr fs-70">
												<section class="col-inp-25">
													Strona Autora Pluginu:
												</section>
												<section class="col-inp-75">
													<span href="" class="tsr-click-link link">
														$bm_autor_website
													</span>
												</section>
											</section>	-->										
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Ścieżka Pliku:
												</section>
												<section class="tsr-inp-75">
													<span href="" class="tsr-click-link link">
														$bm_path
													</span>	
												</section>
											</section>
											<img src="$bm_logo_plugin" title="$bm_name" class="img tsr-mt-20">
											<section class="tsr r-0 fs-100 tsr-visable-hover">
												<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
													<span href="" class="tsr-pmodal">
														Dezaktywuj plugin
														<section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false">
															<section class="tsr tsr-width-500px tsr-max-width-500px-5">
																<section class="col-2 fs-70 tsr-p-5px tsr-button">
																	<span class="cursor-pointer bm-plugin-dezaktywuj" tsr-data="$bm_name_full" tsr-data2="$bm_name_">
																		Tak, Dezaktywuj plugin
																	</span>
																</section>
																<section class="col-2 tsr-button tsr-error tsr-modal-closed-button">
																	<span class="tsr-modal-closed-button">
																		Anuluj!
																	</span>
																</section>
																<section class="tsr">
																</section>
															</section>
														</section>
													</span>											
												</section>
												<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
													<span class="tsr-pmodal">
														Zobacz Plugin
														<section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false" tsr-modal-max="true">
															<img src="$bm_logo_plugin" title="$bm_name" class="img2 " />
														</section>
													</span>	
												</section>
											</section>
											
										</section>
									</section>
								</a>
								<section class="fs-90 tsr-cut-string background-dark-red tsr-p-10px tsr-pt-5px tsr-pb-5px">
									<section class="tsr-button tsr-normal">
										Aktywny
									</section>
									$bm_name
								</section>
							</section>
						</section>
	
	
END;
			
		}else{
			
echo<<<END
	
						<section class="tsr fs-60 tsr-p-5px tsr-height-275px" bm-id-post="$bm_name_full">
							<section class="background-gray">
								<a class="img-efect-normalize2 tsr-pmodal">
									<img src="$bm_logo_plugin" title="$bm_name" class="img tsr-miniaturka tsr-vertical-align-middle" style="width: 100%;height: 200px;object-fit: fill;">
									<section class="img-efect-normalize-subtitle2">
										Zobacz
									</section>
									<!-- modal box z informacjami o pluginie -->
									<section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false" tsr-modal-max="true">
										<section class="tsr">
											<section class="fs-90 tsr mt-20">Plugin $bm_name</section>
											
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Pełny Tytuł Pluginu:
												</section>
												<section class="col-inp-75">
													$bm_name
												</section>
											</section>
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Autor Mowywu:
												</section>
												<section class="col-inp-75">
													  $bm_autor
												</section>
											</section>
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Opis Pluginu:
												</section>
												<section class="col-inp-75">
													  $bm_description
												</section>
											</section>					
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Data Stworzenia Pluginu:
												</section>
												<section class="col-inp-75">
													 $bm_date_create
												</section>
											</section>
											<!--<section class="tsr fs-70">
												<section class="col-inp-25">
													Strona Pluginu Black Min:
												</section>
												<section class="col-inp-75">
													<span href="" class="tsr-click-link link">
														$bm_url_plugin_bm
													</span>
												</section>
											</section>
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Klucz id Pluginu:
												</section>
												<section class="col-inp-75 tsr-word-wrap">
													 $bm_patt_bm
												</section>
											</section>-->
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Wersja Pluginu:
												</section>
												<section class="col-inp-75">
													 $bm_versions
												</section>
											</section>
											<!--<section class="tsr fs-70">
												<section class="col-inp-25">
													Strona Autora Pluginu:
												</section>
												<section class="col-inp-75">
													<span href="" class="tsr-click-link link">
														$bm_autor_website
													</span>
												</section>
											</section>		-->									
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Ścieżka Pliku:
												</section>
												<section class="tsr-inp-75">
													<span href="" class="tsr-click-link link">
														$bm_path
													</span>	
												</section>
											</section>
											<img src="$bm_logo_plugin" title="$bm_name" class="img tsr-mt-20">
											<section class="tsr r-0 fs-100 tsr-visable-hover">
												<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
													<span href="" class="tsr-pmodal">
														Usuń Plugin
														<section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false">
															<section class="tsr tsr-width-500px tsr-max-width-500px-5">
																<section class="col-2 fs-70 tsr-p-5px tsr-button">
																	<span class="cursor-pointer bm-plugin-usun" tsr-data="$bm_name_full">
																		Tak, usuń plugin
																	</span>
																</section>
																<section class="col-2 tsr-button tsr-error tsr-modal-closed-button">
																	<span class="tsr-modal-closed-button">
																		Anuluj!
																	</span>
																</section>
																<section class="tsr">
																</section>
															</section>
														</section>
													</span>											
												</section>
												<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
													<span class="tsr-pmodal">
														Zobacz Plugin
														<section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false" tsr-modal-max="true">
															<img src="$bm_logo_plugin" title="$bm_name" class="img2 " />
														</section>
													</span>	
												</section>
												<section class="tsr-fr tsr-button tsr-normal tsr-visable-hover-element edit-post ">
													<span href="" class="tsr-pmodal">
														Aktywuj Plugin
														<section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false">
															<section class="tsr tsr-width-500px tsr-max-width-500px-5">
																<section class="col-2 fs-70 tsr-p-5px tsr-button">
																	<span class="cursor-pointer bm-plugin-aktywuj" tsr-data="$bm_name_full" tsr-data2="$bm_name_">
																		Tak, Aktywuj Plugin
																	</span>
																</section>
																<section class="col-2 tsr-button tsr-error tsr-modal-closed-button">
																	<span class="tsr-modal-closed-button">
																		Anuluj!
																	</span>
																</section>
															</section>
														</section>
													</span>	
												</section>
											</section>
											
										</section>
									</section>
								</a>
								<section class="tsr-p-10px fs-90 tsr-cut-string background-cyan">
									$bm_name
								</section>
							</section>
						</section>
	
END;
			
		}
	
}

?>