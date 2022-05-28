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
*	This file is update server settings | admin panel
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
        <section class="tsr" id="blackminload_execute_container" blackmin="input;url_serwera_bm;url_server,input;url_witryny_bm;url_site,input;mail_witryny;bm_mail_site,select;ranga_bm;bm_new_user,select;jezyk_witryny;bm_lang_site,select;strefa_czasowa_witryny;bm_timezone,input;date_witryny;bm_date,input;time_witryny;bm_time,input;admin_witryny;" id-object="url_server,url_site,bm_mail_site,bm_new_user,bm_lang_site,bm_timezone,bm_date,bm_time,bm_installation_admin">					
			<?php 
				try {
					$BMROUTER = $BMROUTER->createInstanceWith("load", "Settings", "Server");
					$BMROUTER->delegate();
				} catch (\BlackMin\Exception\RouterException $e) {
					$BMMESSAGE->createView("error", '<b>BlackMIn: </b> <i>ERROR</i> - '. $e->getMessage());
				}
            ?>
		</section>	
	</section>

	<?php require_once "admin-footer.php"; ?>