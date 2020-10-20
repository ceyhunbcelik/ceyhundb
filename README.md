# CeyhunDB
PDO is good. But if you was use the MySQLi, you will feels like crazy. Because it is so simple.

If you was use NoSQL like a MongoDB, always want to object, class or function to do database operations.

I am making possible to use database operations by class. In this repository, I'm going to show you how to use database operations by functions of class rather than to use PDO directly.

## Include CeyhunDB
- First of all, we need to clone CeyhunDB into project and its depend to you but will be better if in the same directory with index.

- Please do not extract CeyhunDB.php from CeyhunDB folder because it's will be easy to make pull a new update.

- After clone, we will include CeyhunDB.php:

``` php
require_once('CeyhunDB/CeyhunDB.php');
```

## Connect Database
- We need host name in dbhost() function. Please put a host name in function as parameter. If you are no idea, type "localhost".

- dbname() is database name and we should type valid database name as parameter in that function.

- Last one is type username and password as first and second parameters in connect() function. If you are no idea, type "root" and "root"

``` php
$sql -> dbhost('your_host')
     -> dbname('your_database_name')
     -> connect('username', 'password.')
```

## License
This project is licensed under the Apache-2.0 License - see the [LICENSE](LICENSE) file for details
