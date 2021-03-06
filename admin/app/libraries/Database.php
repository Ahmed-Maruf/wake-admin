<?php
	/**
	 * Created by PhpStorm.
	 * User: SKYLINK COMPUTERS
	 * Date: 10/23/2018
	 * Time: 6:47 PM
	 */
	
	class Database
	{
		private $host = DB_HOST;
		private $user = DB_USER;
		private $pass = DB_PASS;
		private $dbName = DB_NAME;
		private $db_handler;
		private $statement;
		private $error;
		public function __construct()
		{
			//@ - set DSN
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
			$options = array(
				PDO::ATTR_PERSISTENT =>true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);
			//@- Create PDO instance
			try{
				$this->db_handler = new PDO($dsn,$this->user,$this->pass,$options);
			}catch (PDOException $e){
				$this->error = $e->getMessage();
				echo $this->error;
			}
		}
		//@ - Prepare statement with query
		public function query($sql){
			$this->statement = $this->db_handler->prepare($sql);
		}
		//@- Bind Values
		public function bind($param, $value, $type = null){
			if(is_null($type)){
				switch (true){
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
				}
			}
			$this->statement->bindValue($param,$value,$type);
		}
		//@ - Execute the prepare statement
		public function execute(){
			return $this->statement->execute();
		}
		//@ - Get result set as array of objects
		public function resultSet(){
			$this->execute();
			return $this->statement->fetchAll(PDO::FETCH_OBJ);
		}
		//@ - Get result as single row
		public function single(){
			$this->execute();
			return $this->statement->fetch(PDO::FETCH_OBJ);
		}
		//@ - Get row count
		public function rowCount(){
			return $this->statement->rowCount();
		}
	}