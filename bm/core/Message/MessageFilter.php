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
*	This file is formating message outputs | constructor parser
*/

    declare(strict_types=1);

    namespace BlackMin\Message;

    abstract class MessageFilter {
        
        abstract protected function create(string $status, string $message, array $data);
        abstract protected function formatter(string $status, string $message, string $data = null);
        abstract protected static function setJson(bool $isJson): void;

    }
    