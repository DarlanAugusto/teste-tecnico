<?php

namespace App\Models;

use App\Db\Database;

class Cliente extends Model {

    public ?int $idclientes;

    public string $cli_razao_social;
    
    public string $cli_nome_fantasia;
    
    public string $cli_documento;
    
    public string $cli_endereco;
    
    public function __construct() {
        $this->table = 'clientes';
        $this->db = new Database($this->table);
        $this->class = self::class;
    }

    public function create()
    {
        $this->idclientes = $this->insert([
            'cli_razao_social' => $this->cli_razao_social,
            'cli_nome_fantasia' => $this->cli_nome_fantasia,
            'cli_documento' => $this->cli_documento,
            'cli_endereco' => $this->cli_endereco
        ]);

    }

    public function save()
    {
        return $this->update([
            'cli_razao_social' => $this->cli_razao_social,
            'cli_nome_fantasia' => $this->cli_nome_fantasia,
            'cli_documento' => $this->cli_documento,
            'cli_endereco' => $this->cli_endereco
        ], $this->idclientes);
    }

    public function destroy()
    {
        return $this->delete($this->idclientes);
    }

}