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
*	This file is update social | admin panel
*/


	// ładowanie jądra black mina
	require_once "black-min.php";

	// add auto edit script
	$SFL->add_js(BM_SETTINGS["url_server"] . "files/js/blackmin-autoedit.js");

	require_once ("admin-head.php");
	
?>	

	<section class="tsr fs-130 l-0">
        Edytuj Kategorie/Tag - Black Min 
	</section>
	<section class="tsr tsr-p-10px background-white tsr-mt-20">
        <section class="tsr" id="blackminload_execute_container" blackmin="input;bm_spolecznosc_opis;bm_cookie_description,input;bm_spolecznosc_link;bm_cookie_link,input;bm_spolecznosc_link_info_cookies;bm_cookie_privacy_policy_link,input;bm_spolecznosc_text_akcept;bm_cookie_accept" id-object="bm_cookie_description,bm_cookie_link,bm_cookie_privacy_policy_link,bm_cookie_accept">					
			<?php 
				try {
					$BMROUTER = $BMROUTER->createInstanceWith("load", "Settings", "social");
					$BMROUTER->delegate();
				} catch (\BlackMin\Exception\RouterException $e) {
					$BMMESSAGE->createView("error", '<b>BlackMIn: </b> <i>ERROR</i> - '. $e->getMessage());
				}
            ?>
		</section>	
	</section>

	<?php require_once "admin-footer.php"; ?>