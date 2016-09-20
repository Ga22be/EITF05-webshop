<?php

class Database {
	private $_host;
	private $_username;
	private $_password;
	private $_database;
	private $conn;

	public function __construct() {
		require('connect_data.php');
		$this->_host = $_host;
		$this->_username = $_username;
		$this->_password = $_password;
		$this->_database = $_database;
	}

	private function getConnection() {
		if (!isset($this->conn)) {
			try {
				$this->conn = new PDO("mysql:host=$this->_host;dbname=$this->_database",
					$this->_username, $this->_password);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				die($e);
				header('location: ../pages/noDatabase.html');
			}
		}
		return $this->conn;
	}

	public function executeQuery($query, $param = null) {
		$result = false;
		try {
			$stmt = $this->getConnection()->prepare($query);
			$stmt->execute($param);
			$result = $stmt->fetchAll();
		} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "\n query: " . $query;
			die($error);
		}
		return $result;
	}

	public function executeUpdate($query, $param = null) {
		try {
			$stmt = $this->getConnection()->prepare($query);
			$stmt->execute($param);
			$rows = $stmt->rowCount();
		} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $rows;
	}

	public function getItems() {
		$sql = "SELECT * FROM items";
		$result = $this->executeQuery($sql);

		return $result;
	}

	/*
	public function getPallets() {
		$sql = "SELECT * FROM pallets";
		$result = $this->executeQuery($sql);

		return $result;
	}

	public function getCookies() {
		$sql = "SELECT * FROM cookies";
		$result = $this->executeQuery($sql);

		return $result;
	}

	Checks that there are enough ingredients to create one pallet of a cookie.
		Returns the credentials of the ingredients for updating storage.
		A pallet contains 5400 cookies which gives us the factor 54 for 100 cookie recipes.

	private function checkIngredients($cookie){
		$sql = "SELECT ingredientName, ingredientAmount, currentAmount FROM cookieingredients NATURAL JOIN ingredients WHERE cookieName = ? FOR UPDATE";
		$dbResult = $this->executeQuery($sql, array($cookie));

		foreach($dbResult as $row){
			if(($row['ingredientAmount']*54) > $row['currentAmount']){
				return -1;
			}
		}
		return $dbResult;
	}

	public function createPallet($cookie) {
		$blocked = 0;

		$this->getConnection()->beginTransaction();

		$sql = "INSERT INTO pallets(blocked, cookie) VALUES(?,?)";

		Default dateCreated. Column left blank for default value.
		$result = $this->executeUpdate($sql, array($blocked, $cookie));

		$ingredientCheck = $this->checkIngredients($cookie);

		if($ingredientCheck < 0){
			$this->getConnection()->rollBack();
			return false;
		}

		$this->getConnection()->commit();

		foreach($ingredientCheck as $credentials){
			$sql = "UPDATE ingredients SET currentAmount = (currentAmount - (?*54)) WHERE ingredientName = ?";
			$update = $this->executeUpdate($sql, array($credentials['ingredientAmount'], $credentials['ingredientName']));
		}
		return true;
	}

	public function blockPallets($startDate, $endDate, $cookie) {
		$this->getConnection()->beginTransaction();

		$fixedStartDate = date("Y-m-d H:i:s", strtotime($startDate));
		$fixedEndDate = date("Y-m-d H:i:s", strtotime($endDate." +23 hours +59 minutes +59 seconds"));

		$sql = "UPDATE pallets SET blocked = 1 WHERE dateCreated BETWEEN ? AND ? AND cookie = ?";

		$rows = $this->executeUpdate($sql, array($fixedStartDate, $fixedEndDate, $cookie));

		$this->getConnection()->commit();

		return $rows;
	}


	public function getIngredients() {
		$sql = "SELECT * FROM ingredients";
		$result = $this->executeQuery($sql);
		return $result;
	}

	public function getCookieIngredients($cookieName) {
		$sql = 'SELECT * FROM cookieingredients WHERE cookiename = ?';
		$result = $this->executeQuery($sql, array($cookieName));
		return $result;
	}



	public function getPalletDates() {
		$sql = "SELECT DISTINCT DATE_FORMAT(dateCreated, '%Y-%m-%d') as dateCreated FROM pallets";
		$result = $this->executeQuery($sql);
		return $result;
	}
	 */

}


?>
