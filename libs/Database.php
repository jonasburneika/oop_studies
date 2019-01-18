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

    public function select($columns = '*', $distinct = false)
    {
       
        if (!is_array($columns)){
            $this->sqlQuery .= 'SELECT ' . $columns . ' ';
        } else {
            $i = 0;
            foreach ($columns as $column) {
                if ($i > 0) {
                    $this->sqlQuery .= $column . ' ';
                } else {
                    $this->sqlQuery .= 'SELECT ' . $column . ', ';
                }
                if ($i < count($columns)) { 
                    $this->sqlQuery .= ', ';
                }
                $i++;
            }
        }
       
        return $this;
    }

    public function insert($tableName)
    {
        $this->sqlQuery .= ' INTO ' . $tableName . ' ';
        return $this;
    }

    public function delete()
    {
        $this->sqlQuery .= 'DELETE ' ;
        return $this;
    }   
    
    public function update($tableName)
    {
        $this->sqlQuery .= 'UPDATE ' . $tableName . ' ';
        return $this;
    }
    
    public function from($tableName)
    {
        $this->sqlQuery .= ' FROM ' . $tableName . ' ';
        return $this;
    }

    public function set($values)
    {
        if (!is_array($values)){
            return false;
        }
        $this->sqlQuery .= ' SET ';
        $i = 0;
        foreach ($values as $key => $values) {
            $this->sqlQuery .= ' '. $key . ' = ' . $values . ' ';
            if ($i < count($values)){
                $this->sqlQuery .= ', ';
            }
            $i++;
        }
        return $this;
    }

    public function where($columnValue, $value, $operator = '=')
    {
        $this->sqlQuery .= 'WHERE ' . $columnValue . ' ' . $operator  . ' ' . $value . ' ';
        return $this;
    }

    public function whereAnd($columnValue, $value, $operator = '=')
    {
        $this->sqlQuery .= ' AND ' . $columnValue . ' ' . $operator  . ' ' . $value . ' ';
        return $this;
    }

    public function whereOr($columnValue, $value, $operator = '=')
    {
        $this->sqlQuery .= ' OR ' . $columnValue . ' ' . $operator  . ' ' . $value . ' ';
        return $this;
    }

    public function whereNot($columnValue, $value, $operator = '=')
    {
        $this->sqlQuery .= ' NOT ' . $columnValue . ' ' . $operator  . ' ' . $value . ' ';
        return $this;
    }

    public function whereBetween($columnValue, $value1, $value2 )
    {
        $this->sqlQuery .= ' WHERE ' . $columnValue . ' BETWEEN ' . $value1  . ' AND ' . $value2 . ' ';
        return $this;
    }
    
    public function in($sql)
    {
        if (is_string($sql)){
            $this->sqlQuery .= ' IN ( ' . $sql . ') ';
            return $this;
        }
        if (is_array($sql)){
            $this->sqlQuery .= ' IN ( ';
            $i = 0;
            foreach ($sql as $value) {
                $this->sqlQuery .= $value;
                if ($i < count($sql)){
                    $this->sqlQuery .= ', ';
                }
            }
            $this->sqlQuery .= ') ';
            return $this;
        }
        
    }

    public function notIn($sql)
    {
        if (is_string($sql)){
            $this->sqlQuery .= ' NOT IN ( ' . $sql . ') ';
            return $this;
        }
        if (is_array($sql)){
            $this->sqlQuery .= ' NOT IN ( ';
            $i = 0;
            foreach ($sql as $value) {
                $this->sqlQuery .= $value;
                if ($i < count($sql)){
                    $this->sqlQuery .= ', ';
                }
            }
            $this->sqlQuery .= ') ';
            return $this;
        }
        
    }

    public function parameters($parameters)
    {
        
        if (!is_array($parameters)){
           $parameters = (array) $parameters;
        }
        $this->parameters = count($parameters);
        $this->sqlQuery .= ' (';
        $i = 0;
        foreach ($parameters as $parameter) {
            $this->sqlQuery .= ' ' . $parameter;
            
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
        $this->values = count($values);
        $this->sqlQuery .= ' VALUES (';
        $i = 0;
        foreach ($values as $values) {
            $this->sqlQuery .= ' ' . $values;
            if ($i < count($values)){
                $this->sqlQuery .= ', ';
            }
            $i++;
        }
        $this->sqlQuery .= ') ';
        return $this;
    }

    public function innerJoin($tableName)
    {
        $this->sqlQuery .= ' INNER JOIN ' . $tableName . ' ';
        return $this;
    }

    public function leftJoin($tableName)
    {
        $this->sqlQuery .= ' LEFT JOIN ' . $tableName . ' ';
        return $this;
    }

    public function rightJoin($tableName)
    {
        $this->sqlQuery .= ' RIGHT JOIN ' . $tableName . ' ';
        return $this;
    }
    
    public function fullOuterJoin($tableName)
    {
        $this->sqlQuery .= ' FULL OUTER JOIN ' . $tableName . ' ';
        return $this;
    }

    public function orderBy($condition, $sort = 'ASC')
    {
        $this->sqlQuery .= ' ORDER BY ' . $condition . ' ' . $sort . ' ';
        return $this;
    }
    public function groupBy($condition)
    {
        $this->sqlQuery .= ' GROUP BY ' . $condition . ' ';
        return $this;
    }
    
    public function on($table1, $table2)
    {
        $this->sqlQuery .= ' ON ' . $table1 . ' = ' . $table2 . ' '; 
        return $this;
    }

    public function get()
    {
        $this->connect();
        return $this->conn->query($this->sqlQuery);
    }
    public function getSql()
    {
        return $this->sqlQuery;
    }
}
