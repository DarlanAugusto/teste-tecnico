<?php

namespace App\Http;

use App\Utils\View;

class Response {
    public static function notFound()
    {
        return View::render('errors.not-found');
    }

    public static function notAllowed()
    {
        return View::render('errors.not-allowed');
    }

    public static function json($data = [])
    {
        echo json_encode($data);
    }
}