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

    namespace BlackMin\View;

    class View {
        
        /**
         * @var String|Null; 
        */
        private $view = null;

        public function __construct ($t = null) {
            $this->view = $t;
        }

        public function instance($t){
            $this->view = $t;
        }

        public function render(bool $t = false):string|false {
            if (!is_null($this->view)) {
                $out = null;
                if ($t) {
                    if (file_exists($this->view)) {
                    // rozpoczynanie kopilowanie html w php
                        ob_start();
                        // inkludowanie pliku
                        require_once ($this->view);		
                        // kompilowanie pliku
                        $out = ob_get_contents();
                        // zaczywywanie kompilowania pliku
                        ob_end_clean();
                        // zwalnianie danych z pamięci ram
                        ob_clean();
                    } else {
                        return false;
                    }
                    
                } else {
                    if (file_exists($this->view)) {
                        // rozpoczynanie kopilowanie html w php
                        ob_start();
                        // inkludowanie pliku
                        require ($this->view);		
                        // kompilowanie pliku
                        $out = ob_get_contents();
                        // zaczywywanie kompilowania pliku
                        ob_end_clean();
                        // zwalnianie danych z pamięci ram
                        ob_clean();
                    } else {
                        return false;
                    }
                }
                return $out;
            } else {
                return false;
            }
            
        }

        public function renderViewOnly(bool $t = false):void {
            if (!is_null($this->view)) {
                if ($t) {
                    if (file_exists($this->view)) {
                        require ($this->view);
                    }
                } else {
                    if (file_exists($this->view)) {
                        require_once ($this->view);
                    }
                }
            }                        
        }

    }
    