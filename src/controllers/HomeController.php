<?php

namespace App\Blog\controllers;

use App\Blog\cookies\VisitCounter;
use App\Blog\Helpers;

class HomeController  extends Controller
{

    public function actionIndex()
    {

        $message = $_SESSION['message'] ?? null;
        $_SESSION['message'] = null;
        $posts = [
            [
                'id' => 1,
                'title' => 'Солянка',
                'text' => 'Секрет варки вкусной СОЛЯНКИ. Хочу поделиться с вами несколькими секретами при приготовлении вкусной солянки. Этими секретами со мной поделился один очень хороший человек, ресторанный критик Игорь. Когда мой сын попробовал приготовленную солянку, то сразу сказал: "Вот это я понимаю, солянка настоящая!"',
                'image' => 'https://www.povarenok.ru/data/cache/2013jul/09/13/468801_66669-330x220x.jpg',
                'comments' => 222
            ],
            [
                'id' => 2,
                'title' => 'Суп-пюре из кабачков',
                'text' => 'Все, кому приходилось у меня впервые попробовать этот супчик, делали разные предположения, из чего же он приготовлен, большинство заявляло, что суп с грибами, но никто не мог представить, что суп из кабачков. Не верите? Очень рекомендую приготовить такой суп, угостить своe окружение и провести соцопрос.',
                'image' => 'https://www.povarenok.ru/images/recipes/44/4451/445180.jpg',
                'comments' => 121
            ]
        ];
        echo $this->render('home/index', [
            'posts' => $posts,
            'message' => $message,
        ]);
    }

}