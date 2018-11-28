<?php

class QueryResult
{
    private $data;

    public function __construct($query)
    {
        $this->data = $query;
    }

    public function count()
    {
        return $this->data->num_rows;
    }

    public function row()
    {
        return $this->data->fetch_row();
    }

    public function toArray()
    {
        return SQL::dataToArray($this->data);
    }
}

class SQL
{
    private const HOST = 'localhost';
    private const USER = 'root';
    private const PASSWORD = '';
    private const DATABASE = 'digital_journal';

    public static function dataToArray($data)
    {
        $array = array();
        while ($row = self::getRow($data)) {
            $len = count($row);
            $rowArr = array();
            for ($j = 0; $j < $len; ++$j) {
                array_push($rowArr, $row[$j]);
            }
            array_push($array, $rowArr);
        }
        return $array;
    }

    protected $connection;

    public function __construct()
    {
        $host = self::HOST;
        $user = self::USER;
        $password = self::PASSWORD;
        $dbName = self::DATABASE;
        $connection = mysqli_connect($host, $user, $password) or die("Error: " . mysqli_error($connection));
        @include_once realpath(__DIR__ . '/init.php');
        $connection->set_charset("utf8");
        $connection->select_db($dbName);
        $this->connection = $connection;
    }

    public function __destruct()
    {
        $this->connection->close();
    }

    protected function toShield($connection, $data)
    {
        return htmlentities(mysqli_real_escape_string($connection, $data));
    }

    public function run($query)
    {
        $data = $this->connection->query($query);
        return new QueryResult($data);
    }

    public function fromPOST($name)
    {
        return $this->toShield($this->connection, $_POST[$name]);
    }

    public function fromGET($name)
    {
        return $this->toShield($this->connection, $_GET[$name]);
    }
}

class DB extends SQL
{
    protected static function join($data, $separator = ', ')
    {
        return implode($separator, $data);
    }

    protected static function getColumns($columns)
    {
        switch (gettype($columns)) {
            case 'array':
                return self::join($columns);
            case 'string':
                return $columns;
            default:
                return '*';
        }
    }

    protected static function getValues($values)
    {
        switch (gettype($values)) {
            case 'array':
                return '"' . self::join($values, '", "') . '"';
            case 'string':
                return '"' . $values . '"';
            default:
                return '';
        }
    }

    public function select($table, $columns, $condition = null, $append = null)
    {
        $query = "SELECT " . self::getColumns($columns) . " FROM `$table`";
        if ($condition) {
            $query .= " WHERE $condition";
        }
        if ($append) {
            $query .= $append;
        }
        $query .= ';';
        return parent::run($query);
    }

    public function insert($table, $columns = null, $values)
    {
        $query = "INSERT INTO `$table` ";
        if ($columns) {
            $query .= "(" . self::getColumns($columns) . ") ";
        }
        $query .= "VALUES (" . self::getValues($values) . ");";
        return parent::run($query);
    }

    public function update($table, $set, $condition = null)
    {
        $query = "UPDATE `$table` SET $set";
        if ($condition) {
            $query .= " WHERE $condition";
        }
        $query .= ';';
        return parent::run($query);
    }

    public function delete($table, $condition = null)
    {
        $query = "DELETE FROM `$table`";
        if ($condition) {
            $query .= " WHERE $condition";
        }
        $query .= ';';
        return parent::run($query);
    }
}
