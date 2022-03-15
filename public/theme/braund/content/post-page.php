<?php
function data_format($datetime, $foramt_czasu) {

    $date = date_create($datetime);

    $datetime_format = date_format($date, $foramt_czasu);

    return $datetime_format;

}
	// load posts
    $drt = $posts;
	$posts->renderPost();
	
	// check error post
	if ($drt->status_post() == "ERROR_404"){
		require_once "post-404.php";
	}elseif ($drt->status_post() == "protect_password"){
		if (isset($_POST["acces_to_protect_post"])){
			// weryfikowania hasła
			$drt->change_password(htmlspecialchars($_POST["acces_to_protect_post"]));
            $posts->renderPost();
		}
	}
	
	if(($drt->status_post() == "public") OR ($drt->status_post() == "protect_password")){
		if($drt->tag_post() != "protect password"){
?>

			<section class="tsr fs-100 l-0 tsr-mt-10 tsr-post-auto braund-post-<?php echo $drt->id_post(); ?>">
				<?php if($drt->thumbnail_post() != NULL){?>
				<section class="tsr col-ms20">
					<?php echo $drt->thumbnail_post(); ?>
				</section>
				<section class="tsr col-ms80 tsr-p-10px">
					<?php echo $drt->title_post(); ?>
				</section>
				<section class="tsr col-ms80 fs-100 tsr-p-10px">
					opublikowano dnia <?php echo data_format($drt->datetime_post(), "m.d.Y"); ?> o godzinie <?php echo data_format($drt->datetime_post(), "H:i"); ?> przez <?php echo $drt->author_post(); ?>
				</section>
				<?php }else{?>
				<section class="tsr tsr-p-10px">
					<?php echo $drt->title_post(); ?>
				</section>
				<section class="tsr fs-100 tsr-p-10px">
					opublikowano dnia <?php echo data_format($drt->datetime_post(), "m.d.Y"); ?> o godzinie <?php echo data_format($drt->datetime_post(), "H:i"); ?> przez <?php echo $drt->author_post(); ?>
				</section>
				<?php }?>
				<section class="tsr tsr-border-solid-bottom tsr-mt-10"></section>
				<section class="tsr fs-100 tsr-mt-10 tsr-post-auto tsr-za-wi">
					<?php echo $drt->contents_post(); ?>
				</section>
			</section>
			<section class="tsr tsr-border-solid-bottom tsr-mt-10"></section>
	
<?php 
		}
		
		if ($drt->status_post() == "protect_password"){
			if($drt->validate_password_post() == false){

				echo'
				<form accept-charset="UTF-8" action="" method="post" id="add_post" autocomplete="off">	
					<section class="tsr tsr-p-10px tsr-algin-left">Wpisz hasło aby zobaczyć zawartość posta!</section>
					<input type="text" name="acces_to_protect_post" class="tsr-mt-10" />
					<button type="submit" class="tsr-mt-10" >Wyśli hasło</button>
				</form>
				';
			}
		}		
	} 
?>	


