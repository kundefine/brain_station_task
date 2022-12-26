<?php

include './config.php';

class DB
{
    private $conn;
    public $query;
    public $table = "";
    public $select = [];
    private $where = [];
    private $join = "";
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . HOST .";dbname=". DB_NAME, DB_USER, DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            echo "<br>";
            echo "please check details in config.php";
        }
    }

    public function query($query) {
        $this->query = $query;
        return $this;
    }

    public function table($table) {
        $this->table = $table;
        return $this;
    }

    public function all()
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public function where($column, $exp, $value)
    {
        $this->where[] = $column . " " . $exp . " " . $value;
        return $this;
    }

    public function select(array $column)
    {
        $this->select = $column;
    }

    public function count()
    {
        $where = $this->parseWhere();
        $stmt = $this->conn->query("SELECT COUNT(*) as count FROM " . $this->table . $where);
        return $stmt->fetchColumn();
    }

    public function parseWhere()
    {
        $normalizeWhere = "";
        if(count($this->where)) {
            $normalizeWhere = " WHERE ";
        }
        for ($i = 0; $i < count($this->where); $i++) {
            if($i == (count($this->where) - 1)) {
                $normalizeWhere .= $this->where[$i];
            } else {
                $normalizeWhere .= $this->where[$i] . " AND ";
            }
        }
        return $normalizeWhere;
    }

    public function getWhere()
    {
        return $this->where;
    }

    public function join($table, $col1, $condition, $col2)
    {
        $this->join = " JOIN {$table} ON {$col1} {$condition} {$col2} ";
        return $this;
    }

    public function get(array $cols = [])
    {
        $columns = count($cols) ? implode(",", $cols)  : "*";

        $where = $this->parseWhere();
        $query = "SELECT ". $columns ." FROM";
        if($this->query) $query = $this ->query;
        $stmt = $this->conn->query($query . " " . $this->table . " " . $this->join . " " . $where);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

}

$db = new DB();