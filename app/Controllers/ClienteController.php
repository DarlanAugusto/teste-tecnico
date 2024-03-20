<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Cliente;
use App\Utils\Number;
use App\Utils\View;

class ClienteController {
    public static function index(Request $request)
    {
        $clientes = (new Cliente)->all();

        return View::render('clientes.index', [
            'clientes' => $clientes
        ]);
    }

    public static function showApi(Request $request, $id)
    {
        $cliente = (new Cliente)->find($id);

        return Response::json($cliente);
    }

    public static function create(Request $request)
    {
        return View::render('clientes.edit', [
            'title' => 'Novo Cliente'
        ]);
    }

    public static function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->cli_razao_social = $request->get('cli_razao_social');
        $cliente->cli_nome_fantasia = $request->get('cli_nome_fantasia');
        $cliente->cli_documento = $request->get('cli_documento');
        $cliente->cli_endereco = $request->get('cli_endereco');
        $cliente->create();
        
        if($cliente->idclientes) {
            return View::render('clientes.edit', [
                'title' => 'Editar - ' . $cliente->cli_nome_fantasia,
                'cliente' => $cliente,
                'msg' => "Cliente cadastrado com sucesso!"
            ]);
        }
    }

    public static function edit(Request $request, $id)
    {
        $cliente = (new Cliente)->find($id);

        return View::render('clientes.edit', [
            'title' => 'Editar - ' . $cliente->cli_nome_fantasia,
            'cliente' => $cliente
        ]);
    }

    public static function update(Request $request, $id)
    {
        $cliente = (new Cliente)->find($id);
        $cliente->cli_razao_social = $request->get('cli_razao_social');
        $cliente->cli_nome_fantasia = $request->get('cli_nome_fantasia');
        $cliente->cli_documento = $request->get('cli_documento');
        $cliente->cli_endereco = $request->get('cli_endereco');

        if($cliente->save()) {
            return View::render('clientes.edit', [
                'title' => 'Editar - ' . $cliente->cli_nome_fantasia,
                'cliente' => $cliente,
                'msg' => "Cliente <b>{$cliente->idclientes}</b> atualizado com sucesso!"
            ]);

        }
    }

    public static function destroy(Request $request, $id)
    {
        $cliente = (new Cliente)->find($id);
        
        if($cliente->destroy()) {
            
            $clientes = (new Cliente)->all();

            return View::render('clientes.index', [
                'title' => 'clientes',
                'clientes' => $clientes,
                'msg' => "Cliente <b>{$cliente->idclientes}</b> excluido com sucesso!"
            ]);
        }
    }
}