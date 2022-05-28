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
*	This file is update profile data | admin panel
*/


	// ładowanie jądra black mina
	require_once "black-min.php";

	// add auto edit script
	$SFL->add_js(BM_SETTINGS["url_server"] . "files/js/blackmin-autoedit.js");
    $SFL->add_js(BM_SETTINGS["url_server"] . "files/js/blackmin-toogleProfil.js");

	require_once ("admin-head.php");
	
?>	

	<section class="tsr fs-130 l-0">
        Edytuj Profil - Black Min 
	</section>
	<section class="tsr tsr-p-10px background-white tsr-mt-20">
        <section class="tsr" id="blackminload_execute_container" blackmin="input;nick,div;nick_view;nick,input;imie;name,div;imie_view;name,input;nazwisko;surname,div;nazwisko_view;surname,input;avatar,div;img;avatar,input;mail;email,div;mail_view;email,div;płeć;gender,div;data;date_join,select;dostep;access,div;dostep_view;access,select;ranga;rank,div;ranga_view;rank,div;online,div;aktywny;last_active,input;haslo;--d,input;haslo2;--d" id-object="id">					
			<?php 
				try {
					$BMROUTER = $BMROUTER->createInstanceWith("load", "User", "edit");
					$BMROUTER->delegate();
				} catch (\BlackMin\Exception\RouterException $e) {
					$BMMESSAGE->createView("error", '<b>BlackMIn: </b> <i>ERROR</i> - '. $e->getMessage());
				}
            ?>
		</section>	
	</section>

	<?php require_once "admin-footer.php"; ?>