<?php

    namespace RafaelRogerio\LoginManager;

    class Model{

        public $email;
        public $senha;

        public static function getUserByEmail($table,$camp,$email){
			    return (new Database($table))->select($camp.' = "'.$email.'"')->fetchObject(self::class);
		    }
       
    }