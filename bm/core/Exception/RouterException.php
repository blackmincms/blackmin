<?php

    declare(strict_types=1);

    namespace BlackMin\Exception;

    final class RouterException extends \Exception {

        public static function invalidDelegatedData(): self
        {
            return new self('<b>DelegateBM</b>: Wystąpił <b>błąd</b> w <i>Delegowaniu</i> przekazanych danych');
        }

        public static function unknownError(): self
        {
            return new self('<b>DelegateBM</b>: Wystąpił <i>Nie Znany</i> <b>Błąd</b>');
        }
        
    }