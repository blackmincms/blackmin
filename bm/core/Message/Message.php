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
*	This file is rendering message outputs
*/

    namespace BlackMin\Message;

    use MessageFormatter;
    use BlackMin\Message\MessageFilter;

    class Message extends MessageFilter{

        /* Message Formater */
        private $form;
        static protected $Locale = "pl_PL";
        static protected $jsonStatus = true;

        public function __construct(){
            try {
                $this->form = new MessageFormatter("pl_PL", "<i>BlackMin:</i>. <b>Błąd Krytyczny</b>: <u>Pod czas</u> Formatowania odpowiedźi");
            } catch (\Throwable $th) {
                return "<i>BlackMin:</i>. <b>Błąd Krytyczny</b>: <u>Pod czas</u> - Opsługi Danych!";
            }
        }

        public function create(String $c, String $m, Array $t):String {
            if (Message::is_error()) {
                if ($out = $this->form->formatMessage($this->Locale, $m, $t)) {
                   if ($this->jsonStatus) {
                    $t = Message::__formater ($c, $out);   
                    return json_encode($t);
                   } else {
                       return $out;
                   }
                   
                } else {
                    return $this->form;
                }
                
            } else {
                return $this->form;
            }
            
        }

        public function createView(String $c, String $m, Array $t = []):void {
            echo Message::create($c, $m, $t);
        }

        public function parse(String $a, String $b, String $c, string $m):String|MessageFormatter {
            $t = $this->form->parseMessage($this->Locale, $a, $b);
            return Message::create($c, $m, $t);
        }
        
        public function parseView(String $a, String $b, String $c, string $m):void {
            $t = $this->form->parseMessage($this->Locale, $a, $b);
            echo Message::create($c, $m, $t);
        }

        // this function is only format string to obiect array out structur
        public function format(String $s, String $m) {
            $t = Message::__formater($s, $m);
            return $t;
        }

        private function is_error ():bool {
            if (intl_is_failure($this->form->getErrorCode())) {
               return true;
            } else {
                return false;
            }
            
        }

        public function setLocale(String $t) {
            $this->Locale = $t;
        }

        public function setJson(bool $t){
            $this->jsonStatus = $t;
        }

        public function __formater (String $c, string $m):array|string|MessageFilter {
            if (preg_match("/^(error|info|warning|war|normal|success|success_del)$/", $c)) {
                ($c === "war" ? $c = "warning" : "");
                return [
                    "status" => $c,
                    "message" => $m
                ];
            } else {
                return $this->form;
            }
            
        }

        public function __destruct() {
            unset($this->form);
        }
    }
    