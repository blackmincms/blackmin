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
*	This file has auto load class of directory
*/

	spl_autoload_register(function ($class_name) {
        if (defined('BLACKMIN_ADMIN') === true) {
            $t = realpath(str_replace("BlackMin", "core", (BMPATH . "../" . $class_name . '.php')));
            if (file_exists( $t )) {
                require_once ( $t );
            }
        }else {
            
        }    
	});