<?php

	require_once "admin/black-min.php";

	use BlackMin\Menu\menuAdmin;
	use BlackMin\Head\HeadAdmin;
	use BlackMin\Media\SFL;

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$flaga = $_SESSION['flaga'];
		$user_t = "";
					
		if($flaga <= 5){
			$user_t = "user/";
		}else{
			$user_t = "admin/";
		}
		header('Location: '.$user_t.'panel.php');
		exit();
	}

?>

<!DOCTYPE html>
<html lang="<?php echo BM_SETTINGS["bm_lang_site"] ?>" class="">
<head>

	<?php 
		$BM_HEAD = new HeadAdmin ();
		$BM_HEAD->load();
		$SFL->load_css();
		$SFL->load_js();
		$SFL->load_php();
	?>

</head>
<body>

	<main class="container" style="
		position: relative;
		display: flex;
		flex-wrap: nowrap;
		flex-direction: row;
		align-content: center;
		justify-content: center;
		align-items: center;
		height: -webkit-fill-available!important;">
		<section class="container" style="
		    position: relative;
			display: flex;
			flex-wrap: nowrap;
			flex-direction: row;
			align-content: center;
			justify-content: space-around;
			align-items: center;
			height: -webkit-fill-available!important;">
				
			<div class="tsr col-flex  tsr-p-10px background-bialy tsr-border-solid-orange" style="display: inline-block; width: 500px; min-width: 200px; max-height: 500px; height: auto; min-height: 200px; max-height: 500px; border-radius: 10px;">
				<section class=" tsr tsr-p-10px fs-150">
					<span>
						Logowanie BlackMin
					</span>
				<section class="lin"></section>
				</section>
					
				<form accept-charset="UTF-8" action="login" url="user" method="post" id="blackminsend" class="tsr-position-relative">	
					
					<section class="tsr-inp"></section>
					<section class="col-inp-4 tsr-p-10px fs-110 " >
						<span>
							Login:
						</span>
					</section>
					<section class="col-inp-5-5 tsr-p-10px fs-110" >
							<input type="text" name="login" class="input" placeholder="login" require notranslated/>
					</section>
					<section class="col-inp-4 tsr-p-10px fs-110 " >
						<span>
							Hasło:
						</span>
					</section>
					<section class="col-inp-5-5 tsr-p-10px fs-110" >
							<input type="password" name="haslo" class="input" placeholder="hasło" require notranslated/>
					</section>
					<section class="tsr-inp tsr-mt-50">
					<input type="submit" value="Zaloguj się" class="input buttom tsr-disable-button submit_data" id="submit_data"/>
					</section>		
					<a href="javascript: history.back()" class="close-modal2 tsr-aufle-close "><img src="pliki/ikony/zamknij.png" class="img" /></a>
					<div class="lin"></div>
					<section class="tsr" id="blackminload_container">							
					</section>	
				</form>				
			</div>	
		</section>
	</main>	

</body>
</html>