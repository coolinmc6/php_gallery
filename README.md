# README

## Built-in PHP Functions to Research
- `__FILE__`
- `__LINE__`
- `__DIR__`
- `array_key_exists()`
- `array_keys()`
- `array_values()`
- `basename()`
- `empty();`
- `file_exists()`
- `get_called_class()`
  - used in our static instatiation method of db_object, it simply gets the name of the class
  the static method is called in.
  - will return a string of the class name or `FALSE` if called from outside a class
- `get_object_vars()`
- `htmlentities()`
- `implode()`
- `is_file()`
- `join();`
- `move_uploaded_file();`
- `property_exists();`
- `session_start()`
- `unlink()`
- `unset()`


## Database Tables

### Users

```sql
CREATE TABLE `gallery`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  `first_name` VARCHAR(255) NULL,
  `last_name` VARCHAR(255) NULL,
  PRIMARY KEY (`id`));
```
 - **NOTE:** I added a user_image column

### Photos

```sql
CREATE TABLE `gallery`.`photos` (
  `photo_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL,
  `description` TEXT NULL,
  `filename` VARCHAR(255) NULL,
  `type` VARCHAR(255) NULL,
  `size` INT(11) NULL,
  PRIMARY KEY (`photo_id`));
```
  - **NOTE:** I changed the name of the column to 'id' in L118
  - **NOTE:** I added a caption and alternate_text field

### Comments

```sql
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `body` longtext,
  PRIMARY KEY (`id`),
  KEY `index2` (`photo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```


## OOP Notes

### Database Class

```php
function __construct() {
  $this->open_db_connection();
}
```
- This method is run automatically when the object is instantiated
- for this function, it is simply establishing the connection to the database

```php
public function open_db_connection() {
  // $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);  

  $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if($this->connection->connect_errno) {
    die('Database connection failed' . $this->connection->connect_errno);
  }
}
```
- This method sets our `$connection` property equal to a new mysqli object
- This is the base for everything else we do. Our query method is built off
of this which then several other methods build off of that
- Of most importance here is that it is a mysqli object

```php
public function query($sql) {

  // $result = mysqli_query($this->connection, $sql);

  $result = $this->connection->query($sql);

  return $result;
}
```
- This looks simple but several things are happening here.
- We are setting `$result` to our query (as in mysqli_query) given some SQL
- mysqli query are run by doing `$mysqli_object->query()` and that's exactly what
we do below.
  - `$this->connection` is our mysqli object
  - `->query($sql)` is the mysqli_query
- don't be confused by the fact that the name of our method is "query", we do have
two methods: the one we made and the built-in myslqi method

```php
$database = new Database();
```
- The line above declares the `$database` variable which is a new instance of the Database
class. As I started to see, to use the database in any particular method, I need to access
that variable, which I do by including `global $database`. Here is a write-up I borrowed
from online to explain why that's the case:
  - we need to use `global` in order to "bring in" the `$database` variable __inside the current__ 
   __scope that we are currently working in__, like in a method of a particular class, if you 
  want to use `$database` and it's methods, you need to bring it inside of the scope of the method 
  that you're trying to use it in. 
  - Each method or regular function has it's own scope, if you want to bring in some variable 
  that's declared outside of the scope of that function, you need to bring it inside that 
  function scope, with `global $variableName;`.

***
### Db_object Class

#### Find_by_Query()

```php
public static function find_by_query($sql) {
  global $database;
  $result_set = $database->query($sql);
  $object_array = array();
  
  while($row = mysqli_fetch_array($result_set)) {

    $object_array[] = static::instantiation($row);
  }

  return $object_array;
}
```
- one of the first things that I noticed was the `global $database` declaration.

#### Find_All()
- the parent class for the method is `Db_object` so it is available to ALL classes

```php
public static function find_all() {

  return static::find_by_query('SELECT * FROM ' . static::$db_table);
}
```
- The first thing I noticed was the SQL which is pretty much just a select all from a particular
table.  But what table?
- The `static::$db_table` is called late static binding. I haven't dug too deep into it but it
takes the place of self or this in a normal class method / property.
  - For my db_object, by using `static::` before the method or property, I am allowing the child
  class to be the class calling the method.
- Now starting from the beginning, this method is `public` and `static`. Public means that it can be
called outside the class and `static` means that the method is accessible WITHOUT needing an
instantiation of the class. 
- This method simply returns the results of another method we've created, `find_by_query()`, which
is also static.  We call it statically by doing `static::find_by_query([SQL STATEMENT])`
- Our `find_by_query()` method takes one argument, the SQL statement, which as I said before, is
just a `SELECT * FROM` and then the table name is added into the statement using `static::$db_table`
  - What we do NOT see here is that $db_table property is set for each class. So the User class has
  a table `users`, Photo class has `photos`, etc.
  - Note: not every class needs to access the database so the Session class, which doesn't need to
  insert anything related to the session into the db, doesn't have a `$db_table`

#### Find_By_ID()
- the parent class for the method is `Db_object` so it is available to ALL classes

```php
public static function find_by_id($id) {
  global $database;
  $array = static::find_by_query("SELECT * FROM ". static::$db_table . " WHERE id = $id LIMIT 1;");
  
  return !empty($array) ? array_shift($array) : false;
  
}
```
- this function returns a single object based on the id. What is not obvious here is that the `find_by_query()`
method



#### Create()

***
### User


***
### Photo


***
### Comment


***
### OOP Discussion Break (Finished L102)
- up to this point, we've built mostly just the user class and then in the last couple lectures
we extracted most of the methods into a parent class called `Db_object`
- One of the first things that I noticed as we were building these methods is their similarity to Rails,
which makes sense, in that there is a create, update, save, and delete methods.
- I also noticed how we created `find_by_id()` and `find_all()` which I think came with Rails for free
- I first want to walk through how we create a new User:

```php
// 1. Instantiate a new User object
$user = new User();

// 2. Assign the object its properties (username, password, etc.)
$user->username = "Another User";
$user->password = "maadsfasdfadsf";
$user->first_name = "Christopher";
$user->last_name = "Banks";

// 3. Call the save() method
$user->save();
```

- If I print the `$user` object I get: `User Object ( [id] => [username] => Another User [password] => maadsfasdfadsf [first_name] => Christopher [last_name] => Banks )`
  - notice how the `id` is NOT set, this allows the `save()` method to then use the correct method, `create()`, 
  as opposed to `update()`
- In the `save()` method, as I said above, the User object gets sent to the `create()` method
-

### OOP Discussion Break (course completed)


### OOP Methods
- Call a Class method, inside the class

```php
$this->check_the_login();
```
- Call a Class method statically

```php
$user = User::find_user_by_id(1);
```


### OOP Properties
- Output a Class object's property:

```php
$found_user = User::find_user_by_id(1);

echo $found_user->username;
```

- Set a Class property, inside the class

```php
$this->user_id = $_SESSION['user_id'];
```

### OOP Abstraction
- We created a property in our User class that allows us to abstract the name of our database table
from our SQL queries. This makes our code more portable: `protected static $db_table = "users";`

```php
// An example from the delete() method:
$sql = "DELETE FROM " . self::$db_table . " WHERE id = " . $database->escaped_string($this->id) . " LIMIT 1";
```



## Lecture Notes

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
- He built an autoloader. The original was deprecated but I've included an updated one as well:

```php
// OLD
function __autoload($class) {

  $class = strtolower($class);

  $path = "includes/${class}.php";

  if(file_exists($path)) {
    require_once($path);
  } else {
    die("This file named {$class}.php was not made...");
  }

}

// NEW
function classAutoLoader($class) {

  $class = strtolower($class);

  $path = "includes/${class}.php";

  if(file_exists($path)) {
    require_once($path);
  } else {
    die("This file named {$class}.php was not made...");
  }

}

spl_autoload_register('classAutoLoader');

```

- He recommends using `require_once()` as opposed to `include_once()` as it's more secure.
- To upload a file, we need to do a couple things:

```html
<form action="upload.php" enctype="multipart/form-data" method="post">
  <input type="file" name="file_upload"> <br>
  <input type="submit" name="submit">
</form>
```
  - the key part is the `enctype="multipart/form-data"`
- When uploading a file, we use the Super Global `$_FILES['file_name']`
- There are 5 keys in the associative array `$_FILES['file_name']`:
  - name -> file name
  - type -> jpg, png, gif, doc, etc....
  - size -> in bytes
  - tmp_name -> a temporary name
  - error -> the error code, if one
- Here is an example of the output:

```html
Array
(
    [name] => Screen Shot 2017-11-02 at 9.59.20 AM.png
    [type] => image/png
    [tmp_name] => /Applications/MAMP/tmp/php/phpvu6o9J
    [error] => 0
    [size] => 379826
)
```
  - the tmp_name is what we'll need to move the file around and put it somewhere useful to us
- there are 8 error codes when uploading a file
- Uploading a file is pretty easy:
  1. Get the temporary name of file
  2. Get the actual name of file
  3. Define the directory that you want to put it
  4. Use `move_uploaded_file()` to move the file
    - `move_uploaded_file()` requires the temp name of the file and the directory/new_name
  5. The `move_uploaded_file()` returns a true/false value, so we can use our error reporting code 

```php
$temp_name = $_FILES['file_upload']['tmp_name'];
$the_file = $_FILES['file_upload']['name'];
$directory = "uploads";

if(move_uploaded_file($temp_name, $directory . "/" . $the_file)) {
  $the_message = "File uploaded successfully";
} else {
  $the_error = $_FILES['file_upload']['error'];

  $the_message = $upload_errors[$the_error];
}
```

- We are about to abstraction; here is the original create() method (most of it):

```php
$sql = "INSERT INTO " . self::$db_table . " (username, password, first_name, last_name) VALUES('";
$sql .= $database->escaped_string($this->username) . "', '";
$sql .= $database->escaped_string($this->password) . "', '";
$sql .= $database->escaped_string($this->first_name) . "', '";
$sql .= $database->escaped_string($this->last_name) . "')";

if($database->query($sql)) {
  $this->id = $database->the_insert_id();
  return true;
} else {
  return false;
}
```


- **NOTE:** Two changes made to the database. See the notes above to see the specifics.

- finish L196, start L197






















