<?php 


class Sql extends PDO {

	private $conn;
	private $stmt;

	public function __construct(){

		$this->conn = new PDO("mysql:dbname=coparticipantesdb;host=localhost","root","");


	}

	public function query($rawQuery, $params = array()){

		$this->stmt = $this->conn->prepare($rawQuery);

		//$this->setParams($stmt, $params);

		foreach ($params as $key => &$value) {
			
			$this->stmt->bindParam($key, $value);

		}		


		$this->stmt->execute();

		return $this->stmt;

	}

	private function setParam($stament, $key, $value){

		$stament->bindParam($key, $value);

	}

	private function setParams($stament, $parameters=array()){

		foreach ($parameters as $key => $value) {
			
			$stament->bindParam($key, $value);

		}


	}

	public function select($rawQuery, $params=array()):array{
		
		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

	public function insert($rawQuery, $params = array()):int{

		$this->stmt = $this->conn->prepare($rawQuery);

		//$this->setParams($stmt, $params);

		foreach ($params as $key => &$value) {
			
			$this->stmt->bindParam($key, $value);

		}		


		$this->stmt->execute();

		return $this->conn->lastInsertId();

	}



}

 ?>