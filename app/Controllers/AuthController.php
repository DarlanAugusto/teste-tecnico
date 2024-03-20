<?php

namespace App\Controllers;

use App\Http\Request;
use App\Models\User;
use App\Utils\View;

class AuthController {
    public static function login(Request $request)
    {
        if(self::isLoggedIn()) {
            return header('Location: /');
        }

        return View::render('auth.login');
    }

    public static function loginDo(Request $request)
    {
        $user = new User();
        $user->where("user_login = '{$request->get('user_login')}'");

        if(!password_verify($request->get('password'), $user->first()->user_senha)) {
            return View::render('auth.login', [
                'err' => "Credenciais Inválidas!",
                'request' => $request
            ]);
        }

        $user = (new User)->find($user->first()->idusuarios);

        $_SESSION['user']['idusuarios'] = $user->idusuarios;
        $_SESSION['user']['user_nome'] = $user->user_nome;

        return View::render('home', [
            'msg' => "Seja bem vindo {$user->user_nome}!"
        ]);
    }

    public static function register(Request $request)
    {
        if(self::isLoggedIn()) {
            return header('Location: /');
        }

        return View::render('auth.register');
    }

    public static function store(Request $request)
    {

        if($request->get('password') != $request->get('password_confirmation')) {
            return View::render('auth.register', [
                'err' => "As senhas devem ser iguais!",
                'request' => $request
            ]);
        }

        if(count( (new User)->where("user_login = '{$request->get('user_login')}'") ) > 0) {
            return View::render('auth.register', [
                'err' => "Usuário já existe!",
                'request' => $request
            ]);
        }

        $user = new User();
        $user->user_login = $request->get('user_login');
        $user->user_nome = $request->get('user_nome');
        $user->user_senha = password_hash($request->get('password'), PASSWORD_BCRYPT);
        $user->create();
        
        if($user->idusuarios) {

            $_SESSION['user']['idusuarios'] = $user->idusuarios;
            $_SESSION['user']['user_nome'] = $user->user_nome;

            return View::render('home', [
                'msg' => "Seja bem vindo {$user->user_nome}!"
            ]);
        }
    }

    public static function getUser()
    {
        $user = (new User)->find($_SESSION['user']['idusuarios']);

        return $user;
    }

    public static function isLoggedIn()
    {
        if(isset($_SESSION['user']['idusuarios'])) {
            return true;
        }

        return false;
    }

    public static function logout()
    {
        unset($_SESSION);
        session_destroy();

        return header('Location: /auth/login');
    }
}