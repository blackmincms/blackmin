<?php

	$posts = $router->createInstanceWith("get", "Post", ["url" => $url->get_url_bm()])->delegate();
	$gos = true;
	// check error post
	if ($posts["num_rows"] == 0) {
		require_once("post-404.php");
		$gos = false;
	}elseif ($posts[0]["status"] == "protect_password"){
		if (isset($_POST["acces_to_protect_post"])){
			// weryfikowania hasła
			if (!$_POST["acces_to_protect_post"] === $posts[0]["password"]) {
				$gos = false;
			}
		}
	}

	$view->set(BMPATH . "bm/core/load/date-format.php");
	$view->renderViewOnly();

	if ($gos) {
		$posts = $posts[0];
		
		if(($posts["status"] == "public") OR ($posts["status"] == "protect_password")){
			if($posts["title"] != "protect password"){
?>

				<article class="tsr fs-100 l-0 tsr-mt-10 tsr-post-auto tsr-border-solid-bottom braund-post-<?php echo $posts["id_post"]; ?>">
					<?php if($posts["thumbnail"] !== null){?>
					<section class="tsr col-ms20">
						<img src="<?php echo $posts['thumbnail']['src']; ?>" alt="<?php echo $posts['thumbnail']['title_orginal']; ?>" title="<?php echo $posts['thumbnail']['title']; ?>" />
					</section>
					<section class="tsr col-ms80 tsr-p-10px">
						<?php echo $posts["title"]; ?>
					</section>
					<section class="tsr col-ms80 fs-100 tsr-p-10px">
						opublikowano dnia <?php echo data_format($posts["datetime"], "m.d.Y"); ?> o godzinie <?php echo data_format($posts["datetime"], "H:i"); ?> przez <?php echo $posts["authores"]; ?>
					</section>
					<?php }else{?>
					<section class="tsr tsr-p-10px">
						<?php echo $posts["title"]; ?>
					</section>
					<section class="tsr fs-100 tsr-p-10px">
						opublikowano dnia <?php echo $posts["datetime"]; data_format($posts["datetime"], "m.d.Y"); ?> o godzinie <?php echo data_format($posts["datetime"], "H:i"); ?> przez <?php echo $posts["authores"]; ?>
					</section>
					<?php }?>
					<section class="tsr fs-100 tsr-mt-10 tsr-post-auto tsr-za-wi braund-post">
						<?php 
						if($posts["content"] == "protect_password"){
							echo "Post Zabespieczony Hasłem!";
						}else{
							echo $posts["content"];
						}						
						?>
					</section>
					<section class="tsr fs-80 r-0 tsr-mb-10">
					</section>
				</article>
	
<?php 
			}
		
			/* temporay unset */
			/* if ($drt->status_post() == "protect_password"){
				if($drt->validate_password_post() == false){

					echo'
					<form accept-charset="UTF-8" action="" method="post" id="add_post" autocomplete="off">	
						<section class="tsr tsr-p-10px tsr-algin-left">Wpisz hasło aby zobaczyć zawartość posta!</section>
						<input type="text" name="acces_to_protect_post" class="tsr-mt-10" />
						<button type="submit" class="tsr-mt-10" >Wyśli hasło</button>
					</form>
					';
				}
			} */		
		} 
	}
?>	

	<section class="tsr tsr-mt-50 tsr-float-left l-0">
		<a href="<?php echo BM_SETTINGS["url_site"]; ?>" class="tsr-button tsr-normal"> 
			Home
		</a>
	</section>	
