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
                return true;
            }
        }else {
            try {
                $t = realpath(str_replace("BlackMin", "core", (dirname( __FILE__ ).'/' . "../../" . $class_name . '.php')));
                if (file_exists( $t )) {
                    require_once ( $t );
                    return true;
                }
            } catch (\Throwable $th) {
                // throw $th;
                if (!defined("BM_AUTOLOAD_ERROR")) {
                    define('BM_AUTOLOAD_ERROR', 'true');
                    
                }
            }
        }    
	});