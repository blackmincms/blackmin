<?php	
/**
*	"Black Min" 
*	
*	For the full copyright and license information, please view the LICENSE
*	file that was distributed with this source code.
*
*	@package BlackMin
*	
*	#plik: 2.0
*
*	This file is a widget content bulid in blackmin
*/

	namespace BlackMin\Plugin;

	class bmWidgetContent {
		/**
         * @var array
        */
		static protected array $widgetContent = [] ;

		public function __construct() {
			// widget blackmin (login)
			self::$widgetContent["Logowanie"] = '
				<section class="tsr fs-100 tsr-p-10px bm-logowanie"><a href="bm/logowanie.php">Logowanie</a></section>
			';
			/* self::$widgetContent["login"] = '
				<section class="tsr fs-100 tsr-p-10px bm-logowanie"><a href="'.BM_SETTINGS["url_server"].'bm/logowanie.php">Logowanie</a></section>
			'; */
			// widget blackmin (search)
			self::$widgetContent["Wyszukiwarka"] = '
				<form accept-charset="UTF-8" action="" method="get" autocomplete="off" class="tsr-p-10px search-form-bm">	
					<section class="tsr tsr-position-relative">
						<input type="search" name="search" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj" value="">
						<input type="image" name="search" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10" src="pliki/ikony/szukaj.png" >
					</section>
				</form>		
			';
			/* self::$widgetContent["search"] = '
				<form accept-charset="UTF-8" action="" method="get" autocomplete="off" class="tsr-p-10px search-form-bm">	
					<section class="tsr tsr-position-relative">
						<input type="search" name="search" class="input tsr-icons-left col-ms90 tsr-width-webkit-fill-available col-ms90" placeholder="Szukaj" value="">
						<input type="image" name="search" class="tsr-width-50px input tsr-icons-right tsr-icons-box-right col-st10" src="'.BM_SETTINGS["url_server"].'pliki/ikony/szukaj.png" >
					</section>
				</form>		
			'; */
			
			return self::$widgetContent;
		}
	}
