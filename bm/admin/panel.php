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
		Panel Admina - Black Min 
	</section>
	<section class="tsr tsr-p-10px background-white tsr-mt-20">
		<section class="tsr fs-90 l-0">
			Start z Black Min CMS
			<section class="tsr fs-70">
				O to pomocne linki:
			</section>
			<section class="tsr tsr-mt-20">
				<section class="col-3 fs-80">
					<section class="tsr">
						Start
					</section>	
					<section class="tsr tsr-mt-10"></section>
					<section class="tsr-button tsr-normal">
						<a href="add-post.php"> 
							Dodaj Post
						</a>
					</section>	
				</section>
				<section class="col-3 fs-80">
					<section class="tsr">
						Na Start
					</section>	
					<section class="tsr fs-80">
						<a href="all-theme.php">Motyw</a>
					</section>
					<section class="tsr fs-80">
						<a href="property-server.php">Ustawienia</a>
					</section>
					<section class="tsr fs-80">	
						<a href="all-plugin.php">Pluginy</a>
					</section>	
				</section>
				<!--<section class="col-3 fs-80">
					<section class="tsr">
						Inne
					</section>	
					<section class="tsr fs-80">	
						<a href="">Jak Korzystać Z Black Mina'a</a>
						<a href="">O Black Minie</a>
						<a href="">BlackMin</a 
					</section>
				</section>-->
			</section>
		</section>
	</section>

	<?php require_once "admin-footer.php"; ?>