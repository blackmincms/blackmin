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
*	This file is routing all Black Min core | admin panel
*/

    declare(strict_types=1);

    namespace BlackMin\Router; 

    use BlackMin\View\View;
    use BlackMin\Message\Message;
    use BlackMin\Media\Media;
    use BlackMin\Media\MediaAdmin;
    use BlackMin\User\User;
    use BlackMin\Post\Post;
    use BlackMin\CategoryTag\CategoryTag;

    class Router{

        static private $path = [
            "post" => "Post/post.php",
            "media" => "Media/Media.php",
            "plugin" => "Plugin/plugin.php"
        ];

        private $database;

        /**
         * @var string|null
         */
        private $action;
        /**
         * @var string|null|mixed
         */
        private $url;
        /**
         * @var string|array|null
         */
        private $parm;
        /**
         * @var string
         */
        private $pathDirectory;
        /**
         * @var mixed
         */
        private $Message;
        /**
         * @var string;
         */
        private $err;
        /**
         * @var string;
         */
        private $errno;

        public function __construct($d) {
            $this->Message = new Message();
            $this->err = $this->Message->format("error", "<b>DelegateBM</b>: Wystąpił <b>błąd</b> w <i>Delegowaniu</i> przekazanych danych");
            $this->errno = $this->Message->format("error", "<b>DelegateBM</b>: Wystąpił <b>Nie Znany Błąd</b>");
            $this->database = $d;
            $this->pathDirectory = realpath(__DIR__ . "/..");
        }
        
        public function createInstance(String $a, String $u, String|array $t) {
            if (preg_match("/^(load|get|set|del|update|rename|upload)$/", $a)) {
                $this->action = $a;
                $this->url = $u;
                $this->parm = $t;
                return true;
            }else{
                return $this->err;
            }
        }

        public function instance(array $t){
            (array_key_exists("action", $t) === true ? $action = true : $action = false);
            (array_key_exists("url", $t) === true ? $url = true : $url = false);
            if (($action === true) && ($url === true)) {
                if (preg_match("/^(load|get|set|del|update|rename|upload|login)$/", $t["action"])) {
                    (array_key_exists("action", $t) === true ? ($this->action = $t["action"]) : ($this->parm = null));
                    (array_key_exists("url", $t) === true ? ($this->url = $t["url"]) : ($this->parm = null));
                    (array_key_exists("parm", $t) === true ? ($this->parm = $t["parm"]) : ($this->parm = null));
                    return true;
                }else{
                    return $this->err;
                }
            } else {
                return false;
            }
            
        }

        public function delegate(){
            $t = null;
            $url = strtolower($this->url);
            $url = ucfirst($this->url);
            if ($this->action === "load") {
                if (!is_null($this->parm) && is_string($this->parm)) {
                    if($this->parm == "filter"){
                        $out = new View( realpath(__DIR__ . "/..") . "/" . $url . "/" . $this->parm . ".html");
                        $out->renderViewOnly();
                        $t = 1;
                    }else{
                        $out = new View(realpath(__DIR__ . "/..") . "/" . $url . "/" . $this->parm . ".php");
                        $out->renderViewOnly();
                        $t = 1;
                    }
                }else{
                    $t = false;
                }        
            }else{
                if ($url === "Media") {               
                    $x = new Media($this->database ,$this->action, $this->parm);
                    $x = $x->parse();
                    if (is_null($x)) {
                        $t = false;
                    } else {
                        $t = $x;
                    }
                }elseif ($url === "User") {               
                    $x = new User($this->database ,$this->action, $this->parm);
                    $x = $x->login();
                    if (is_null($x)) {
                        $t = false;
                    } else {
                        $t = $x;
                    }
                }elseif ($url === "Post") {               
                    $x = new Post($this->database ,$this->action, $this->parm);
                    $t = $x->parse();
                }elseif ($url === "Categorytag") {               
                    $x = new CategoryTag($this->database ,$this->action, $this->parm);
                    $t = $x->parse();
                }
            }
            if (is_int($t)){
                return true;
            }else if (is_null($t)) {
                return $this->err;
            }else if ($t == false) {
                return $this->errno;
            }else{
                return $t;
            }
        }

        
        public function autoDelegate() {
            $url = ucfirst($this->url);
            //instantiate the controller object
           $class = 'Controller\\' . $url;
           $object = new $class($this->database ,$this->action, $this->parm);

           // rex commponents
           $ur = $this?->url;
           $obj = new $ur ($this->database ,$this->action, $this->parm);

           return $object;
       }
    }
    