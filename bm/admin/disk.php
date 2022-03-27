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
*	This file is start page | admin panel
*/


	// ładowanie jądra black mina
	require_once "black-min.php";

	require_once ("admin-head.php");
	
?>	

	<section class="tsr fs-130 l-0">
		Dysk - Black Min 
	</section>
	<section class="tsr tsr-p-10px background-white tsr-mt-20">
		<section class="tsr" id="blackminload_execute_container">			
			<section class="tsr-alert tsr-alert-info">Ładowanie danych!</section>				
		</section>	
	</section>

	<?php require_once "admin-footer.php"; ?>