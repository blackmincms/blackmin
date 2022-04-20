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
     * @var string|null;
    */
    private $view;

    public function __construct ($view = null) {
        $this->view = $view;
    }

    public function render(bool $isOnce = false): string {
        $out = '';
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

        return $out;
    }

    public function renderViewOnly(bool $isOnce = false): void {
        if ($this->view !== null && file_exists($this->view)) {
            if ($isOnce) {
                require ($this->view);
            } else {
                require_once ($this->view);
            }
        }
    }
}
