# CeyhunDB.php
PDO is good. But if you were use the MySQLi, you will feels like crazy. Because it is so simple.

If you were use NoSQL like a MongoDB, always want to object, class or function to do database operations.

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

## Pull Data[QUERY]
- type columns in select() function as parameter, if you want all of them, just put a star ( * )

- type table name in from() function as parameter

- we have different way to pull data. If you not permit outside intervention to your sql, query() is good, if you want to pull all of data, please put 'fetchall' in your query() parameter

``` php
$data = $sql -> select('*')
             -> from('table')
             -> query('fetchall');
```

- but if you want to filter by column and pull only one data, first of all, filter by where() function.

- use _where() function when you need more, till enough for your command and put 'fetch' parameter in query() function.

- first parameter is column, second parameter is comparison([=]/[>]/[<]) operator and third is value in where() function.

- use _where() if you need more where() function, difference between where and _where is, this function need more parameter and this extra parameter is logical([&&]/[||]) operator and that's put in first parameter and other parameters is like a where() function's parameters.

``` php
$data = $sql -> select('*')
             -> from('table')
             -> where('id', '=', '3')
             -> _where('&&', 'id', '=', '5')
             -> _where('&&', 'id', '=', '7')
             -> query('fetch');
```

## Pull Data[PREPARE]
- My favorite is this, if you permit outside intervention to your sql and want to protect from sql injection, this is the best because execute() function converting value to harmless. We are using prepare() instead of query().

- If you want to fetch only 1 data, put 'fetch' string in array of first parameter. Values should be in array of second parameter.

``` php
$data = $sql -> select('*')
             -> from('table')
             -> where('id', '=', '?')
             -> _where('&&', 'column', '=', '?')
             -> prepare(['fetch'], ['3', '1']);
```

- but if you want to fetch all of data, just put 'fetchall' in first array as parameter.

``` php
$data = $sql -> select('*')
             -> from('table')
             -> where('column', '=', '?')
             -> prepare(['fetchall'], ['0']);
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

## Update Data
- type table name as parameter in update() function

- type every column name as parameter in columns() function

- first parameter is column, second parameter is comparison([=]/[>]/[<]) operator and third is value in where() function.

- use _where() if you need more where() function, difference between where and _where is, this function need more parameter and this extra parameter is logical([&&]/[||]) operator and that's put in first parameter and other parameters is like a where() function's parameters.

- type your update and condition values as parameter in values() function

``` php
$update = $sql -> update('table')
               -> columns('column1', 'column2')
               -> where('id', '=', '?')
               -> _where('&&', 'column4', '=', '?')
               -> values('value1', 'value2', 'value3', 'value4');
```

## Delete Data

- type table name as parameter in delete() function

- first parameter is column, second parameter is comparison([=]/[>]/[<]) operator and third is value in where() function.

- use _where() if you need more where() function, difference between where and _where is, this function need more parameter and this extra parameter is logical([&&]/[||]) operator and that's put in first parameter and other parameters is like a where() function's parameters.

- type your condition values as parameter in values() function

``` php
$delete = $sql -> delete('table')
               -> where('id', '=', '?')
               -> values('value1');
```

## Join Table

- type columns with table in select() function as parameter

- type table name in from() function as parameter

- decide to use INNER, LEFT, RIGHT in first parameter of join() function and put table name in second parameter.

- put column to make equal in first and third parameters in on() function. second parameter is comparison parameter.

- If you want to fetch only 1 data, put 'fetch' string in array of first parameter. Values should be in array of second parameter.

- but if you want to fetch all of data, just put 'fetchall' in first array as parameter.

``` php
$query = $sql -> select('
                  table1.title,
                  table2.title as table2_title
                 ')
              -> from('table1')
              -> join('INNER/LEFT/RIGHT', 'table2')
              -> on('table1.table2_id', '=', 'table2.id')
              -> prepare(['fetchall'], []);
```

# CeyhunMVC.php
- We need the model-view-controller to manage directory of project or whatever you calling.

- At the same time, i think the best purpose is working on every system clearly. This is my new Palace gem. CeyhunMVC.php

route() function is giving your url route. For example

```  apacheconf
/blog/my-blog-post/5
```
is
```  php
Array([0] => blog [1] => my-blog-post [2] => 5)
```
when you print_r your $route, and $route should be:
```  php
$route = route();
```

- Second is URL:

```  php
URL
```

- eveybody know ne need the URL. CeyhunMVC.php providing dynamic URL by define().

- you need to include in index.php of your project. After than create init.php and include in last line of CeyhunMVC. You can use every providing of CeyhunDB in your init.php.

## License
This project is licensed under the Apache-2.0 License - see the [LICENSE](LICENSE) file for details
