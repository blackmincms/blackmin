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

    use BlackMin\Base\BaseInterface;
    use BlackMin\Database\Database;
    use BlackMin\Message\Message;

	final class Settings {

		private $database;
        private $action;
        private $parm;
    
        protected $message;		

		// cache sql data to send to server
		protected $cache;

        public function __construct (Database $database ,string $action = "", array $params = []) {
            $this->database = $database;
            $this->action = $action;
            $this->parm = $params;
    
            $this->message = new Message();
        }

        public function parse() {
            switch ($this->action) {
                case 'get':
                    return $this->get();
                case 'update':
                    return $this->edit();
                default:
                    return false;
            }
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

		public function count():array {
			return $this->save;
		}	
		
		public function get() {

			if (isset($this->parm['id'])) {          
                // filtrowanie danych
                $id = $this->database->valid($this->parm['id']);

				if (strlen($id) === 0) {
					return $this->message->format("war", "Brak danych wejśćiowych.");	
				}

				$exp = explode(",", $id);

				$id = "";

				for ($i=0; $i < count($exp); $i++) { 
					if ($i === 0) {
						$id .= "'" . $exp[$i] . "'";
					} else {
						$id .= ",'" . $exp[$i] . "'";
					}
					
				}

                // check param is string

                if (is_string($id)) {
                    // zapytanie do db
                    $zap = $this->database->query("SELECT `bm_name`, `bm_value`  FROM `|prefix|bm_settings` WHERE `bm_name` in ($id)");
                } else {
                    $zap = $this->message->format("war", "Wprowadzone dane nie są ciągiem");
                }
				return $zap;
            } else {
				return $this->message->format("error", "Brak danych wejśćiowych.");	
			}

		}

        public function edit (){
            if (isset($this->parm)) {
                if (!isset ($this->parm['id'])){
					return $this->message->format("info", "Brak danych id objektu do edycji.");
                }

				if ($dataParse = $this->dataParser($this->parm)) {
					$expDataParse = explode(";", $dataParse);
					$countEdit = 0;
					// update data 
					for ($i=0; $i < count($expDataParse); $i++) { 
						if ($this->database->update($expDataParse[$i])) {
							$countEdit++;
						}
					}
					// edytowanie danych
					if ($countEdit === count($expDataParse)) {
						return $this->message->format("success_update", "Dane zostały edytowane!");
					}else {
						return $this->message->format("error", "Wystąpił błąd pod czas edytowania danych.");
					}
				} else {
					return $this->message->format("error", "Wystąpił błąd pod czas formatowania dancyh do edycji.");
				}		
            } else {
                return $this->message->format("error", "Brak danych wejśćiowych.");
            }
        }

		private function dataParser (array $data):string|bool {
			$cache = "";
			$keys = array_keys($data);
			$id = [];

			if (isset($data["id"])) {
				$id = explode(",", $data["id"]);
			} else {
				return false;
			}
			
			if ($keys !== 0) {
				for ($i = 0; $i < count($keys); $i++) {
					if (isset($id[$i])) {
						if ((array_key_exists("admin_witryny", $data)) || (array_key_exists("email_admin_witryny", $data))) {
						// if (($data[$keys[$i]] == ($data["admin_witryny"])) || ($data[$keys[$i]] == ($data["email_admin_witryny"]))) {
							if ($i === 0) {
								$cache .= "UPDATE `|prefix|bm_status` SET `bm_value` = '". $data[$keys[$i]] ."' WHERE `|prefix|bm_status`.`bm_name` LIKE '". $id[$i] ."'";
							}else{
								$cache .= ";UPDATE `|prefix|bm_status` SET `bm_value` = '". $data[$keys[$i]] ."' WHERE `|prefix|bm_status`.`bm_name` LIKE '". $id[$i] ."'";
							}
						} else {
							if ($i === 0) {
								$cache .= "UPDATE `|prefix|bm_settings` SET `bm_value` = '". $data[$keys[$i]] ."' WHERE `|prefix|bm_settings`.`bm_name` LIKE '". $id[$i] ."'";
							}else{
								$cache .= ";UPDATE `|prefix|bm_settings` SET `bm_value` = '". $data[$keys[$i]] ."' WHERE `|prefix|bm_settings`.`bm_name` LIKE '". $id[$i] ."'";
							}
						}
					}
				}
			} else {
				return false;
			}

			return $cache;
		}

	}

?>