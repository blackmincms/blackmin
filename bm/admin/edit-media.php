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
        <section class="tsr" id="blackminload_execute_container" blackmin="input;tytul;bm_name,input;folder;bm_folder,textarea;opis;bm_description,div;fullName;bm_name_orginal,div;author;autor,div;datetime;bm_datetime_upload;bm_datetime_changed,div;rozszerzenie;bm_file_type,div;path;bm_path" id-object="<?php echo ($_GET["edit"] ?? 'null') ?>">					
			<?php 
				try {
					$BMROUTER = $BMROUTER->createInstanceWith("load", "Media", "add");
					$BMROUTER->delegate();
				} catch (\BlackMin\Exception\RouterException $e) {
					$BMMESSAGE->createView("error", '<b>BlackMIn: </b> <i>ERROR</i> - '. $e->getMessage());
				}
            ?>
		</section>	
	</section>

	<?php require_once "admin-footer.php"; ?>