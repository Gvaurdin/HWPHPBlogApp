<?php

namespace App\Blog\views;

class Layout
{
    public static function render($content): void
    {
        // Начало HTML-шаблона
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Video Blog Free Template</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    
    <!-- Дополнительные стили для IE -->
    <!--[if IE 6]>
    <link rel="stylesheet" type="text/css" href="/src/css/style6.css"/>
    <![endif]-->
    <!--[if IE 7]>
    <link href="../css/style7.css" rel="stylesheet" type="text/css">
    <![endif]-->
    
    <style type="text/css">
        /* Стили для поддержки прозрачных PNG в IE */
        img, div, input { behavior: url("/public/assets/iepngfix.htc") }
    </style>
    
    <script type="text/javascript">
        // Если необходимо добавить дополнительные скрипты для старых версий IE
        // Пример обработки PNG изображений в старых браузерах
        // Дополнительный JavaScript для старых версий IE можно оставить здесь.
    </script>
</head>
<body>';

        // Здесь выводим переданный контент (страницу)
        echo $content;

        // Закрытие основного шаблона
        echo '</body></html>';
    }
}
