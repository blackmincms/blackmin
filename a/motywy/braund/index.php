<?php
//	oficialny motyw black min cms
//
//	bm_name: braund
//	bm_description: oficialny motyw braund
//	bm_author:  Black Min cms
//	bm_date_create: 24.11.2019
//	bm_url_theme_bm: nie działa usługa
//	bm_amup_bm: =?-=---?_--__.$2y$10$ytTz15J4x0WlLY3CwoZuh.u7zS7V4kGrP.MBI9H.kPxmyn366CD5..==___??.===_=
//	bm_versions: V.1.5
//
////////////////////// 
	
	global $get_ustawienia_bm;

	$ur = new url_bm();
	
	// plugin load
	$pl = new bm_plugin();
	
?>
<!DOCTYPE html>
<html lang="<?php echo $get_ustawienia_bm["bm_lang_site"]; ?>" class="">
<head>
	
	<?php
	
		$tr = new head_bm();
		$tr->set_title("motyw braund");
		$tr->add_description("motyw braund");
		$tr->add_keywords("motyw braund");
		$tr->add_css("jquery_ui");
		$tr->add_css(url_serwer_bm()."files/css/timonix_styles_rezult.css", "bm");
		$tr->add_css("css/braund.css", NULL);
		$tr->add_script("jquery", "bm");
		$tr->add_script("jquery_ui", "bm");
		
		if($ur->bm_url()["checked_url"] == "post_page"){
			$tr->add_script("js/post_page.js", NULL);
		}
		
		if($ur->bm_url()["checked_url"] == "root"){
			$tr->add_script("js/home.js", NULL);
		}
		
		if($ur->bm_url()["checked_url"] == "search_page"){
			$tr->add_script("js/home.js", NULL);
		}
		
		$tr-> load_head();
	
	?>
	
