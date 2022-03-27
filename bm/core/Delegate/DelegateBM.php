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
*	This file is delegate all data in Black Min
*/

    use BlackMin\Message\Message;

    if (isset($_POST["bm_content"])) {
        // json decode
        (json_decode($_POST["bm_content"], true) != false ? $t = json_decode($_POST["bm_content"], true) : $t = null);
        if (!is_null($t) && is_array($t)) {
            
            
            
        } else {
            Message::createView("error", "BMMessage: Błędny format danych!");
            exit();
        }
        
    }else{
        Message::createView("error", "BMMessage: Wystąpił błąd pod czas pobierania danych!");
        exit();
    }