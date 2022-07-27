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

    use BlackMin\Database\Database;
    use BlackMin\Exception\RouterException;
    use BlackMin\View\View;

    final class Router {

        public const ACTION_METHOD = '(load|get|add|del|update|rename|upload|login|activation|deactivation)';

        /**
         * @var Database
         */
        private $database;

        /**
         * @var string
         */
        private $action;

        /**
         * @var string
         */
        private $url = '';

        /**
         * @var string|array
         */
        private $param;

        /**
         * @var string
         */
        private $pathDirectory;


        public function __construct(Database $database) {
            $this->database = $database;
            $this->pathDirectory = realpath(__DIR__ . "/..");
        }

        /**
         * @throws RouterException
         */
        public function createInstanceWith(string $action, string $url, $params): self {
            return $this->routerFactory($action, $url, $params);
        }

        /**
         * @throws RouterException
         */
        public function createInstanceFrom(array $payload): self {
            $action = $this->actionOrUrlExist('action', $payload);
            $url = $this->actionOrUrlExist('url', $payload);

            if ($action && $url) {
                return $this->routerFactory($payload["action"], $payload["url"], $payload["param"] ?? []);
            }

            throw RouterException::invalidDelegatedData();
        }

        /**
         * @throws RouterException
         */
        public function delegate() {
            $result = null;
            $url = $this->normalizeUrl($this->url);
            if ($this->action === "load") {
                if (is_string($this->param) && $this->param !== '') {
                    $path = $this->pathDirectory . "/" . $url . "/" . $this->param;
                    $ext = '.php';
                    if (($this->param === "filter") || ($this->param === "add")) {
                        $ext = '.html';
                    }

                    $out = new View($path . $ext);
                    $out->renderViewOnly();
                }

                return $result;
            }

            $class = $this->delegatedClassFactory($url, [$this->database, $this->action, $this->param]);
            $result = $class->parse();

            if ($result === null) {
                throw RouterException::invalidDelegatedData();
            }

            if ($result === false) {
                throw RouterException::unknownError();
            }

            return $result;
        }

        /**
         * @throws RouterException
         */
        private function routerFactory(string $action, string $url, $params): self {
            if (preg_match('/^'.self::ACTION_METHOD.'$/', $action)) {
                $self = clone $this;
                $self->action = $action;
                $self->url = $url;
                $self->param = $params;

                return $self;
            }

            throw RouterException::invalidDelegatedData();
        }

        private function actionOrUrlExist(string $actionOrUrlOrParam, array $payload): bool {
            return array_key_exists($actionOrUrlOrParam, $payload) === true;
        }

        private function delegatedClassFactory($className, array $params) {
            $classWithNamespace = '\\BlackMin\\'.$className.'\\'.$className;
            return new $classWithNamespace($params[0], $params[1], $params[2]);
        }

        private function normalizeUrl(string $url): string {
            if ($url === '') {
                return $url;
            }

            $url = strtolower($url);
            if ($url === 'categorytag') {
                $url = 'CategoryTag';
            }

            return ucfirst($url);
        }
    }