</head>
<body>

	<?php
		if($ur->bm_url()["checked_url"] == "maintenance_mode"){
			require_once "content/bm-przerwa-techniczna.php";
			exit();
		}	
	?>

	<div class="tsr tsr-p-5px background-black"></div>
	<div id="overlay" class="tsr-mt-5 tsr-mb-20" style="background-color: #eeeeee;">
		<section class="overlay tsr-mt-10 tsr-mb-20">
			<section class="col-inp-75 tsr-p-10px">
				<section class="col-ms60">
					<img src="<?php echo $get_ustawienia_bm["bm_banner"];?>" alt="<?php echo $get_ustawienia_bm["bm_banner"];?>">
				</section>
				<section class="col-ms40">
					<img src="<?php echo $get_ustawienia_bm["bm_logo"];?>" alt="<?php echo $get_ustawienia_bm["bm_logo"];?>">
				</section>
			</section>
			<section class="col-inp-25 tsr-p-10px">
				<section class="tsr tsr-mt-20 fs-90">
					<a href="<?php echo $get_ustawienia_bm["bm_url_server"];?>bm/logowanie.php">
						Logowanie
					</a>
				</section>
				<section class="tsr tsr-mt-20">
					<form accept-charset="UTF-8" action="" method="get" id="search_form" autocomplete="off" class="tsr-p-10px">	
						<section class="tsr tsr-position-relative">						
							<input type="search" name="search" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj" value="<?php if($ur->bm_url()["checked_url"] == "search_page"){echo $ur->bm_url()["path"];};?>">
							<input type="image" name="search" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10" src="<?php echo $get_ustawienia_bm["bm_url_server"];?>pliki/ikony/szukaj.png" >
						</section>
					</form>
				</section>
			</section>
		</section>
	</div>

	<header class="tsr-nav-menu tsr-p-5px tsr-nav-menu tsr-mt-20">
		<nav class="col-ms90 tsr-menu-hiden">
			<section class="col-ms20">
				<section class="img logo tsr-height-webkit-fill-available" ></section>
			</section>
			<section class="col-ms80 ">
			
				<?php 
				
					$au1 = new menu_bm();
					echo $au1->load_menu();
				
				?>
				
			</section>
		</nav>
	
	</header>

	<?php if($get_ustawienia_bm["bm_top_widget"] != '"NULL"'){?><div class="top-box tsr tsr-p-10px tsr-mt-10 tsr-mb-10 background-white"><?php echo $pl->bm_top_widget($get_ustawienia_bm["bm_top_widget"]); ?></div><?php };?>

	<main id="container">
		<article class="container tsr-p-10px">
			<section class="col-inp-75 tsr-p-10px tsr-mt-50">
			<?php  
			
				require_once BMPATH . BM . LADUJ . "class-post.php";

				$drt = new post_bm();
	
				if($ur->bm_url()["checked_url"] == "post_page"){
					require_once "content/post-page.php";
				}
				
				if($ur->bm_url()["checked_url"] == "root"){
					require_once "content/home.php";
				}	
				
				if($ur->bm_url()["checked_url"] == "search_page"){
					require_once "content/search-page.php";
				}
				
				if($ur->bm_url()["checked_url"] == "error_bm"){
					require_once "content/post-404.php";
				}	
				
			?>	
			</section>	
			<div class="right-box tsr tsr-p-10px tsr-mt-10 tsr-mb-10 background-white col-inp-25 "><?php echo $pl->bm_right_widget($get_ustawienia_bm["bm_right_widget"]); ?></div>
		</article>
	</main>
	
	<?php if($get_ustawienia_bm["bm_bottom_widget"] != '"NULL"'){?><div class="bottom-box tsr tsr-p-10px tsr-mt-10 tsr-mb-10 background-white"><?php echo $pl->bm_bottom_widget($get_ustawienia_bm["bm_bottom_widget"]);?></div><?php };?>

	<footer class="tsr-mt-100 tsr-stopka-navigation" >
		<footer class="tsr-stopka-navigation">
			<?php if($get_ustawienia_bm["bm_footer_widget"] != '"NULL"'){?>
			<section class="tsr-stopka-auto">
				<section class="tsr-stopka-text  tsr tsr-p-10px tsr-mt-10 tsr-mb-10">
					<div class="fother-box"><?php echo $pl->bm_footer_widget($get_ustawienia_bm["bm_footer_widget"]);?></div>
				</section>
			</section>
			<?php };?>
			<section class="tsr-stopka-auto">
			<section class="tsr-stopka-text">
				<section class="col-3 tsr-mt-10">
					<?php echo $get_ustawienia_bm["bm_name_site"];?>
					<section class="fs-70 tsr-mt-10">
						Kontakt z nami znajdziesz w zakładce kontakt 
					</section>
					<section class="tsr tsr-mt-20 fs-150 tsr-stopka-text background-green tsr-p-10px">
						<a href="<?php echo $get_ustawienia_bm["bm_url_server"];?>bm/logowanie.php">
							Logowanie
						</a>
					</section>
					<section class="tsr tsr-mt-20">
						<form accept-charset="UTF-8" action="<?php echo $get_ustawienia_bm["bm_url_site"];?>" method="get" id="search_form" autocomplete="off" class="tsr-p-10px">	
							<section class="tsr tsr-position-relative">
								<input type="search" name="szukaj_post" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj" value="<?php if($ur->bm_url()["checked_url"] == "search_page"){echo $ur->bm_url()["path"];};?>">
								<section type="search" name="szukaj" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10" id="search">
									<img src="<?php echo $get_ustawienia_bm["bm_url_server"];?>pliki/ikony/szukaj.png">
								</section>
							</section>
						</form>
					</section>					
				</section>
					<section class="col-3">
						<section class="fs-90 tsr-p-10px">
							Menu kontekstowe
							<section class="fs-80 tsr-mt10">
								<section class="tsr-mt-10">
									<?php 
									
									$au1->set_tag_menu("div", "div", "div");
									$au1->set_class_menu("tsr fs-60 tsr-stopka-text", "tsr fs-100 tsr-ml-5", "tsr fs-90 tsr-ml-10");
									 echo $au1->load_menu();
									
									?>
								</section>
							</section>
						</section>
					</section>
					<section class="col-3">
						<section class="fs-90 tsr-p-10px">
							motyw: braund
							</section>
						</section>
					</section>
			</section>
			</section>
			<section class="tsr-stopka ">
			<section class="tsr tsr-stopka-text2 tsr-mt-20">
				<section class="tsr col-2 fs-80">
					Powyższa Strona Używa Black Min CMS \ 
					Wszelkie prawa zastrzeżone © 2019/2021 - <?php echo name_site_bm();?>
				</section>
				<section class="tsr col-2 fs-80 r-0">
					Projekt i wykonanie: Zespół Black Min cms z oficialnym motywem braund
				</section>
			</section>
			</section>
		</footer>
	</footer>
	

</body>
</html>	