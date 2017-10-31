# README

- Create `users` table:

```sql
CREATE TABLE `gallery`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  `first_name` VARCHAR(255) NULL,
  `last_name` VARCHAR(255) NULL,
  PRIMARY KEY (`id`));
```

- `<?php ob_start() ?>` turns on output buffering
- This is how we query the database:

```php
$sql = 'select * from users;';
$result = $database->query($sql);
$user_found = mysqli_fetch_array($result);


foreach ($user_found as $key => $value) {
    echo $key . " - " . $value . "<br>";
}
```

- We changed the `find_all_users()` method to a static function so that we can call it
 by simply doing `$result_set = User::find_all_users();`

- Lecture 43: Instantiation
  - we created a method that is given user data from the database and then we instantiate a user object

```php
public static function instantiation($found_user) {
	$the_object = new self;

	$the_object->id = $found_user['id'];
	$the_object->username = $found_user['username'];
	$the_object->password = $found_user['password'];
	$the_object->first_name = $found_user['first_name'];
	$the_object->last_name = $found_user['last_name'];

	return $the_object;
}
```

  - this would be incredibly tedious if we had like 50 columns

## Built-in PHP Functions to Research
- get_object_vars
- array_key_exists


## OOP Notes
- to echo a Class object's property:

```php
$found_user = User::find_user_by_id(1);

echo $found_user->username;
```

- Start on Lecture 49: Undeclared OBject
