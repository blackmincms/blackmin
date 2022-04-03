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

    namespace BlackMin\Message;

    abstract class MessageFilter {
        
        abstract protected function create(String $c, String $m, Array $t):string;
        abstract protected function __formater (String $c, string $m):array|string|MessageFilter;
        abstract protected function setJson(bool $t);

    }
    