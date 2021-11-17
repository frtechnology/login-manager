<?php

    namespace RafaelRogerio\LoginManager;

    class Login{

        private $email;
        private $password;
        private $typeSession = [];
        private $message;
        private $table;
        private $location;

         /**
         * Método responsável por configurar o banco de dados
         * @param  string  $host
         * @param  string  $name
         * @param  string  $table
         * @param  string  $user
         * @param  string  $pass
         * @param  integer $port
         */
        public static function databaseConfig($host, $name, $user, $pass, $port = 3306){
           //CONFIGURA A CLASSE DE BANCO DE DADOS
            Database::config(
                $host,
                $name,
                $user,
                $pass,
                $port
            );
        }
         /**
         * construtor da classe
         * @param  string  $email
         * @param  string  $password
         * @param  string  $location
         */
        public function __construct($email, $password, $table, $camp, $location){
            $this->email = $email;
            $this->password = $password;
            $this->location = $location;
            $this->table = $table;
            $this->camp = $camp;
            $this->setLogin();
        }
        /**
         * Metodo responsavel por iniciar uma sessao
         */
        private static function init(){
			if (session_status() != PHP_SESSION_ACTIVE) {
				session_start();
			}
		}
        /**
         * Metodo responsavel por setar um tipo de sessao a ser iniciada
         * @param array $value
         */
		public function setTypeSession($value){
			$this->typeSession = $value;
		}
        /**
         * Metodo responsavel por criar sessao com dados do banco
         * @param object $obUser
         */
		public function session($obUser){
			self::init();

			if(!empty($this->typeSession)){
				foreach ($this->typeSession as $key => $value) {
					$_SESSION[$value] = $obUser->$value;
				}
			}else{
				$_SESSION['status'] = 'active';
			}
            return true;
		}
        public function getMessage(){
            return strlen($this->message) ? $this->message : '';
        }
		
        /**
         * Metodo responsavel por verificar os dados do usuario
         */
        public function setLogin(){
            
			$obUser = Model::getUserByEmail($this->table, $this->camp,$this->email);
			if (!$obUser instanceof Model) {
				$this->message = 'Usuario ou Senha incorretos';
                return false;
			}
			if (!password_verify($this->password, $obUser->senha)) {
				$this->message = 'Usuario ou Senha incorretos';
                return false;
			}
			
			$this->session($obUser);

			header('location: '.$this->location);
			exit;

		}	
    }