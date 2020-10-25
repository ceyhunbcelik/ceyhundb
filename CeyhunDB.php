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

    function select($columns){
      $this -> sql = '';

      $this -> sql .= 'SELECT ' . $columns . ' ';
      return $this;
    }

    function from($tables){
      $this -> sql .= 'FROM ' . $tables;
      return $this;
    }

    function query($fetch){
      try {
        global $db;
        $fetch = function_exists('mb_strtolower') ? mb_strtolower($fetch) : strtolower($fetch);

        if($fetch == 'fetch'){
          $query = $db -> query($this -> sql) -> fetch(PDO::FETCH_ASSOC);

          $this -> sql = '';

          return $query;

        } elseif ($fetch == 'fetchall') {
          $query = $db -> query($this -> sql) -> fetchAll(PDO::FETCH_ASSOC);

          $this -> sql = '';

          return $query;
        }
      } catch (PDOException $e) {
        echo $e -> getMessage();
      }
    }

    function update($table){
      $this -> sql = '';

      $this -> sql .= 'UPDATE ' . $table . ' ';
      return $this;
    }

    function prepare($values){
      try {
        global $db;
        $fetch = function_exists('mb_strtolower') ? mb_strtolower(func_get_args($values)[0][0]) : strtolower(func_get_args($values)[0][0]);
        $values = func_get_args($values)[1];

        if($fetch == 'fetch'){
          $query = $db -> prepare($this -> sql);
          $query -> execute($values);

          $this -> sql = '';

          $data = $query -> fetch(PDO::FETCH_ASSOC);

          return $data;
        } elseif ($fetch == 'fetchall') {
          $query = $db -> prepare($this -> sql);
          $query -> execute($values);

          $this -> sql = '';

          $data = $query -> fetchAll(PDO::FETCH_ASSOC);

          return $data;
        }

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
          return $query;
        } else{
          $error = $query -> errorInfo();
          return 'MySQL Error: ' . $error[2];
        }
      } catch (PDOException $e) {
        echo $e -> getMessage();
      }
    }

    function delete($table){
      $this -> sql = '';

      $this -> sql .= 'DELETE FROM ' . $table;
      return $this;
    }

    function join($type, $table){
      $this -> sql .= ' ' . $type . ' JOIN ' . $table;
      return $this;
    }

    function on($tableColum1, $comparison, $tableColumn2){
      $this -> sql .= ' ON ' . $tableColum1 . ' ' . $comparison . ' ' . $tableColumn2;
      return $this;
    }

    function where($column, $comparison, $value){
      $this -> sql .= ' WHERE ' . $column . ' ' . $comparison . ' ' . $value;
      return $this;
    }

    function _where($logical, $column, $comparison, $value){
      $this -> sql .= ' ' . $logical . ' ' . $column . ' ' . $comparison . ' ' . $value;
      return $this;
    }

    function where_check(){
      $this -> sql .= ' WHERE ';
      return $this;
    }

    function order_by($column, $sort){
      $this -> sql .= ' ORDER BY ' . $column . ' ' . $sort;
      return $this;
    }

    function like($type, $tableColum, $value){
      if($type == 'start'){
        $this -> sql .= $tableColum . ' LIKE "' . $value . '%"';
      } elseif($type == 'end'){
        $this -> sql .= $tableColum . ' LIKE "%' . $value . '"';
      } elseif ($type == 'in') {
        $this -> sql .= $tableColum . ' LIKE "%' . $value . '%"';
      }
      return $this;
    }

    function _like($logical, $type, $tableColum, $value){
      if($type == 'start'){
        $this -> sql .= ' ' . $logical . ' ' . $tableColum . ' LIKE "' . $value . '%"';
      } elseif($type == 'end'){
        $this -> sql .= ' ' . $logical . ' ' . $tableColum . ' LIKE "%' . $value . '"';
      } elseif ($type == 'in') {
        $this -> sql .= ' ' . $logical . ' ' . $tableColum . ' LIKE "%' . $value . '%"';
      }
      return $this;
    }

    function between($start, $end){
      $this -> sql .= ' BETWEEN "' . $start . ' 00:00:00" AND "' . $end ' 23:59:59"';
    }

    function all(){
      return $this -> sql;
    }

  }

?>
