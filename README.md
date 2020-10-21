# CeyhunDB
PDO is good. But if you was use the MySQLi, you will feels like crazy. Because it is so simple.

If you was use NoSQL like a MongoDB, always want to object, class or function to do database operations.

I am making possible to use database operations by class. In this repository, I'm going to show you how to use database operations by functions of class rather than to use PDO directly. ⚙️

<p align="center">
    <a href="https://www.buymeacoffee.com/" target="_blank">
      <img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: 41px !important;width: 174px !important;box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;" >
    </a>
</p>

## Include CeyhunDB
- First of all, we need to clone CeyhunDB into project and its depend to you but will be better if in the same directory with index.

- Please do not extract CeyhunDB.php from CeyhunDB folder because it's will be easy to make pull a new update.

- After clone, we will include CeyhunDB.php:

``` php
require_once('CeyhunDB/CeyhunDB.php');
$sql = new sqlStatements();
```

## Connect Database
- We need host name in dbhost() function. Please put a host name in function as parameter. If you are no idea, type "localhost".

- dbname() is database name and we should type valid database name as parameter in that function.

- Last one is type username and password as first and second parameters in connect() function. If you are no idea, type "root" and "root"

``` php
$db = $sql -> dbhost('your_host')
           -> dbname('your_database_name')
           -> connect('username', 'password')
```

## Pull Data
- type columns in select() function as parameter, if you want all of them, just put a star ( * )

- type table name in from() function as parameter

- we have different way to pull data. If you not permit outside intervention to your sql, query() is good, if you want to pull all of data, please put 'fetchall' in your query() parameter

``` php
$data = $sql -> select('*')
             -> from('table')
             -> query('fetchall');
```

## Insert Data
- type table name as parameter in insert() function

- type every column name as parameter in columns() function

- type your adding values as parameter in values() function

``` php
$insert = $sql -> insert('table')
               -> columns('column1', 'column2', 'column3')
               -> values('value1', 'value2', 'value3');

if($insert){
  // True
} else{
  // False
  echo $insert; // Error
}
```


## License
This project is licensed under the Apache-2.0 License - see the [LICENSE](LICENSE) file for details
