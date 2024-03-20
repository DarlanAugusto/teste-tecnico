<?php

namespace App\Models;

use App\Db\Database;

class Produto extends Model {

    public ?int $idprodutos;

    public string $prod_descricao;
    
    public string $prod_cod_barras;
    
    public float $prod_preco_venda;
    
    public float $prod_peso_bruto;
    
    public float $prod_peso_liquido;

    public function __construct() {
        $this->table = 'produtos';
        $this->db = new Database($this->table);
        $this->class = self::class;
    }

    public function create()
    {
        $this->idprodutos = $this->insert([
            'prod_descricao'    => $this->prod_descricao,
            'prod_cod_barras'   => $this->prod_cod_barras,
            'prod_preco_venda'  => $this->prod_preco_venda,
            'prod_peso_bruto'   => $this->prod_peso_bruto,
            'prod_peso_liquido' => $this->prod_peso_liquido
        ]);

    }

    public function save()
    {
        return $this->update([
            'prod_descricao'    => $this->prod_descricao,
            'prod_cod_barras'   => $this->prod_cod_barras,
            'prod_preco_venda'  => $this->prod_preco_venda,
            'prod_peso_bruto'   => $this->prod_peso_bruto,
            'prod_peso_liquido' => $this->prod_peso_liquido
        ], $this->idprodutos);
    }

    public function destroy()
    {
        return $this->delete($this->idprodutos);
    }

}