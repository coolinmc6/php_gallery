<?php 


class Db_object {

	
	public static function find_all() {

		return static::find_by_query('SELECT * FROM ' . static::$db_table);
	}


	public static function find_by_id($id) {
		global $database;
		$array = static::find_by_query("SELECT * FROM ". static::$db_table . " WHERE id = $id LIMIT 1;");
		
		return !empty($array) ? array_shift($array) : false;
		
	}

	public static function find_by_query($sql) {
		global $database;
		$result_set = $database->query($sql);
		$object_array = array();
		
		while($row = mysqli_fetch_array($result_set)) {

			$object_array[] = static::instantiation($row);
		}



		
		return $object_array;
	}

	public static function instantiation($the_record) {

		$calling_class = get_called_class();
		$the_object = new $calling_class;

		foreach ($the_record as $attribute => $value) {
			if($the_object->has_the_attribute($attribute)) {
				$the_object->$attribute = $value;
			}
		}

		// echo 'An object was created!';

		return $the_object;
	}


	private function has_the_attribute($attribute){
		$object_properties = get_object_vars($this);

		return array_key_exists($attribute, $object_properties);
	}



	protected function properties() {
		// return get_object_vars($this);


		$properties = array();

		foreach (static::$db_table_fields as $db_field) {
			if(property_exists($this, $db_field)) {
				$properties[$db_field] = $this->$db_field;
			}
		}

		return $properties;
	}

	protected function clean_properties() {
		global $database;

		$clean_properties = array();

		foreach ($this->properties() as $key => $value) {
			
			$clean_properties[$key] = $database->escaped_string($value);
		}
		return $clean_properties;
	}


	public function save() {

		return isset($this->id) ? $this->update() : $this->create();

	}


	// Create Method
	public function create() {

		global $database;

		// echo "<pre>";
		// print_r($database);
		// echo "</pre>";

		$properties = $this->clean_properties();

		// echo "<pre>";
		// print_r($properties);
		// echo "</pre>";
		


		
		$sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ")";
		$sql .= " VALUES('" . implode("','", array_values($properties)) . "')";
		
		if($database->query($sql)) {
			$this->id = $database->the_insert_id();
			return true;
		} else {
			return false;
		}
		
	}

	// Update Method
	public function update() {
		global $database;

		$properties = $this->clean_properties();

		$properties_pairs = array();

		foreach ($properties as $key => $value) {
			
			$properties_pairs[] = "{$key}='{$value}'";
		}

		$sql = "UPDATE " . static::$db_table . " SET ";
		$sql .= implode(", ",$properties_pairs);
		$sql .= " WHERE id= " . $database->escaped_string($this->id);

		
		$database->query($sql);	

		return (mysqli_affected_rows($database->connection) == 1) ? true : false;
	}


	// Delete Method
	public function delete() {
		global $database;

		$sql = "DELETE FROM " . static::$db_table . " WHERE id = " . $database->escaped_string($this->id) . " LIMIT 1";

		$database->query($sql);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false;

	}







}




 ?>