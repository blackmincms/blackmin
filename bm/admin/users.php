<?php	
/**
*	"Black Min" 
*	
*	For the full copyright and license information, please view the LICENSE
*	file that was distributed with this source code.
*
*	@package BlackMin
*	
*	#file: 2.0
*
*	This file is present data users | admin panel
*/


	// ładowanie jądra black mina
	require_once "black-min.php";

	// add render media script
	$SFL->add_js(BM_SETTINGS["url_server"] . "files/js/admin/default-render.js");

	require_once ("admin-head.php");
	
?>	

	<section class="tsr fs-130 l-0">
		Użytkownicy - Black Min 
	</section>
	<section class="tsr tsr-p-10px background-white tsr-mt-20">
		<section class="tsr" id="blackminload_execute_container">			
			<?php 
				try {
					$BMROUTER = $BMROUTER->createInstanceWith("load", "User", "filter");
					$BMROUTER->delegate();
				} catch (\BlackMin\Exception\RouterException $e) {
					$BMMESSAGE->createView("error", '<b>BlackMIn: </b> <i>ERROR</i> - '. $e->getMessage());
				}
            ?>
		</section>	
	</section>

	<?php require_once "admin-footer.php"; ?>