<?php 

require_once('new_config.php');

class Database {

	public $connection;
	/*
	- This method is run automatically when the object is instantiated
	- for this function, it is simply establishing the connection to the database
	*/
	function __construct() {
		$this->open_db_connection();
	}

	/*
	- This method sets our `$connection` property equal to a new mysqli object
	- This is the base for everything else we do. Our query method is built off
	of this which then several other methods build off of that
	- Of most importance here is that it is a mysqli object
	*/
	public function open_db_connection() {
		// $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);	

		$this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		if($this->connection->connect_errno) {
			die('Database connection failed' . $this->connection->connect_errno);
		}
	}

	/*
	- This looks simple but several things are happening here.
	- We are setting `$result` to our query (as in mysqli_query) given some SQL
	- mysqli query are run by doing `$mysqli_object->query()` and that's exactly what
	we do below.
	  - `$this->connection` is our mysqli object
	  - `->query($sql)` is the mysqli_query
	- don't be confused by the fact that the name of our method is "query", we do have
	two: our method and the built-in myslqi method
	*/
	public function query($sql) {

		// $result = mysqli_query($this->connection, $sql);

		$result = $this->connection->query($sql);

		return $result;
	}

	/*

	*/
	private function confirm_query($result){
		if(!$result) {
			die('Query failed ' . $this->connection->error);
		}

	}

	/*

	*/
	public function escaped_string($string) {
		// $escaped_string = mysqli_real_escape_string($this->connection, $string);
		$escaped_string = $this->connection->real_escape_string($string);
		return $escaped_string;
	}

	/*

	*/
	public function the_insert_id() {
		// return $this->connection->insert_id;
		return mysqli_insert_id($this->connection);
	}


}


$database = new Database();







 ?>