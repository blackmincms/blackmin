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
        try {
            $autoloads = str_replace("BlackMin", "core", $class_name . '.php');
            $autoloads = __DIR__ . '/../../' . str_replace("\\", DIRECTORY_SEPARATOR, $autoloads);
            if (file_exists( $autoloads )) {
                require_once ( $autoloads );
                return true;
            }

            throw new Exception("AUTOLOAD: this class not exist: " . $class_name, 1);
            
        } catch (\Throwable $th) {
            throw new Exception("AUTOLOAD: this class not exist: " . $class_name, 1);
        }
	});