<?php

  class SQL {

    private const HOST = 'localhost';
    private const USER = 'root';
    private const PASSWORD = '';
    private const DATABASE = 'digital_journal';

    public static function dataToArray ($data) {
      $array = array();
      while ($row = self::getRow($data)) {
        $len = count($row);
        $rowArr = array();
        for ($j = 0 ; $j < $len ; ++$j) {
          array_push($rowArr, $row[$j]);
        }
        array_push($array, $rowArr);
      }
      return $array;
    }

    protected $connection;
    protected $data = null;

    function __construct () {
      $this->connection = mysqli_connect(self::HOST, self::USER, self::PASSWORD, self::DATABASE) or die("Error: " . mysqli_error($conn));
    }

    function __destruct () {
      $this->free();
      $this->connection->close();
    }

    protected function free () {
      //$this->data->free();
    }

    protected function toShield ($connection, $data) {
      return htmlentities(mysqli_real_escape_string($connection, $data));
    }

    public function run ($query) {
      $this->free();     
      $this->data = $this->connection->query($query);
      return $this->data;
    }

    public function count () {
      return $this->data->num_rows;
    }

    public function row () {
      return $this->data->fetch_row();
    }

    public function toArray () {
      return self::dataToArray($this->data);
    }

    public function fromPOST ($name) {
      return $this->toShield($this->connection, $_POST[$name]);
    }

    public function fromGET ($name) {
      return $this->toShield($this->connection, $_GET[$name]);
    }

  }//oko

  class DB extends SQL {

    protected static function join ($data, $separator = ', ') {
      return implode($separator, $data);
    }

    protected static function getColumns ($columns) {
      switch (gettype($columns)) {
      case 'array':
        return self::join($columns);
      case 'string':
        return $columns;
      default:
        return '*';
      }
    }

    protected static function getValues ($values) {
      switch (gettype($values)) {
        case 'array':
          return '"' . self::join($values, '", "') . '"';
        case 'string':
          return '"' . $values . '"';
        default:
          return '';
        }
    }

    public function select ($table, $columns, $condition = null) {
      $query = "SELECT " . self::getColumns($columns) . " FROM $table";
      if ($condition) {
        $query .= " WHERE $condition";
      }
      $query .= ';';
      return parent::run($query);
    }

    public function insert ($table, $columns = null, $values) {
      $query = "INSERT INTO $table ";
      if ($columns) {
        $query .= "(" . self::getColumns($columns) . ") ";
      }
      $query .= "VALUES (" . self::getValues($values) . ");";
      return parent::run($query);
    }

    public function update ($table, $set, $condition = null) {
      $query = "UPDATE $table SET $set";
      if ($condition) {
        $query .= " WHERE $condition";
      }
      $query .= ';';
      return parent::run($query);
    }

    public function delete ($table, $condition = null) {
      $query = "DELETE FROM $table";
      if ($condition) {
        $query .= " WHERE $condition";
      }
      $query .= ';';
      return parent::run($query);
    }

  }
  
  /*
  CREATE DATABASE `digital_journal`;

CREATE TABLE `digital_journal`.`ch_stud` ( `id` INT NOT NULL , `record` INT NOT NULL , `student` INT NOT NULL , `mark` BOOLEAN NOT NULL , `reason` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `digital_journal`.`groupp` ( `id` INT NOT NULL , `number` INT NOT NULL , `faculty` VARCHAR(255) NOT NULL , `year` DATE NOT NULL , `napravl` VARCHAR(255) NOT NULL , `stepen` VARCHAR(15) NOT NULL , `curs` INT NOT NULL , `form` BOOLEAN NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `digital_journal`.`student` ( `id` INT NOT NULL , `name` VARCHAR(180) NOT NULL , `group` INT NOT NULL , `ch_starost` BOOLEAN NOT NULL , PRIMARY KEY (`id`, `name`)) ENGINE = InnoDB;

CREATE TABLE `digital_journal`.`user` ( `id` INT NOT NULL , `username` VARCHAR(65) NOT NULL , `password` VARCHAR(100) NOT NULL , `role` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `digital_journal`.`record` ( `id` INT NOT NULL , `subject` INT NOT NULL , `call` INT NOT NULL , `date` DATE NOT NULL , `teacher` INT NOT NULL , `description` VARCHAR(255) NOT NULL , `prep_utv` BOOLEAN NOT NULL , `bylo` BOOLEAN NOT NULL , `reason` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `digital_journal`.`subject` ( `id` INT NOT NULL , `name` VARCHAR(60) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `digital_journal`.`calll` ( `id` INT NOT NULL , `time_begin` TIME NOT NULL , `time_end` TIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `digital_journal`.`teacher` ( `id` INT NOT NULL , `name` VARCHAR(180) NOT NULL , `ch_director` BOOLEAN NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
*/

?>