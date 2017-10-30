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

START ON LECTURE 39
