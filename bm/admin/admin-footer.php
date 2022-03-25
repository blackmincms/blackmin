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
*	This file is footer page | admin panel
*/
?>

		</section>
	</main>
	<!-- Black Min CMS Container Content View -->

		<footer class="tsr-mt-100 tsr-stopka-navigation-right" >
			<footer class="tsr-stopka-navigation">
				<section class="tsr-stopka-auto">
				<section class="tsr-stopka-text">
					<section class="col-3 tsr-mt-10">
						Dziękujemy
						<section class="fs-70 tsr-mt-10">
							dziękujemy że używasz black min'a - zespół Black Min cms 				
						</section>
					</section>
						<section class="col-3">
							<section class="fs-90 tsr-p-10px">
								Menu kontekstowe
								<section class="fs-80 tsr-mt10">
									<section class="tsr-mt-10">
										<a href="<?php echo BM_SETTINGS["url_server"]?>Licencja.txt">Licencja</a>
									</section>
								</section>
							</section>
						</section>
						<section class="col-3">
							<section class="fs-90 tsr-p-10px">
								Informacje deweloperskie
								<section class="fs-80 tsr-mt-10">
									<section class="tsr fs-100">
										Wersja CMS: <?php echo BM_STATUS["bm_version"]; ?>
									</section>
									<section class="tsr fs-100">
										Wersja DB: <?php echo BM_STATUS["bm_version_db"]; ?>
									</section>
									<section class="tsr fs-100">
										Admin instalacji BM: <?php echo BM_STATUS["bm_installation_admin"]; ?>
									</section>
									<section class="tsr fs-100">
										Aktywny motyw: <?php echo BM_SETTINGS["bm_theme_active"]; ?>
									</section>
									<section class="tsr fs-100">
										Data instalacji BM: <?php echo BM_STATUS["bm_date_installation"]; ?>
									</section>
								</section>
							</section>
						</section>
				</section>
				</section>
				<section class="tsr-stopka ">
				<section class="tsr tsr-stopka-text2 tsr-mt-20">
					<section class="tsr col-2 fs-80">
						Wszelkie prawa zastrzeżone © 2020/2022 - Black min cms
					</section>
					<section class="tsr col-2 fs-80 tsr-algin-right">
						Projekt i wykonanie: <a href="#">zespół Black Min cms</a> |
						<a href="<?php echo BM_SETTINGS["url_server"];?>Licencja.txt">Licencja</a>
					</section>
				</section>
				</section>
			</footer>
		</footer>

	</body>
</html>