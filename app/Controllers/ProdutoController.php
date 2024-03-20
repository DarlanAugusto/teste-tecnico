<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Produto;
use App\Utils\Number;
use App\Utils\View;

class ProdutoController {
    public static function index(Request $request)
    {
        $produtos = (new Produto)->all();

        return View::render('produtos.index', [
            'produtos' => $produtos
        ]);
    }

    public static function show(Request $request, $id)
    {
        $produto = (new Produto)->find($id);

        echo '<pre>';
        print_r($produto);
        echo '<pre>';
        exit;
    }

    public static function showApi(Request $request, $id)
    {
        $produto = (new Produto)->find($id);

        return Response::json($produto);
    }

    public static function create(Request $request)
    {
        return View::render('produtos.edit', [
            'title' => 'Novo Produto'
        ]);
    }

    public static function store(Request $request)
    {
        $produto = new Produto();
        $produto->prod_descricao    = $request->get('prod_descricao');
        $produto->prod_cod_barras   = $request->get('prod_cod_barras');
        $produto->prod_preco_venda  = Number::strToFloat($request->get('prod_preco_venda'));
        $produto->prod_peso_bruto   = Number::strToFloat($request->get('prod_peso_bruto'), false);
        $produto->prod_peso_liquido = Number::strToFloat($request->get('prod_peso_liquido'), false);
        $produto->create();
        
        if($produto->idprodutos) {
            return View::render('produtos.edit', [
                'title' => 'Editar - ' . $produto->prod_descricao,
                'produto' => $produto,
                'msg' => "Produto cadastrado com sucesso!"
            ]);
        }
    }

    public static function edit(Request $request, $id)
    {
        $produto = (new Produto)->find($id);

        return View::render('produtos.edit', [
            'title' => 'Editar - ' . $produto->prod_descricao,
            'produto' => $produto
        ]);
    }

    public static function update(Request $request, $id)
    {
        $produto = (new Produto)->find($id);
        $produto->prod_descricao    = $request->get('prod_descricao');
        $produto->prod_cod_barras   = $request->get('prod_cod_barras');
        $produto->prod_preco_venda  = Number::strToFloat($request->get('prod_preco_venda'));
        $produto->prod_peso_bruto   = Number::strToFloat($request->get('prod_peso_bruto'), false);
        $produto->prod_peso_liquido = Number::strToFloat($request->get('prod_peso_liquido'), false);

        if($produto->save()) {
            return View::render('produtos.edit', [
                'title' => 'Editar - ' . $produto->prod_descricao,
                'produto' => $produto,
                'msg' => "Produto <b>{$produto->idprodutos}</b> atualizado com sucesso!"
            ]);

        }
    }

    public static function destroy(Request $request, $id)
    {
        $produto = (new Produto)->find($id);
        
        if($produto->destroy()) {
            
            $produtos = (new Produto)->all();

            return View::render('produtos.index', [
                'title' => 'Produtos',
                'produtos' => $produtos,
                'msg' => "Produto <b>{$produto->idprodutos}</b> excluido com sucesso!"
            ]);
        }
    }
}