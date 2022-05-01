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
*	This file is rendering site
*/

    declare(strict_types=1);

    namespace BlackMin\View;

    use Exception;

    class View {
        
        /**
         * @var string
        */
        private $view;

        public function __construct (string $set = "") {
            $this->set($set);
        }

        public function set(string $set){
            $this->view = $set;
        }

        public function render(bool $isOnce = false): string {
            $out = '';
            
            try {
                if ($this->view !== null && file_exists($this->view)) {
                    // rozpoczynanie kopilowanie html w php
                    ob_start();
                    // inkludowanie pliku
                    if ($isOnce) {
                        require_once ($this->view);
                    } else {
                        require ($this->view);
                    }
                    // kompilowanie pliku
                    $out = ob_get_contents();
                    // zaczywywanie kompilowania pliku
                    ob_end_clean();
                    // zwalnianie danych z pamięci ram
                    ob_clean();
                }
            } catch (\Throwable $th) {
                //throw $th;
                $out = false;
            }
    
            return $out;
        }
    
        public function renderViewOnly(bool $isOnce = false): void {
            try {
                if ($this->view !== null && file_exists($this->view)) {
                    if ($isOnce) {
                        require ($this->view);
                    } else {
                        require_once ($this->view);
                    }
                }
            } catch (\Throwable $th) {
                //throw $th;
                // return false;
            }
        }

    }
    