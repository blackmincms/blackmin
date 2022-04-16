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

	// ładowanie jądra black mina
	require_once "../../admin/black-min.php";

    use BlackMin\Message\Message;
    use BlackMin\Router\Router;

    $Message = new Message();

    if (isset($_POST["bm_content"])) {
        // json decode
        (json_decode($_POST["bm_content"], true) != false ? $t = json_decode($_POST["bm_content"], true) : $t = null);
        if (!is_null($t) && is_array($t)) {
            ini_set('display_errors', 1);
	        error_reporting (E_ALL | E_STRICT);
            $router = new Router($bm_db);
            $router->instance($t);
            echo json_encode($router->delegate());

           /*  $as = [
                "action" => "",
                "url" => ""
            ]; */
            
        } else {
            $Message->createView("error", "BMMessage: Błędny format danych!");
            exit();
        }
        
    }else if (isset($_FILES["file"])) {
        $router = new Router($bm_db);
        $router->instance([
            "action" => "upload",
            "url" => "media",
            "parm" => [$_FILES["file"]]
        ]);
        echo json_encode($router->delegate());
    }else{
        $Message->createView("error", "BMMessage: Wystąpił błąd pod czas pobierania danych!");
        exit();
    }