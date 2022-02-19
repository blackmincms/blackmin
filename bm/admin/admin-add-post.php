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
							<div id="aquay" class="aquay" data-edit="true">
								<section class="aquay-nawigacja background-szary">	
									<section class="aquay-sekcjia aquay-clear">
										<section class="aquay-logo aquay-ikona">
											aquay
										</section>
										
										<section class="aquay-ikona blokada_edycj" onclick="aquay_edytor_toggle_edytuj();">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/button/hiddenfield-big.png" alt="Blokada Edycji" title="Blokada Edycji">
										</section>
										<div class="aquay-ikona aquay-bar"></div>
										<section class="aquay-ikona wytnij" onclick="aquay_edytor('cut');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/clipboard/cut-big.png" alt="wytnij" title="wytnij">
										</section>
										<section class="aquay-ikona kopiuj" onclick="aquay_edytor('copy');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/clipboard/copy-big.png" alt="kopiuj" title="kopiuj">
										</section>
										<section class="aquay-ikona aquay-input-margin zaznacz_calosc" onclick="aquay_edytor('selectAll');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/text/selectall-big.png" alt="zaznacz całość" title="zaznacz całość">
										</section>
										<div class="aquay-ikona aquay-bar"></div>
										<section class="aquay-ikona cofnij" onclick="aquay_edytor('undo');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/undo/undo-big.png" alt="cofnij" title="cofnij">
										</section>
										<section class="aquay-ikona ponow" onclick="aquay_edytor('redo');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/undo/redo-big.png" alt="ponów" title="ponów">
										</section>
										<div class="aquay-ikona aquay-bar"></div>
										<section class="aquay-ikona usun_formatowanie" onclick="aquay_edytor('removeFormat');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/clipboard/removeformat-big.png" alt="usuń formatowanie" title="usuń formatowanie">
										</section>
									</section>	
									<section class="aquay-sekcjia">
										<section class="aquay-ikona pogrobienie" onclick="aquay_edytor('bold');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/stylize/bold-big.png" alt="pogróbienie" title="pogróbienie">
										</section>
										<section class="aquay-ikona pochylenie" onclick="aquay_edytor('italic');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/stylize/italic-big.png" alt="pochylenie" title="pochylenie">
										</section>
										<section class="aquay-ikona podkreslenie" onclick="aquay_edytor('underline');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/stylize/underline-big.png" alt="podkreślenie" title="podkreślenie">
										</section>
										<section class="aquay-ikona przekreslenie" onclick="aquay_edytor('strikeThrough');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/stylize/strike-big.png" alt="przekreśl" title="przekreśl" toltip="przekreśl">
										</section>
										<section class="aquay-ikona index_dolny" onclick="aquay_edytor('subscript');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/stylize/subscript-big.png" alt="index dolny" title="index dolny">
										</section>
										<section class="aquay-ikona index_gorny" onclick="aquay_edytor('superscript');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/stylize/superscript-big.png" alt="index górny" title="index górny">
										</section>
										<div class="aquay-ikona aquay-bar"></div>
										<section class="aquay-ikona wysrodkuj_do_lewej" onclick="aquay_edytor('justifyLeft');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/justify/justifyleft-big.png" alt="wyśrodkuj do lewej" title="wyśrodkuj do lewej">
										</section>
										<section class="aquay-ikona wysrodkuj" onclick="aquay_edytor('justifyCenter');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/justify/justifycenter-big.png" alt="wyśrodkuj" title="wyśrodkuj">
										</section>
										<section class="aquay-ikona wysrodkuj_do_prawej" onclick="aquay_edytor('justifyRight');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/justify/justifyright-big.png" alt="wyśrodkuj do prawej" title="wyśrodkuj do prawej">
										</section>
										<section class="aquay-ikona wyjustuj" onclick="aquay_edytor('justifyFull');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/justify/justifyblock-big.png" alt="wyjustuj" title="wyjustuj">
										</section>
										<div class="aquay-ikona aquay-bar"></div>
										<section class="aquay-ikona akapit_od_lewej" onclick="aquay_edytor('indent');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/akapit/bidiltr-big.png" alt="akapit od lewej" title="akapit od lewej">
										</section>
										<section class="aquay-ikona akapit_od_prawej" onclick="aquay_edytor('outdent');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/akapit/bidirtl-big.png" alt="akapit od prawej" title="akapit od prawej">
										</section>
										<div class="aquay-ikona aquay-bar"></div>
										<section class="aquay-ikona lista_kropka" onclick="aquay_edytor('insertUnorderedList');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/list/bulletedlist-big.png" alt="lista kropkowana" title="lista kropkowana">
										</section>
										<section class="aquay-ikona lista_numer" onclick="aquay_edytor('insertOrderedList');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/list/numberedlist-big.png" alt="lista numerowana" title="lista numerowana">
										</section>
										<section class="aquay-ikona przerwa" onclick="aquay_edytor('insertParagraph');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/linia/horizontalrule-big.png" alt="przerwa" title="przerwa">
										</section>
										<div class="aquay-ikona aquay-bar"></div>
										<div >
											<section class="aquay-ikona link tsr-pmodal" tsr-modal-max="width" tsr-modal-close="true" tsr-modal-selected="false">
												<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/flags/link-big.png" alt="link" title="link">
												<section class="tsr-modal tsr-remove-selection">
													<section class="tsr tsr-remove-selection">
														<section class="tsr tsr-remove-selection">
															<section class="col-inp-25 tsr-p-10px fs-90 ">
																<span class="tsr-vertical-align-sub">
																	url:
																</span>
															</section>
															<section class="col-inp-75 tsr-p-10px fs-90">
																<input type="url" name="url_add" class="input tsr-remove-selection" placeholder="https://blackmin.pl" autocomplete="off" focus="false">
															</section>
														</section>
														<section class="tsr tsr-remove-selection">
															<section class="col-inp-25 tsr-p-10px fs-90 ">
																<span class="tsr-vertical-align-sub">
																	tytuł:
																</span>
															</section>
															<section class="col-inp-75 tsr-p-10px fs-90">
																<input type="text" name="tytul_add" class="input tsr-remove-selection" placeholder="black min" autocomplete="off" focus="false">
															</section>
														</section>
														<section class="tsr tsr-remove-selection">					
															<section class="col-inp-25 tsr-p-10px fs-90 ">
																<span class="tsr-vertical-align-sub">
																	target:
																</span>
															</section>
															<section class="col-inp-75 tsr-p-10px fs-90">
																<select name="target_add">
																	<option value="_self">W tej samej karcie</option>
																	<option value="_blank">W nowej karcie</option>
																	<option value="_parent">W ramce</option>
																	<option value="_top">W nowym oknie</option>
																</select>
															</section>
														</section>
														<div class="tsr tsr-mt-50 tsr-clear-both tsr-remove-selection">
															<section class="tsr tsr-inp col-2 tsr-pr-10px tsr-remove-selection">
																<button type="button" value="Dodaj link" class="buttom" id="link_add">Dodaj link</button>
															</section>
															<section class="tsr tsr-button tsr-error tsr-modal-closed-button col-2">
																<span >
																	Anuluj!
																</span>
															</section>
														</div>
														<section class="tsr">
														</section>
													</section>
												</section>
											</section>
										</div>
										
										<section class="aquay-ikona cursor-pointer usun_link" onclick="aquay_edytor_format('unlink');">
											<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/flags/unlink-big.png" alt="usuń link" title="usuń link">
										</section>
									</section>	
									<section class="aquay-sekcjia">
										<!--<select onchange="aquay_edytor_format('formatBlock', this.value);" class="aquay-select aquay-input-margin naglowek" alt="format nagłówków" title="format nagłówków">
											<option value="DIV">Narmalny tekst</option>
											<option value="H1">Nagłówek 1</option>
											<option value="H2">Nagłówek 2</option>
											<option value="H3">Nagłówek 3</option>
											<option value="H4">Nagłówek 4</option>
											<option value="H5">Nagłówek 5</option>
											<option value="H6">Nagłówek 6</option>
											<option value="blockquote">Cytat</option>
										</select>-->
										
										<select onchange="aquay_edytor_format('fontSize', this.value);" class="aquay-select aquay-input-margin wielkosc_tekstu" alt="Wielkość tekstu" title="Wielkość tekstu">
											<option value="3">Normal</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
										</select>
										<select onchange="aquay_edytor_format('fontName', this.value);" class="aquay-select aquay-input-margin czcionka" alt="czcionka" title="czcionka">
											<option value="Arial">Domyśna</option>
											<option value="Arial">Arial</option>
											<option value="Comic Sans MS">Comic Sans MS</option>
											<option value="Courier">Courier</option>
											<option value="Georgia">Georgia</option>
											<option value="Tahoma">Tahoma</option>
											<option value="Times New Roman">Times New Roman</option>
											<option value="Verdana">Verdana</option>
										</select>
										<input type="color" onchange="aquay_edytor_format('foreColor', this.value);" class="aquay-input-color aquay-input-margin akolor_tekstu" alt="kolor tekstu" title="kolor tekstu"/>
										<input type="color" onchange="aquay_edytor_format('hiliteColor', this.value);" class="aquay-input-color aquay-input-margin kolor_tla" alt="kolor tła" title="kolor tła"/>
										<div class="aquay-ikona aquay-bar"></div>
										<section class="aquay-ikona aquay-input-margin">
											<section class="aquay-edytor-menu">
												<img src="<?php echo BM_SETTINGS["url_server"]; ?>files/global/timonix-aquay-edytor/ikony/add_element/showblocks-add.png" alt="dodaj diva" title="dodaj diva">
											</section>
											<section class="aquay-edytor-element-menu">
												<section class="aquay-edytor-menu-icons aquay-blok-akapit" data-blok="akapit">
													Akapit
												</section>
												<section class="aquay-edytor-menu-icons aquay-blok-cytat" data-blok="cytat">
													Cytat
												</section>
												<section class="aquay-edytor-menu-icons aquay-blok-naglowek" data-blok="naglowek">
													Nagłówek
												</section>
												<section class="aquay-edytor-menu-icons aquay-blok-obrazek" data-blok="obrazek">
													Obrazek
												</section>
												<section class="aquay-edytor-menu-icons aquay-blok-galeria" data-blok="galeria">
													Galeria
												</section>
												<section class="aquay-edytor-menu-icons aquay-blok-plik" data-blok="plik">
													Plik
												</section>
												<section class="aquay-edytor-menu-icons aquay-blok-kod" data-blok="kod">
													Kod
												</section>
												<section class="aquay-edytor-menu-icons aquay-blok-wlasny-html" data-blok="wlasny_html">
													Własny HTML
												</section>
											</section>
										</section>
									</section>
								</section>
								<div class="aquay-bloki-powiel">
									<section class="aquay-edytuj-blok-kopiuj aquay-kopia-blok-separator">
										<div class="aquay-edytor-separator">
											<div class="aquay-edytor-separator-tytul">
												Dodaj Element
											</div>
										</div>
									</section>									
									<section class="aquay-edytuj-blok-kopiuj aquay-kopia-blok-text">
										<div class="aquay-edytuj-container" data-blok-type="type_blok/text">
											<div class="aquay-type-title">edytuj text</div>
											<div class="aquay-edytor-text aquay-edytuj-text" data-type="type/text" tabindex="0" contenteditable="true" >abc</div>
										</div>
									</section>
									<section class="aquay-edytuj-blok-kopiuj aquay-kopia-blok-cytat">
										<div class="aquay-edytuj-container" data-blok-type="type_blok/cytat">
											<div class="aquay-type-title">edytuj cytat</div>
											<div class="aquay-edytor-cytat aquay-edytuj-text" data-type="type/cytat" tabindex="0" contenteditable="true" >abc</div>
										</div>
									</section>
									<section class="aquay-edytuj-blok-kopiuj aquay-kopia-blok-naglowek">
										<div class="aquay-edytuj-container" data-blok-type="type_blok/naglowek">
											<div class="aquay-type-title">edytuj Nagłówek</div>
											<div class="aquay-edytor-naglowek aquay-edytuj-text" data-type="type/naglowek" tabindex="0" contenteditable="true" >abc</div>
										</div>
									</section>	
									<section class="aquay-edytuj-blok-kopiuj aquay-kopia-blok-kod">
										<div class="aquay-edytuj-container" data-blok-type="type_blok/kod">
											<div class="aquay-type-title">edytuj kod</div>
											<code class="aquay-edytor-kod aquay-edytuj-text" data-type="type/kod" tabindex="0" contenteditable="true" >abc</code>
										</div>
									</section>
									<section class="aquay-edytuj-blok-kopiuj aquay-kopia-blok-wlasny-html">
										<div class="aquay-edytuj-container" data-blok-type="type_blok/wlasny_kod">
											<div class="aquay-type-title">edytuj własny kod html</div>
											<div class="aquay-edytor-wlasny_kod aquay-edytuj-text" data-type="type/wlasny_kod" tabindex="0" contenteditable="true" >abc</div>
										</div>
									</section>
									<section class="aquay-edytuj-blok-kopiuj aquay-kopia-blok-obrazek">
										<div class="aquay-edytuj-container" data-blok-type="type_blok/obrazek" aquay-obiect="get_obiect">
											<div class="aquay-type-title">edytuj obrazek</div>
											<div class="aquay-edytor-obrazek aquay-edytuj-obrazek" data-type="type/obrazek" tabindex="0" >
												<div class="aquay-obrazek-url">
													<div class="aquay-input-title">Wklej własny obrazek</div>
													<input type="url" name="aquay-url-paste" class="input aquay-input aquay-link" placeholder="Wklej własny obrazek" autocomplete="off"/>
												</div>
												<div class="aquay-add-media aquay-top-separator tsr-xpmodal" tsr-modal-max="width"  aquay-obiect-put=".aquay-get-miniaturka"  aquay-type="image" aquay-multiply="false" aquay-obiect-type="img" id="">
													Dodaj z Dysku
													<div class="tsr-modal">
														<section class="tsr load-data">
															<section class="tsr-alert tsr-alert-info">Ładowanie danych</section>
														</section>
													</div>
												</div>
												<div class="aquay-load-obrazek aquay-top-separator"></div>
											</div>
										</div>
									</section>	
									<section class="aquay-edytuj-blok-kopiuj aquay-kopia-blok-galeria">
										<div class="aquay-edytuj-container" data-blok-type="type_blok/galeria">
											<div class="aquay-type-title">edytuj galerie</div>
											<div class="aquay-edytor-galeria aquay-edytuj-galerie" data-type="type/galeria" tabindex="0" >
												<div class="aquay-add-media aquay-top-separator tsr-xpmodal" tsr-modal-max="width"  aquay-obiect-put=".aquay-load-galeria"  aquay-type="image" aquay-multiply="true" aquay-obiect-type="img" id="">
													Dodaj z Dysku
													<div class="tsr-modal">
														<section class="tsr load-data">
															<section class="tsr-alert tsr-alert-info">Ładowanie danych</section>
														</section>
													</div>
												</div>
												<div class="aquay-load-galeria aquay-top-separator"></div>
											</div>
										</div>
									</section>	
									<section class="aquay-edytuj-blok-kopiuj aquay-kopia-blok-plik">
										<div class="aquay-edytuj-container" data-blok-type="type_blok/plik">
											<div class="aquay-type-title">pobierz plik</div>
											<div class="aquay-edytor-plik aquay-edytuj-plik" data-type="type/plik" tabindex="0" >
												<div class="aquay-add-media aquay-top-separator tsr-xpmodal" tsr-modal-max="width"  aquay-obiect-put=".aquay-load-plik"  aquay-type="all" aquay-multiply="false" aquay-obiect-type="text" id="">
													Dodaj z Dysku
													<div class="tsr-modal">
														<section class="tsr load-data">
															<section class="tsr-alert tsr-alert-info">Ładowanie danych</section>
														</section>
													</div>
												</div>
												<button type="button" class="aquay-load-plik aquay-top-separator aquay-edytuj-text aquay-input aquay-button-pobierz" formtarget="_blank" target="_blank" data-type="type/text" tabindex="0" contenteditable="true" data-pobierz="" >Pobierz!</button>
											</div>
										</div>
									</section>	
								</div>
								<div class="aquay-text aquaytext background-white" contenteditable="false" name="aquaytext" id="aquaytext">
									
									<div class="aquay-edytuj-container" data-blok-type="type_blok/text">
										<div class="aquay-type-title">edytuj text</div>
										<div class="aquay-edytor-text aquay-edytuj-text" data-type="type/text" tabindex="0" contenteditable="true" >abc</div>
									</div>
									
								</div>
							</div>

							<script type="text/javascript">	


							</script>
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
				
	<script>
				
	$('#status_post').change(function(){
	var status_post = $('#status_post').val();
	
	if (status_post == "protect_password") {
		$("#protect_password").css("display", "block");
	}else{
		$("#protect_password").css("display", "none");
	}
	
	});
		
	</script>
	
	<script type="text/javascript">
		
		$('#submit_post').click('submit', function(evt1){	
		evt1.preventDefault();
		var tytul= $('input[name="tytul"]').val();
		var url= $('input[name="url"]').val();
		var kategoria_post= $('select[name="kategoria_post"]').val();
		var status= $('select[name="status"]').val();
		var password_post= $('input[name="password_post"]').val();
		var kategoria= $('select[name="kategoria"]').val();
		var tag= $('input[name="tag"]').val();
		var get_kod = aquay_edytor_get_code();
		var tresc = compiler_aquay_black_min(get_kod);
		var miniaturka = $(".aquay-get-miniaturka").html();
		
		$.ajax({
			type:"POST",
			url:"insert/add-post.php",
			data:{
				tytul:tytul,
				url:url,
				kategoria:kategoria,
				kategoria_post:kategoria_post,
				status:status,
				password_post:password_post,
				tag:tag,
				tresc:tresc,
				miniaturka:miniaturka,
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

</body>
</html>