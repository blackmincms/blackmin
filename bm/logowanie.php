<?php
				
	require_once("admin/black-min-sm.php");
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$flaga = $_SESSION['flaga'];
		$user_t = "";
					
		if($flaga <= 5){
			$user_t = "user/user-";
		}else{
			$user_t = "admin/admin-";
		}
		header('Location: '.$user_t.'panel.php');
		exit();
	}

?>

<!DOCTYPE html>
<html lang="pl" class="">
<head>
	
	<!-- arkusze stylów css ON -->
	<link rel="stylesheet" href="../files/css/timonix_styles_rezult.css">
	<link rel="stylesheet" href="../files/global/jquery-modal-master/jquery.modal.ms.css" />
    <link rel="stylesheet" href="../files/global/jquery.tabSlideOut.js-master/jquery.tabSlideOut.css">	 
	<link rel="stylesheet" href="../files/global/jquery/jquery-ui.css" />	
	<!-- arkusze stylów css OFF -->
    <!-- roszerzenie aplikacj strony KODOWANIE     » » » »      -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Script-Type" content="text/javascript">
	<!-- Koniec roszerzenia aplikacj strony KODOWANIE   » » » » -->
	<!-- Rozpoczynane Znaczników meta i meta_data i metadata i robots-->
	<meta name="viewport" content="width=1600">
    <title>Logowanie - Black Min CMS</title>
 
	<!-- SKRYPTY -->
	<script src="../files/global/jquery/jquery.min.js"></script> 
	<script src="../files/global/jquery.tabSlideOut.js-master/jquery.tabSlideOut.js"></script> 
 	<script src="../files/global/jquery/jquery-ui.min.js"></script>
	<script src="../files/global/jquery-modal-master/jquery.modal.min.js"></script>
	<script src="../script.js"></script>
	<!-- KONIEC SKRYPTY -->	

</head>
<body>
<?php

require_once "../connect.php";

?>
				
	<!-- container - tresc strony ON -->
	<div id="container blocker">
		<section class="container blocker current" style="max-width: 100%;">		
				
			<div id="" class="tsr modal modal2 modal-auto" style="display: inline-block;">
				<section class="tsr">
					<?php
						if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
					?>	
				</section>
				<section class=" tsr tsr-p-10px fs-150">
					<span>
						Logowanie
					</span>
				<section class="lin"></section>
				</section>
					
				<form action="zaloguj.php" method="post">	
				
				<section class="tsr-inp"></section>
				<section class="col-inp-4 tsr-p-10px fs-110 " >
					<span>
						Login:
					</span>
				</section>
				<section class="col-inp-5-5 tsr-p-10px fs-110" >
						<input type="text" name="login" class="input" placeholder="login"/>
				</section>
				<section class="col-inp-4 tsr-p-10px fs-110 " >
					<span>
						Hasło:
					</span>
				</section>
				<section class="col-inp-5-5 tsr-p-10px fs-110" >
						<input type="password" name="haslo" class="input" placeholder="hasło"/>
				</section>
				<section class="tsr-inp tsr-mt-50">
				<input type="submit" value="Zaloguj się" class="input buttom"/>
				</section>		
				
			</form>				
			<a href="javascript: history.back()" class="close-modal2 tsr-aufle-close "><img src="../pliki/ikony/zamknij.png" class="img" /></a>
			</div>	
		</section>
	</div>	
	<!-- container - tresc strony OFF -->

	<script>
	$(document).ready(function() { 
		console.clear()
	});
	</script>	

</body>
</html>