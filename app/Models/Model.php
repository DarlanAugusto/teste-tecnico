<?php

namespace App\Models;

use App\Db\Database;
use App\Http\Response;
use PDO;

class Model {

    protected string $table;
    protected Database $db;
    protected $class;
    public $res;

    public function insert($data) {
        return $this->db->insert($data);
    }

    public function all()
    {
        return $this->db->select()->fetchAll(PDO::FETCH_CLASS, $this->class);
    }

    public function find($id)
    {
        $this->res = $this->db->getById($id)->fetchAll(PDO::FETCH_CLASS, $this->class)[0];

        if(!$this->res instanceof $this->class) {
            return Response::notFound();
        }

        return $this->res;
    }
    
    public function where($where = '')
    {
        $this->res = $this->db->select('*', $where)->fetchAll(PDO::FETCH_CLASS, $this->class);
        return $this->res;
    }

    public function update($data, $id)
    {
        return $this->db->update($data, $id);
    }

    public function delete($id)
    {
        return $this->db->delete($id);
    }

    public function first()
    {
        return $this->res[0];
    }

}