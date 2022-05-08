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

    declare(strict_types=1);

    namespace BlackMin\Message;

    use BlackMin\Message\MessageFilter;
    use MessageFormatter;

    class Message extends MessageFilter{

        public const STATUS_CODE = '(error|info|warning|war|normal|success|success_del|success_update|location)';

        /**
         * @var MessageFormatter
         */
        private $form;

        protected static $locale = "pl_PL";
        protected static $jsonStatus = true;

        public function __construct(){
            // try {
                // $this->form = new MessageFormatter("pl_PL", "<i>BlackMin:</i>. <b>Błąd Krytyczny</b>: <u>Pod czas</u> Formatowania odpowiedźi");
            // } catch (\Throwable $th) {
                // return "<i>BlackMin:</i>. <b>Błąd Krytyczny</b>: <u>Pod czas</u> - Opsługi Danych!";
            // } 
        }

        public function create(string $status, string $message, array $data) {
            if ($this->is_error()) {
                if ($out = $this->form::formatMessage(self::$locale, $message, $data)) {
                   if (self::$jsonStatus) {
                    return json_encode($this->formatter($status, $out));
                   }
    
                   return $out;
                }
            }
    
            return $this->form;
        }

        public function createView(string $status, string $message, array $data = []): void {
            echo $this->create($status, $message, $data);
        }
    
        public function parse(string $pattern, string $data, string $status, string $message) {
            $data = $this->form::parseMessage(self::$locale, $pattern, $data);
            return $this->create($status, $message, $data);
        }
    
        public function parseView(string $pattern, string $data, string $status, string $message): void {
            $data = $this->form::parseMessage(self::$locale, $pattern, $data);
            echo $this->create($status, $message, $data);
        }

        // this function is alt function messageformatter
        public function formatOnly(string $pattern, array $data) {
            return $this->form->formatMessage(self::$locale, $pattern, $data);
        }
        public function parseOnly(string $pattern, string $message) {
            return $this->form->parseMessage(self::$locale, $pattern, $message);
        }
    
        // this function is only format string to obiect array out structur
        public function format(string $status, string $message) {
            return $this->formatter($status, $message);
        }
    
        private function is_error(): bool {
            return intl_is_failure($this->form->getErrorCode());
        }
    
        public static function setLocale(string $locale): void {
            self::$locale = $locale;
        }
    
        public static function setJson(bool $isJson): void {
            self::$jsonStatus = $isJson;
        }
    
        public function formatter(string $status, string $message, string $data = null) {
            if (preg_match('/^'.self::STATUS_CODE.'$/', $status)) {
                ($status === "war" ? $status = "warning" : "");
                return [
                    "status" => $status,
                    "message" => $message,
                    "data" => $data
                ];
            }
    
            return $this->form;
        }

        public function __destruct() {
            unset($this->form);
        }
    }
    