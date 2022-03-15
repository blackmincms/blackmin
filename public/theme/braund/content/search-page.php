<?php

	// load posts
    $drt = $posts;
    $posts->renderPost();

	if($drt->query_load_post() == "0"){
		echo '
			<section class="tsr tsr-p-10px tsr-mt-20 tsr-mb-20 fs-120 l-0" style="background-color: #eeeeee;">
				Nie znaleziono postów dla wyniku wyszukiwania: '.$ur->bm_url()["path"].'.
			</section>
		';
	}

	if($drt->query_load_post() >= "1"){
		echo '
			<section class="tsr tsr-p-10px tsr-mt-20 tsr-mb-20 fs-90 l-0" style="background-color: #eeeeee;">
				Wynik wyszukiwania dla: '.$ur->bm_url()["path"].'. Znalezionych Postów: '.$drt->query_load_post().'
			</section>
		';
	}

	for($i=0; $i < $drt->query_load_post(); $i++){	

		if(($drt->status_post()[$i] == "public") OR ($drt->status_post()[$i] == "protect_password")){
			if($drt->title_post()[$i] != "protect_password"){
?>

				<section class="tsr fs-100 l-0 tsr-mt-10 tsr-post-auto tsr-border-solid-bottom braund-post-<?php echo $drt->id_post()[$i]; ?>">
					<?php if($drt->thumbnail_post()[$i] != NULL){?>
					<section class="tsr col-ms20">
						<?php echo $drt->thumbnail_post()[$i]; ?>
					</section>
					<section class="tsr col-ms80 tsr-p-10px">
						<?php echo $drt->title_post()[$i]; ?>
					</section>
					<section class="tsr col-ms80 fs-100 tsr-p-10px">
						opublikowano dnia <?php echo data_format($drt->datetime_post()[$i], "m.d.Y"); ?> o godzinie <?php echo data_format($drt->datetime_post()[$i], "H:i"); ?> przez <?php echo $drt->author_post()[$i]; ?>
					</section>
					<?php }else{?>
					<section class="tsr tsr-p-10px">
						<?php echo $drt->title_post()[$i]; ?>
					</section>
					<section class="tsr fs-100 tsr-p-10px">
						opublikowano dnia <?php echo data_format($drt->datetime_post()[$i], "m.d.Y"); ?> o godzinie <?php echo data_format($drt->datetime_post()[$i], "H:i"); ?> przez <?php echo $drt->author_post()[$i]; ?>
					</section>
					<?php }?>
					<section class="tsr fs-100 tsr-mt-10 tsr-post-auto tsr-za-wi">
						<?php 
						if($drt->contents_post()[$i] == "protect_password"){
							echo "Post Zabespieczony Hasłem!";
						}else{
							echo $drt->contents_post()[$i];
						}						
						?>
					</section>
					<section class="tsr fs-80 r-0 tsr-mb-10">
						<a href="<?php echo  $get_ustawienia_bm["bm_url_site"] . $drt->url_post()[$i]; ?>">
							Pokaż więcej!
						</a>
					</section>
				</section>
	
<?php 
			}			
		} 
	}
?>	
