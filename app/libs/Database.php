<?php
namespace App\Libs;

class Database
{
    private $conn;
    private $sqlQuery = '';
    private $error = [];
    private $parameters = 0;
    private $values = 0;

    public function connect()
    {
        global $server;
        global $user;
        global $password;
        global $database;
        $this->conn = mysqli_connect($server, $user, $password, $database);

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
                if ($i == 0) {
                    $this->sqlQuery .= 'SELECT `' . $column . '`';
                } else {
                    $this->sqlQuery .= '`'.$column . '` ';
                    
                }
                $i++;
                if ($i < count($columns)) { 
                    $this->sqlQuery .= ', ';
                }
                
            }
        }
       
        return $this;
    }

    public function insert($tableName)
    {
        $this->sqlQuery .= 'INSERT INTO `' . $tableName . '` ';
        return $this;
    }

    public function delete()
    {
        $this->sqlQuery .= 'DELETE ' ;
        return $this;
    }   
    
    public function update($tableName)
    {
        $this->sqlQuery .= 'UPDATE `' . $tableName . '` ';
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
        foreach ($values as $key => $value) {
            $this->sqlQuery .= ' '. $key . ' = \'' . $value . '\' ';
            $i++;
            if ($i < count($values)){
                $this->sqlQuery .= ', ';
            }
            
        }
        return $this;
    }

    public function where($columnValue, $value, $operator = '=')
    {
        $this->sqlQuery .= 'WHERE `' . $columnValue . '` ' . $operator  . ' \'' . $value . '\' ';
        return $this;
    }

    public function whereAnd($columnValue, $value, $operator = '=')
    {
        $this->sqlQuery .= ' AND `' . $columnValue . '` ' . $operator  . ' \'' . $value . '\' ';
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
                $i++;
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
                $i++;
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
            $this->sqlQuery .= ' `' . $parameter.'`';
            $i++;
            if ($i < count($parameters)){
                $this->sqlQuery .= ', ';
            }
        }
        $this->sqlQuery .= ') ';
        return $this;
        
    }
    public function values($values)
    {
        if ($this->parameters <> count($values)){
            $this->error[] = ' SQL parameters amount is not equal to Values amount';
        }

        if (!is_array($values)){
            $values = (array) $values;
        }
        $this->values = count($values);
        $this->sqlQuery .= ' VALUES (';
        $i = 0;
        foreach ($values as $value) {
            $this->sqlQuery .= ' \'' . $value.'\'';
            $i++;
            if ($i < count($values)){
                $this->sqlQuery .= ', ';
            }

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

    public function orderBy($condition='id', $sort = 'ASC')
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

    public function lastID()
    {
        return $this->conn->insert_id;
    }
    
    public function getSql()
    {
        return $this->sqlQuery;
    }

    public function escape($string){
        $this->connect();
        $saveString = mysqli_real_escape_string($this->conn,$string);
        mysqli_close($this->conn);
        return $saveString;
    }

    public function execute()
    {
        $this->connect();
        $query = $this->sqlQuery;
        $this->sqlQuery = null;
        return $this->conn->query($query);
    }    
}
