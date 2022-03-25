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
*	This file is config dev tools
*/

    declare(strict_types=1);

	namespace BlackMin\Config;

    final class Dev {
        private static function get():array {
            return [
                "stable" => "dev",
                "dev" => false,
                "dev_log" => false,
                "dev_ui" => false
            ];
        }
    }