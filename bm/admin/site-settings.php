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
*	This file is update category\tag | admin panel
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
        <section class="tsr" id="blackminload_execute_container" blackmin="input;tytul_witryny;bm_name_site,textarea;opis_witryny;bm_description_site,input;slowa_kluczowe_witryny;bm_keywords,input;icone_ico_witryny;bm_icon_site,input;icone_witryny;bm_icon_png_site,input;logo_witryny;bm_logo,input;banner_witryny;bm_banner" id-object="bm_name_site,bm_description_site,bm_keywords,bm_icon_site,bm_icon_png_site,bm_logo,bm_banner">					
			<?php 
				try {
					$BMROUTER = $BMROUTER->createInstanceWith("load", "Settings", "site");
					$BMROUTER->delegate();
				} catch (\BlackMin\Exception\RouterException $e) {
					$BMMESSAGE->createView("error", '<b>BlackMIn: </b> <i>ERROR</i> - '. $e->getMessage());
				}
            ?>
		</section>	
	</section>

	<?php require_once "admin-footer.php"; ?>