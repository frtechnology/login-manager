<?php

    namespace RafaelRogerio\LoginManager; 

    use \PDO;
    use \PDOException;
    
    class Database{

        private static $host;
        private static $name;
        private static $user;
        private static $pass;
        private static $port;
        private $table;
        private $connection;

        public static function config($host, $name, $user, $pass, $port = 3306){
			self::$host = $host;
			self::$name = $name;
			self::$user = $user;
			self::$pass = $pass;
			self::$port = $port;
		}

        public function __construct($table){
            $this->table = $table;
            $this->setConnection();
        }

        private function setConnection(){
            try {
                $this->connection = new PDO('mysql:host='.self::$host.';dbname='.self::$name.';port='.self::$port,self::$user,self::$pass);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $th) {
                die('ERROR: '.$th->getMessage());
            }
        }
        private function execute($query, $params = []){
            try {
                $statment = $this->connection->prepare($query);
                $statment->execute($params);
                return $statment;
            } catch (PDOException $th) {
                die('ERROR: '.$th->getMessage());
            }
        }
        public function insert($value){
            $fields = array_keys($value);
            $binds = array_pad([],count($fields), '?');

            $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
            $this->execute($query, array_values($value));

            return lastInsertId();
        }
        public function select($where = null, $order = null, $limit = null, $fields = '*'){
            $where = strlen($where) ? 'WHERE '.$where : '';
            $order = strlen($order) ? 'ORDER BY '.$order : '';
            $limit = strlen($limit) ? 'LIMIT '.$limit : '';

            $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;
            return $this->execute($query);
        }
        public function update($value, $where){
            $fields = array_keys($value);
            $where = strlen($where) ? 'WHERE '.$where : '';

            $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? '.$where;
            $this->execute($query,array_values($value));
            return true;
        }
        public function delete($where){
            $where = strlen($where) ? 'WHERE '.$where : '';

            $query = 'DELETE FROM '.$this->table.' '.$where;
            $this->execute($query);
            return true;
        }
    }