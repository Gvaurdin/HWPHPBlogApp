<?php

namespace App\Blog\core;

use App\Blog\interfaces\IRender;

class Render implements IRender
{

    public function renderTemplate($template, $params = []): bool|string
    {
        ob_start();
        extract($params);
        include '../src/views/' . $template . ".php";
        return ob_get_clean();
    }
}