<?php

namespace App\Controllers;

use App\Utils\View;

class HomeController {
    public static function index()
    {
        return View::render('home');
    }
}