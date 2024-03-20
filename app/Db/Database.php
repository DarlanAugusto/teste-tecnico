<?php

namespace App\Db;

use App\Models\Model;
use PDO;
use PDOException;

class Database {
    const DB_HOST = 'localhost\SQLEXPRESS';

    const DB_DRIVER = 'sqlsrv';

    const DB_NAME = 'softline';

    const DB_USER = '';

    const DB_PASS = '';

    private string $table;

    private PDO $connection;

    public function __construct($table = null) 
    {
        $this->table = $table;
        $this->setConnection();
    }

    public function setConnection()
    {
        try {

            $this->connection = new PDO(self::DB_DRIVER . ":Server=" . self::DB_HOST . ";Database=" . self::DB_NAME, self::DB_USER, self::DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
        
            die('ERROR: ' . $e->getMessage());
        
        }
    }

    public function execute($query, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);

            return $stmt;

        } catch (PDOException $e) {
        
            die('ERROR: ' . $e->getMessage());
        
        }
    }

    public function insert($data)
    {
        $fields = array_keys($data);
        $binds = array_pad([], count($fields), '?');

        $fields = implode(", ", $fields);
        $binds = implode(", ", $binds);

        $query = "INSERT INTO {$this->table} ({$fields}) VALUES ({$binds})";

        $this->execute($query, array_values($data));

        return $this->connection->lastInsertId();
    }

    public function update($data, $id)
    {
        $fields = array_keys($data);
        $fields = implode(" = ?, ", $fields) . ' = ?';

        $query = "UPDATE {$this->table} SET {$fields} WHERE id{$this->table} = {$id}";

        $this->execute($query, array_values($data));

        return true;
    }

    public function select($fields = '*', $where = '')
    {
        $where = !empty($where) ? ' WHERE ' . $where : '';

        $query = "SELECT {$fields} FROM {$this->table} {$where}";

        return $this->execute($query);
    
    }

    public function getById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id{$this->table} = {$id}";

        return $this->execute($query);
    }

    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id{$this->table} = {$id}";
    
        $this->execute($query);

        return true;
    }
}