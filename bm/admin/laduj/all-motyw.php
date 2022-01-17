<?php
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do wyciągania wszystkich plików wgranych na serwer
	
	#Zawannsowane szukanie
	
	Black Min cms,
	
	#plik: 1.2.1
*/

	// ładowanie jądra black mina
	require_once "../black-min.php";
	
	require_once "class-get-ustawienia.php";
	require_once "class-timonix-ttk.php";
	require_once "cut.php";
	
	// odbieranie od skryptu metodą post informacji na temat poszukiwanych rekordów w bacie danych
	
	if (isset ($_POST['ile_load'])){
		$ile_load = $_POST['ile_load'];
	}else {
		$ile_load = "25";
	}

	// zmienna przchowywująca dane o aktywnym motywie
	$aktywny_motyw_bm = bm_theme_active();
	
	// renderowanie odpowiedniego wyniku szukanychh informacji przez użytkownika

	// tworzenie tablicy do przechowywania nazw folderów motywów black min'a
	$all_katolog = [];

	// ścieżka główna do katalogu motywy
	$bm_motyw_path = realpath("../../../a/motywy/"). "/";
	
	// pobieranie wszystkich katologów motywów zainstalowanych na serwerze
	foreach (glob('../../../a/motywy/*', GLOB_ONLYDIR) as $katalog) {
		array_push($all_katolog, basename($katalog));
	}
	
	// schemat dla przechowyania danych o motywie
	$bm_name = "";
	$bm_description = "";
	$bm_autor = "";
	$bm_date_create = "";
	$bm_url_theme_bm = "";
	$bm_key_bm = "";
	$bm_versions = "";
	$bm_autor_website = "";
	
	// zliczanie zajnstalowanych motywów
	$ile_motyw = count($all_katolog);

	// obliczanie ile użytkownik chciał mieć pokazane motywów a ile można wyświetlić
	if ($ile_load > $ile_motyw) {
		$ile_load = $ile_motyw;
	}elseif ($ile_load <= 0) {
		$ile_load = 0;
	}
	
	if ($ile_load == 0) {
		echo('<section class="tsr-alert tsr-alert-info">Brak motywów do wyświetlenia</section>');
		exit();
	}elseif($ile_motyw === 0){
		echo('<section class="tsr-alert tsr-alert-error">Błąd w konfiguracji BlackMina</section>');
		exit();
	}
	
	// otwieranie plików i pobieranie danych do odczytania motywu
	for ($i = 0; $i < $ile_load; $i++) {
		
		// ładowanie zainstalowanych motywów
		$open_motyw_kontent = file_get_contents($bm_motyw_path . $all_katolog[$i] ."/index.php");
		
		if (strstr($open_motyw_kontent, "bm_name:")===False) {
			$bm_name = false;
		}else{
			// przypisywanie zmienych do informacji o motywie
			$bm_name = explode("bm_name:", "$open_motyw_kontent");
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_name = explode("//", $bm_name[1]);		
			$bm_name = $bm_name[0];
		};
		if (strstr($open_motyw_kontent, "bm_description:")===False) {
			$bm_description = false;
		}else{
			// przypisywanie zmienych do informacji o motywie
			$bm_description = explode("bm_description:", "$open_motyw_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_description = explode("//", $bm_description[1]);
			$bm_description = $bm_description[0];
		};
		if (strstr($open_motyw_kontent, "bm_author:")===False) {
			$bm_author = false;
		}else{
			// przypisywanie zmienych do informacji o motywie
			$bm_author = explode("bm_author:", "$open_motyw_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_author = explode("//", $bm_author[1]);
			$bm_author = $bm_author[0];
		};
		if (strstr($open_motyw_kontent, "bm_date_create:")===False) {
			$bm_date_create = false;
		}else{
			// przypisywanie zmienych do informacji o motywie
			$bm_date_create = explode("bm_date_create:", "$open_motyw_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_date_create = explode("//", $bm_date_create[1]);			
			$bm_date_create = $bm_date_create[0];
		};
		/* if (strstr($open_motyw_kontent, "bm_url_theme_bm:")===False) {
			$bm_url_theme_bm = false;
		}else{
			// przypisywanie zmienych do informacji o motywie
			$bm_url_theme_bm = explode("bm_url_theme_bm:", "$open_motyw_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_url_theme_bm = explode("//", $bm_url_theme_bm[1]);		
			$bm_url_theme_bm = $bm_url_theme_bm[0];
		}; */
		if (strstr($open_motyw_kontent, "bm_key_bm:")===False) {
			$bm_key_bm = false;
		}else{
			// przypisywanie zmienych do informacji o motywie
			$bm_key_bm = explode("bm_key_bm:", "$open_motyw_kontent");	
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_key_bm = explode("//", $bm_key_bm[1]);			
			$bm_key_bm = $bm_key_bm[0];
		};
		if (strstr($open_motyw_kontent, "bm_versions:")===False) {
			$bm_versions = false;
		}else{
			// przypisywanie zmienych do informacji o motywie
			$bm_versions = explode("bm_versions:", "$open_motyw_kontent");		
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_versions = explode("//", $bm_versions[1]);			
			$bm_versions = $bm_versions[0];
		};
		
		/* if (strstr($open_motyw_kontent, "bm_autor_website:")===False) {
			$bm_autor_website = false;
		}else{
			// przypisywanie zmienych do informacji o motywie
			$bm_autor_website = explode("bm_autor_website:", "$open_motyw_kontent");	
			// 2x raz usuwanie i filtrowanie danych aby oniknąć błędów 
			$bm_autor_website = explode("//", $bm_autor_website[1]);
			$bm_autor_website = $bm_autor_website[0];
		}; */
		
		if ($bm_name === false){
			echo '<section class="tsr-alert tsr-alert-error"> Kod Błędu: ERROR_THEME_NAME </section>';
			echo '<section class="tsr-alert tsr-alert-error"> Error w motywie:  '.$all_katolog[$i].' </section>';
			exit();
		}
		
		if ($bm_description === false){
			echo '<section class="tsr-alert tsr-alert-error"> Kod Błędu: ERROR_THEME_DESCRIPTION </section>';
			echo '<section class="tsr-alert tsr-alert-error"> Error w motywie:  '.$all_katolog[$i].' </section>';
			exit();
		}
		
		if ($bm_author === false){
			echo '<section class="tsr-alert tsr-alert-error"> Kod Błędu: ERROR_THEME_AUTHOR </section>';
			echo '<section class="tsr-alert tsr-alert-error"> Error w motywie:  '.$all_katolog[$i].' </section>';
			exit();
		}
		
		if ($bm_date_create === false){
			$bm_date_create = "Nie Podano Daty Stworzenia Motywu!";
		}
		
		// if ($bm_url_theme_bm === false){
			// echo '<section class="tsr-alert tsr-alert-error"> Kod Błędu: ERROR_THEME_URL </section>';
			// echo '<section class="tsr-alert tsr-alert-error"> Error w motywie:  '.$all_katolog[$i].' </section>';
			// exit();
		// }
		
		if ($bm_versions === false){
			$bm_versions = "Nie Podano Dokładnej Wersji! : Alfa?";
		}
		
		if ($bm_autor_website === false){
			$bm_autor_website = "Autor Motywu Nie Podał Strony!";
		}
		
		$check_img = file_exists($bm_motyw_path . $all_katolog[$i] . "/miniaturka.png");
		
		if ($check_img === false) {
			$bm_miniaturka = $url_serwera_bm."/pliki/banner/placeholder.jpg";
		}else{
			$bm_miniaturka = $url_serwera_bm."a/motywy/$all_katolog[$i]/miniaturka.png";
		}

		$check_img = file_exists($bm_motyw_path . $all_katolog[$i] . "/thumbnail.png");
		
		if ($check_img === true) {
			$bm_miniaturka = $url_serwera_bm."a/motywy/$all_katolog[$i]/thumbnail.png";
		}

		$schemat_motyw = [
		'bm_name' => $bm_name,
		'bm_description' => $bm_description,
		'bm_author' => $bm_author,
		'bm_date_create' => $bm_date_create,
		//'bm_url_theme_bm' => $bm_url_theme_bm,
		//'bm_key_bm' => $bm_key_bm,
		'bm_versions' => $bm_versions,
		//'bm_autor_website' => $bm_autor_website,
		'bm_logo_theme' => $bm_miniaturka,
		];
		
		$bm_key_bm2 = str_replace(" ","",$bm_key_bm);
					
		$id_motyw = $i;
		$bm_name = $bm_name;
		$bm_description = $bm_description;
		$bm_autor = $bm_author;
		$bm_date_create = $bm_date_create;
		//$bm_url_theme_bm = $bm_url_theme_bm;
		//$bm_key_bm = $bm_key_bm;
		$bm_versions = $bm_versions;
		//$bm_autor_website = $bm_autor_website;
		$bm_logo_theme = $bm_miniaturka;
		$bm_path = realpath($bm_motyw_path.trim($all_katolog[$i]));
		
		// pełna nazwa motywu
		$bm_name_full = trim($all_katolog[$i]);
		// usuwanie znaków  spacji, tablulacji
		$bm_name = trim($bm_name);
		
		// sprawdzanie który motyw jest aktywny
		if (($all_katolog[$i] == $aktywny_motyw_bm)) {
			$bm_name = cut($bm_name , 40);
			
echo<<<END
	
						<section class="tsr fs-60 tsr-p-5px tsr-height-275px" bm-id-post="$bm_name_full">
							<section class=" background-gray">
								<a class="img-efect-normalize2 tsr-pmodal">
									<img src="$bm_logo_theme" title="$bm_name" class="img tsr-miniaturka tsr-vertical-align-middle" style="width: 100%;height: 200px;object-fit: fill;">
									<section class="img-efect-normalize-subtitle2">
										Zobacz
									</section>
									<!-- modal box z informacjami o motywie -->
									<section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false" tsr-modal-max="true">
										<section class="tsr">
											<section class="fs-90 tsr mt-20">Motyw $bm_name</section>
											
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Pełny Tytuł Motywu:
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
													Opis Motywu:
												</section>
												<section class="col-inp-75">
													 $bm_description
												</section>
											</section>					
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Data Stworzenia Motywu:
												</section>
												<section class="col-inp-75">
													$bm_date_create
												</section>
											</section>
											<!--<section class="tsr fs-70">
												<section class="col-inp-25">
													Strona Motywu Black Min:
												</section>
												<section class="col-inp-75">
													<span href="" class="tsr-click-link link">
														$bm_url_theme_bm
													</span>
												</section>
											</section>-->
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Wersja Motywu:
												</section>
												<section class="col-inp-75">
													 $bm_versions
												</section>
											</section>
											<!--<section class="tsr fs-70">
												<section class="col-inp-25">
													Strona Autora Motywu:
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
											<img src="$bm_logo_theme" title="$bm_name" class="img tsr-mt-20">
											<section class="tsr r-0 fs-100 tsr-visable-hover">
												<section class="tsr-fr tsr-button tsr-visable-hover-element edit-post">
													<span class="tsr-pmodal">
														Zobacz Motyw
														<section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false" tsr-modal-max="true">
															<img src="$bm_logo_theme" title="$bm_name" class="img2 " />
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
									<img src="$bm_logo_theme" title="$bm_name" class="img tsr-miniaturka tsr-vertical-align-middle" style="width: 100%;height: 200px;object-fit: fill;">
									<section class="img-efect-normalize-subtitle2">
										Zobacz
									</section>
									<!-- modal box z informacjami o motywie -->
									<section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false" tsr-modal-max="true">
										<section class="tsr">
											<section class="fs-90 tsr mt-20">Motyw $bm_name</section>
											
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Pełny Tytuł Motywu:
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
													Opis Motywu:
												</section>
												<section class="col-inp-75">
													  $bm_description
												</section>
											</section>					
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Data Stworzenia Motywu:
												</section>
												<section class="col-inp-75">
													 $bm_date_create
												</section>
											</section>
											<!--<section class="tsr fs-70">
												<section class="col-inp-25">
													Strona Motywu Black Min:
												</section>
												<section class="col-inp-75">
													<span href="" class="tsr-click-link link">
														$bm_url_theme_bm
													</span>
												</section>
											</section>-->
											<section class="tsr fs-70">
												<section class="col-inp-25">
													Wersja Motywu:
												</section>
												<section class="col-inp-75">
													 $bm_versions
												</section>
											</section>
											<!--<section class="tsr fs-70">
												<section class="col-inp-25">
													Strona Autora Motywu:
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
											<img src="$bm_logo_theme" title="$bm_name" class="img tsr-mt-20">
											<section class="tsr r-0 fs-100 tsr-visable-hover">
												<section class="tsr-fr tsr-button tsr-visable-hover-element red delete-post">
													<span href="" class="tsr-pmodal">
														Usuń Motyw
														<section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false">
															<section class="tsr tsr-width-500px tsr-max-width-500px-5">
																<section class="col-2 fs-70 tsr-p-5px tsr-button">
																	<span class="cursor-pointer bm-motyw-usun" tsr-data="$bm_name_full">
																		Tak, usuń motyw
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
														Zobacz Motyw
														<section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false" tsr-modal-max="true">
															<img src="$bm_logo_theme" title="$bm_name" class="img2 " />
														</section>
													</span>	
												</section>
												<section class="tsr-fr tsr-button tsr-normal tsr-visable-hover-element edit-post ">
													<span href="" class="tsr-pmodal">
														Aktywuj Motyw
														<section class="tsr-modal tsr-width-100 tsr-height-100" tsr-modal-close="false">
															<section class="tsr tsr-width-500px tsr-max-width-500px-5">
																<section class="col-2 fs-70 tsr-p-5px tsr-button">
																	<span class="cursor-pointer bm-motyw-aktywuj" tsr-data="$bm_name_full">
																		Tak, Aktywuj Motyw
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