<?php

	$view->set(BMPATH . "bm/core/load/date-format.php");
	$view->renderViewOnly();

	$posts = $router->createInstanceWith("get", "Post", ["max" => "100", "status" => "public", "url" => $url->bm_url()["path"]])->delegate();

	if($posts["num_rows"] == "0"){
		echo '
			<section class="tsr tsr-p-10px tsr-mt-20 tsr-mb-20 fs-120 l-0" style="background-color: #eeeeee;">
				Nie znaleziono postów dla wyniku wyszukiwania: '.$url->bm_url()["path"].'.
			</section>
		';
	}

	if($posts["num_rows"] >= "1"){
		echo '
			<section class="tsr tsr-p-10px tsr-mt-20 tsr-mb-20 fs-90 l-0" style="background-color: #eeeeee;">
				Wynik wyszukiwania dla: '. $url->bm_url()["path"] .'. Znalezionych Postów: '. $posts["num_rows"] .'
			</section>
		';
	}

	for($i=0; $i < $posts["num_rows"]; $i++){	

		if(($posts[$i]["status"] == "public") OR ($posts[$i]["status"] == "protect_password")){
			if($posts[$i]["title"] != "protect_password"){
?>

				<article class="tsr fs-100 l-0 tsr-mt-10 tsr-post-auto tsr-border-solid-bottom braund-post-<?php echo $posts[$i]["id_post"]; ?>">
					<?php if($posts[$i]["thumbnail"] != NULL){?>
					<section class="tsr col-ms20">
						<img src="<?php echo $posts[$i]['thumbnail']['src']; ?>" alt="<?php echo $posts[$i]['thumbnail']['title_orginal']; ?>" title="<?php echo $posts[$i]['thumbnail']['title']; ?>" />
					</section>
					<section class="tsr col-ms80 tsr-p-10px">
						<?php echo $posts[$i]["title"]; ?>
					</section>
					<section class="tsr col-ms80 fs-100 tsr-p-10px">
						opublikowano dnia <?php echo data_format($posts[$i]['datetime'], "m.d.Y"); ?> o godzinie <?php echo data_format($posts[$i]['datetime'], "H:i"); ?> przez <?php echo $posts[$i]['authores']; ?>
					</section>
					<?php }else{?>
					<section class="tsr tsr-p-10px">
						<?php echo $posts[$i]["title"]; ?>
					</section>
					<section class="tsr fs-100 tsr-p-10px">
						opublikowano dnia <?php echo $posts[$i]["datetime"]; data_format($posts[$i]["datetime"], "m.d.Y"); ?> o godzinie <?php echo data_format($posts[$i]["datetime"], "H:i"); ?> przez <?php echo $posts[$i]["authores"]; ?>
					</section>
					<?php }?>
					<section class="tsr fs-100 tsr-mt-10 tsr-post-auto tsr-za-wi braund-post">
						<?php 
						if($posts[$i]["content"] == "protect_password"){
							echo "Post Zabespieczony Hasłem!";
						}else{
							echo $posts[$i]["content"];
						}						
						?>
					</section>
					<section class="tsr fs-80 r-0 tsr-mb-10">
						<a href="<?php echo  BM_SETTINGS["url_site"] . $posts[$i]["url"]; ?>">
							Pokaż więcej!
						</a>
					</section>
				</article>
	
<?php 
			}	
		} 
	}
?>	
