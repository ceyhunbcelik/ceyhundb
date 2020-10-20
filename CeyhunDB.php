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

        $this -> sql = "";

        return $db;

      } catch (PDOException $e) {
        echo $e -> getMessage();
      }

    }

    function all(){
      return $this -> sql;
    }



  }

?>
