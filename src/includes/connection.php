<?php

  class SQL {

    private const HOST = 'localhost';
    private const USER = 'root';
    private const PASSWORD = '';
    private const DATABASE = 'digital_journal';

    public static function connect () {
      $result = mysqli_connect(self::HOST, self::USER, self::PASSWORD, self::DATABASE) or die("Error: " . mysqli_error($conn));;
      return $result;
    }

    public static function disconnect ($connection) {
      mysqli_close($connection);
    }

    public static function runQuery ($connection, $query) {
      $data = mysqli_query($connection, $query) or die("Error: " . mysqli_error($connection));
      return $data;
    }

    public static function freeData ($data) {
      if ($data) {
        //mysqli_free_result($data);
      }
    }

    public static function rowCount ($data) {
      if ($data) {
        return mysqli_num_rows($data);
      }
      return 0;
    }

    public static function getRow ($data) {
      if ($data) {
        return $data->fetch_row();
      }
      return null;
    }

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
      $this->connection = self::connect();
    }

    function __destruct () {
      $this->free();
      self::disconnect($this->connection);
    }

    protected function free () {
      self::freeData($this->data);
    }

    protected function toShield ($connection, $data) {
      return htmlentities(mysqli_real_escape_string($connection, $data));
    }

    public function run ($query) {
      $this->free();
      $this->data = self::runQuery($this->connection, $query);
      return $this->data;
    }

    public function count () {
      return self::rowCount($this->data);
    }

    public function row () {
      return self::getRow($this->data);
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

  }

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

?>