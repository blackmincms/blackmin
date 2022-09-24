<?php

/* 
	The Braund Themes
*/

	use BlackMin\Database\Database;
	use BlackMin\Router\URL;	
	use BlackMin\View\View;
	use BlackMin\Head\Head;
	use BlackMin\Router\Router;
	use BlackMin\Menu\MenuGenerate;
	use BlackMin\Plugin\PluginGenerate;

	$db = new Database();

	$router = new Router($db);

	$view = new View();

	$menuGenerate = new menugenerate();

	$pluginGenerate = new PluginGenerate();

	
?>
<!DOCTYPE html>
<html lang="<?php echo BM_SETTINGS["bm_lang_site"]; ?>" class="">
<head>
	
	<?php


		$url = new url();

		$urls = $url->check_url();

		$head_bm = new head();
		$head_bm->set_title("motyw braund");
		$head_bm->add_description("motyw braund");
		$head_bm->add_keywords("motyw braund");
		$head_bm->add_css("jquery_ui");
		$head_bm->add_css(BM_SETTINGS["url_server"]."files/css/timonix_styles_rezult.css", "bm");
		$head_bm->add_css("css/braund.css", NULL);
		$head_bm->add_script("jquery", "bm");
		$head_bm->add_script("jquery_ui", "bm");
		
		if($urls === "root"){
			$head_bm->add_script("js/home.js", NULL);
		}

		if ($urls === "maintenance_mode") {
			$head_bm->add_title("Przerwa Techniczna - ");
			$head_bm->set_robots(NULL);
		}
		
		$head_bm->load_head();
	
	?>
	
</head>
<body>

	<?php
		if($urls === "maintenance_mode"){
			$view->set(BMPATH . "bm/core/load/date-format.php");
			$view->renderViewOnly();
			require_once "content/bm-przerwa-techniczna.php";
			exit();
		}	
	?>

	<div class="tsr tsr-p-5px background-black"></div>
	<div id="overlay" class="tsr-mt-5 tsr-mb-20" style="background-color: #eeeeee;">
		<section class="overlay tsr-mt-10 tsr-mb-20">
			<section class="col-inp-75 tsr-p-10px">
				<section class="col-ms60">
					<img src="<?php echo BM_SETTINGS["bm_banner"];?>" alt="<?php echo BM_SETTINGS["bm_banner"];?>">
				</section>
				<section class="col-ms40">
					<img src="<?php echo BM_SETTINGS["bm_logo"];?>" alt="<?php echo BM_SETTINGS["bm_logo"];?>">
				</section>
			</section>
			<section class="col-inp-25 tsr-p-10px">
				<section class="tsr tsr-mt-20 fs-90">
					<a href="<?php echo BM_SETTINGS["url_site"];?>bm/logowanie.php">
						Logowanie
					</a>
				</section>
				<section class="tsr tsr-mt-20">
					<form accept-charset="UTF-8" action="" method="get" id="search_form" autocomplete="off" class="tsr-p-10px">	
						<section class="tsr tsr-position-relative">						
							<input type="search" name="search" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj" value="<?php echo ($url->bm_url()["path"] === "all" ? "" : $url->bm_url()["path"]) ?>">
							<input type="image" name="search" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10" src="<?php echo BM_SETTINGS["url_server"];?>pliki/ikony/szukaj.png" >
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

					$menuItem = $router->createInstanceWith("get", "Menu", [])->delegate();
					echo $menuGenerate->loadMenu($menuItem);
				
				?>
				
			</section>
		</nav>
	
	</header>

	<?php if(BM_SETTINGS["bm_top_widget"] !== 'NULL'){?><div class="top-box tsr tsr-p-10px tsr-mt-10 tsr-mb-10 background-white">
		<?php 
			$PRender = $pluginGenerate->pluginLoad("bm_widget_top");
			if (is_string($PRender)) {
				echo $PRender;
			}
		?>
	</div><?php };?>

	<main id="container">
		<div class="container tsr-p-10px">
			<section class="col-inp-75 tsr-p-10px tsr-mt-50">
			<?php  
			
	
				if($urls == "post_page"){
					require_once "content/post-page.php";
				}
				
				if($urls == "root"){
					require_once "content/home.php";
				}	
				
				if($urls == "search_page"){
					require_once "content/search-page.php";
				}
				
				if($urls == "error_bm"){
					require_once "content/post-404.php";
				}	
				
			?>	
			</section>	
			<aside class="right-box tsr tsr-p-10px tsr-mt-10 tsr-mb-10 background-white col-inp-25 ">
				<?php
					$PRender = $pluginGenerate->pluginLoad("bm_widget_right");
					if (is_string($PRender)) {
						echo $PRender;
					}
				?>
			</aside>
		</div>
	</main>
	
	<?php if(BM_SETTINGS["bm_bottom_widget"] != 'NULL'){?><div class="bottom-box tsr tsr-p-10px tsr-mt-10 tsr-mb-10 background-white">
		<?php
			$PRender = $pluginGenerate->pluginLoad("bm_widget_bottom");
			if (is_string($PRender)) {
				echo $PRender;
			}
		?>
	</div><?php };?>

	<footer class="tsr-mt-100 tsr-stopka-navigation" >
		<footer class="tsr-stopka-navigation">
			<?php if(BM_SETTINGS["bm_footer_widget"] != 'NULL'){?>
			<section class="tsr-stopka-auto">
				<section class="tsr-stopka-text  tsr tsr-p-10px tsr-mt-10 tsr-mb-10">
					<?php  
						$PRender = $pluginGenerate->pluginLoad("bm_widget_footer");
						if (is_string($PRender)) {
							echo $PRender;
						}
					?>
				</section>
			</section>
			<?php };?>
			<section class="tsr-stopka-auto">
				<section class="tsr-stopka-text">
					<section class="col-3 tsr-mt-10">
						<?php echo BM_SETTINGS["bm_name_site"];?>
						<section class="fs-70 tsr-mt-10">
							BlackMin/Braund 
						</section>
						<section class="tsr tsr-mt-20 fs-150 tsr-stopka-text background-green tsr-p-10px">
							<a href="<?php echo BM_SETTINGS["url_server"];?>bm/logowanie.php">
								Logowanie
							</a>
						</section>
						<section class="tsr tsr-mt-20">
							<form accept-charset="UTF-8" action="" method="get" id="search_form" autocomplete="off" class="tsr-p-10px">	
								<section class="tsr tsr-position-relative">						
									<input type="search" name="search" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj" value="<?php echo ($url->bm_url()["path"] === "all" ? "" : $url->bm_url()["path"]) ?>">
									<input type="image" name="search" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10" src="<?php echo BM_SETTINGS["url_server"];?>pliki/ikony/szukaj.png" >
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
									
									$menuGenerate->setTag("div", "div", "div");
									$menuGenerate->setClass("tsr fs-60 tsr-stopka-text", "tsr fs-100 tsr-ml-5", "tsr fs-90 tsr-ml-10");
									echo $menuGenerate->loadMenu($menuItem);
									
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
			<section class="tsr-stopka ">
				<section class="tsr tsr-stopka-text2 tsr-mt-20">
					<section class="tsr col-2 fs-80">
						Powyższa Strona Używa Black Min CMS \ 
						Wszelkie prawa zastrzeżone © 2020/2022 - <?php echo BM_SETTINGS["bm_name_site"];?>
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