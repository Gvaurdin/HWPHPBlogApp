<?php

namespace App\Blog\interfaces;

interface IRender
{
    public function renderTemplate($template, $params = []);
}