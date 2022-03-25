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
*	This file has black min settings (db)
*/

	declare(strict_types=1);

	namespace BlackMin\Settings;

	final class Settings {

		private $database;

		protected $save = null;		

		public function __construct($database){
			$this->database = $database;
		}

		public function load():array {		
			$t = $this->database->query("SELECT `bm_name`, `bm_value` FROM `|prefix|bm_settings` WHERE `bm_loader` LIKE 'yes'", false);

			$this->save = $t["num_rows"];

			// buffor
			$c = [];

			for ($i=0; $i < $t["num_rows"]; $i++) { 
				$c[$t[$i]["bm_name"]] = $t[$i]["bm_value"];
			}

			return $c;
		}

		public function count() {
			return $this->save;
		}		

	}

?>