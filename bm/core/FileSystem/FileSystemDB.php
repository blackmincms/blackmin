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
*	This file is (FileSystemDB) for BlackMin [only bm]
*/

    namespace BlackMin\FileSystem;

    use BlackMin\Database\Database;

    final class FileSystemDB {

        /**
         * @var string
         */
        public const ACTION_METHOD = '(bm_theme_active|bm_menu_structur|bm_top_widget|bm_left_widget|bm_right_widget|bm_bottom_widget|bm_footer_widget|bm_plugin)';

        /** 
         * @var Database
         */
        private $database;

        /** 
         * @var array
         */
        public $error = [];

        public function __construct(Database $database) {
            $this->database = $database;
        }

        public function get($name) {
            if (strlen($name) !== 0) {
                if ($this->checkMethod($name)) {
                    try {
                        $out = $this->database->query2("SELECT * FROM `bm_settings` WHERE `bm_name` LIKE '$name'");
                        if ($out["num_rows"] === 0) {
                            throw array_push($this->error, "FSDB: Brak danych w DataBase!");
                        }
                        // return data
                        return $out[0]["bm_value"];
                    } catch (\Throwable $th) {
                        throw array_push($this->error, $th);
                    }
                } else {
                    return false;
                }
            } else {
                throw array_push($this->error, "FSDB: Brak danych wejśćiowych!");
                return false;
            }
        }

        public function set () {
            # code...
        }

        public function encode ($data) {
            # code...
        }

        public function decode ($data) {
            # code...
        }

        // function check action method
        public function checkMethod (string $name):bool {
            if (preg_match('/^'.self::ACTION_METHOD.'$/', $name)) {
                return true;
            }else{
                // add error
                array_push($this->error, "FSDB: Błędna nazwa metody!");
                return false;
            }
        }

        // function return error
        public function getError() {
            return $this->error;
        }

        // function return int type error
        public function intErrorCode():int {
            return count($this->error);
        }

    }