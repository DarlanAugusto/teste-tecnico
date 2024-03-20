<?php

namespace App\Models;

use App\Db\Database;

class User extends Model {

    public ?int $idusuarios;

    public string $user_login;

    public string $user_nome;

    public string $user_senha;

    public function __construct() {
        $this->table = 'usuarios';
        $this->db = new Database($this->table);
        $this->class = self::class;
    }

    public function create()
    {
        $this->idusuarios = $this->insert([
            'user_login'  => $this->user_login,
            'user_nome'   => $this->user_nome,
            'user_senha'  => $this->user_senha
        ]);

    }

    public function destroy()
    {
        return $this->delete($this->idusuarios);
    }

}