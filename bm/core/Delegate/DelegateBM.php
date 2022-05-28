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

    use BlackMin\Exception\RouterException;
    use BlackMin\Message\Message;
    use BlackMin\Router\Router;
    
    $message = new Message();
    
    if (isset($_POST["bm_content"])) {
        // json decode
        $content = (json_decode($_POST["bm_content"], true) != false ? json_decode($_POST["bm_content"], true) : null);
        if (!is_null($content) && is_array($content)) {
            ini_set('display_errors', 1);
            error_reporting (E_ALL | E_STRICT);
            try {
                $router = new Router($bm_db);
                $router = $router->createInstanceFrom($content);
                echo json_encode($router->delegate(), JSON_THROW_ON_ERROR);
            } catch (RouterException $e) {
                $message->formatPrint("error", $e->getMessage(), true);
            }
    
        } else {
            $message->formatPrint("error", "BMMessage: Błędny format danych!", true);
            exit();
        }
    
    }else if (isset($_FILES["file"])) {
        try {
            $router = new Router($bm_db);
            $router = $router->createInstanceFrom([
                "action" => "upload",
                "url" => "media",
                "parm" => [$_FILES["file"]]
            ]);
            echo json_encode($router->delegate(), JSON_THROW_ON_ERROR);
        } catch (RouterException $e) {
            $message->formatPrint("error", $e->getMessage(), true);
        }
    }else{
        $message->formatPrint("error", "BMMessage: Wystąpił błąd pod czas pobierania danych!", true);
        exit();
    } 
    