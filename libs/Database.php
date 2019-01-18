<?php
class Database
{
    private $conn;
    private $sqlQuery = '';
    private $error = [];
    private $parameters = 0;
    private $values = 0;

    public function connect()
    {
        $this->conn = mysqli_connect("localhost", "root", "", "mvc_php");

        if (!$this->conn) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
    }

    public function select($target = '*')
    {
        $this->sqlQuery .= 'SELECT ' . $target . ' ';
        return $this;
    }

    public function insert($tableName)
    {
        $this->sqlQuery .= ' INTO ' . $tableName . ' ';
        return $this;
    }
    
    
    public function from($tableName)
    {
        $this->sqlQuery .= ' FROM ' . $tableName . ' ';
        return $this;
    }

    public function where($field, $value, $operator = '=')
    {
        $this->sqlQuery .= 'WHERE ' . $field . ' ' . $operator  . ' ' . $value . ' ';
        return $this;
    }

    public function whereAnd($field, $value, $operator = '=')
    {
        $this->sqlQuery .= 'AND ' . $field . ' ' . $operator  . ' ' . $value . ' ';
        return $this;
    }

    public function whereOR($field, $value, $operator = '=')
    {
        $this->sqlQuery .= 'OR ' . $field . ' ' . $operator  . ' ' . $value . ' ';
        return $this;
    }

    public function parameters($parameters)
    {
        
        if (!is_aaray($parameters)){
           $parameters = (array) $parameters;
        }
        $this->parameters = count($parameters);
        $this->sqlQuery .= ' (';
        $i = 0;
        foreach ($parameters as $parameter) {
            $this->sqlQuery .= ' ' . $parameter;
            if ($i < count($parameters)){
                $this->sqlQuery .= ', ';
            }
            $i++;
        }
        $this->sqlQuery .= ') ';
        return $this;
        
    }
    public function values($values)
    {
        if ($this->parameters <> count($values)){
            $this->error[] = ' SQL parameters amount is not equal to Values amount';
        }

        if (!is_aaray($values)){
            $values = (array) $values;
        }
        $this->connect(); // ar tikrai reikia atidaryti jungti?
        $this->values = count($values);
        $this->sqlQuery .= ' VALUES (';
        $i = 0;
        foreach ($values as $values) {
            $this->sqlQuery .= ' ' . $this->escape($values);
            if ($i < count($values)){
                $this->sqlQuery .= ', ';
            }
            $i++;
        }
        $this->sqlQuery .= ') ';
        return $this;
    }
    
    public function escape($string) 
    {
        return $this->conn->real_escape_string($string);
    }

    public function get()
    {
        $this->connect();
        return $this->conn->query($this->sqlQuery);
    }
}
