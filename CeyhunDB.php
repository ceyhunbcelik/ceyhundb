<?php

  class sqlStatements{

    function __construct(){
      $this -> sql = "";
    }

    function dbhost($host){
      $this -> sql .= 'mysql:host=' . $host . ';';
      return $this;
    }

    function dbname($name){
      $this -> sql .= 'dbname=' . $name;
      return $this;
    }

    function connect($user, $pass){
      try {
        $db = new PDO($this -> sql, $user, $pass);
        $db -> exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");

        $this -> sql = '';

        return $db;

      } catch (PDOException $e) {
        echo $e -> getMessage();
      }
    }

    function insert($table){
      $this -> sql = '';
      $this -> sql .= 'INSERT INTO ' .  $table . ' ';
      return $this;
    }

    function columns($columns){
      $this -> sql .= 'SET ' . implode(' = ?, ', func_get_args($columns)) . ' = ?';
      return $this;
    }

    function values($values){
      try {
        global $db;

        $query = $db -> prepare($this -> sql);
        $query -> execute(func_get_args($values));

        $this -> sql = '';

        if($query){
          return 1;
        } else{
          $error = $query -> errorInfo();
          return 'MySQL Error: ' . $error[2];
        }
      } catch (PDOException $e) {
        echo $e -> getMessage();
      }
    }

    function all(){
      return $this -> sql;
    }

  }

?>
