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
*	This file load core Blac Min | Production
*/

	if(!defined('BMPATH')) {
		define('BMPATH', dirname( __FILE__ ).'/' );
	};
	
	if(!defined('BM')) {
		define('BM','bm/' );
	};
	
	if(!defined('LADUJ')) {
		define('LADUJ','laduj/' );
	};
	
	if(!defined('BM')) {
		define('BM','bm/' );
	};

	// load db settings
	require_once (BMPATH . "connect.php");
	// autoloader
	require_once (BMPATH . BM . "/core/Load/autoloader.php");
	// autoloader
	require_once (BMPATH . BM . "/core/Path/define-path.php");

	use BlackMin\Database\Database;
	use BlackMin\Settings\Settings;
	use BlackMin\Settings\Status;
	use BlackMin\Router\Url;
	use BlackMin\Router\Router;
	use BlackMin\Session\SM;
	use BlackMin\View\View;
	use BlackMin\Load\SFL;
	use BlackMin\Message\Message;
	use BlackMin\Theme\Theme;

	// db connect
	$bm_db = new Database();
	$bm_db->db_error_developers(false);
	$bm_db->db_error(false);
	// settings bm
	$bm_settings = new Settings($bm_db);
	$bm_settings_load = $bm_settings->load();
	if (!defined("BM_SETTINGS")) {
		define('BM_SETTINGS', $bm_settings_load);
	}
	// status bm
	$bm_status = new Status($bm_db);
	$bm_status_load = $bm_status->load();
	if (!defined("BM_STATUS")) {
		define('BM_STATUS', $bm_status_load);		
	}
	// pobieranie wartośći z paska url i udostępnianie jej innym algorytmom 
	$BMURL = new URL();
	// sprawdzanie protokołu ssl_bm
	$BMURL->check_ssl(true); 	
	$BMURL->bm_url();
	
	// created user session
	$SM = new SM ();
	$SM->start();

	// the sort file loader
	$SFL = new SFL();

	// the viver obiect
	$BMVIEW = new View();
	// the router obiect
	$BMROUTER = new Router($bm_db);

	// the message obiect
	$BMMESSAGE = new Message();

	// load active theme
	try {		
		$BMROUTER = $BMROUTER->createInstanceWith("start", "Theme", [BMPATH]);
		$ACTheme = $BMROUTER->delegate();
		if ($ACTheme === false) {
			echo "<h1><b>BlackMin</b>: Wystąpił <b><u>Błąd</u></b> Z Ładowaniem Strony!</h1>";
			echo "<h4>Jeżeli ten błąd pojawia się dalej <b>skontaktuj</b> się z administratorem witryny!</h4>";
			exit();
		}
	} catch (\Throwable $th) {
		echo "<h1><b>BlackMin</b>: Wystąpił <b><u>Błąd</u></b> Serwera!</h1>";
		echo "<h4>Jeżeli ten błąd pojawia się dalej <b>skontaktuj</b> się z administratorem witryny!</h4>";
		exit();
	}
