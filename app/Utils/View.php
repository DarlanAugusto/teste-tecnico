<?php

namespace App\Utils;

use App\Http\Response;

class View {

    public static function render($view, $params = [])
    {
        $replacedView = str_replace('.', '/', $view);
        
        if(!file_exists(__DIR__ . "/../../resources/views/$replacedView.php")) {

            return Response::notFound();
        }

        extract($params);

        include(__DIR__ . "/../../resources/views/$replacedView.php");
        die;
    }
}