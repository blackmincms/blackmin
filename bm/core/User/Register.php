<?php


    declare(strict_types=1);

    namespace BlackMin\User;

    use BlackMin\User\User;

    class Register extends User {
        
        private $database;
        private $arg;

        public function __construct(object $t, array $arg) {
            $this->database = $t;
            $this->arg = $arg;
        }

         

    }
    