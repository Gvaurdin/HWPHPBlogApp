<?php

namespace App\Blog\utils;
use App\Blog\Helpers as Helpers;
class Utils
{
    public static function getInput(string $prompt, string $errorMessage): string
    {
        echo $prompt;
        $input = trim(readline());

        if(empty($input)) {
            echo Helpers::errorHandle($errorMessage);
        }

        return $input;
    }

// среда разработки сама подсказала создать метод принта, класс!
    /**
     * @param array $result
     * @param string $output
     * @return string
     */
    public static function printPost(array $result, string $output): string
    {
        foreach ($result as $post) {
            $output .= "-----------------------------" . PHP_EOL;
            $output .= "Заголовок: " . htmlspecialchars($post['post_title']) . PHP_EOL;
            $output .= "Текст поста: " . htmlspecialchars($post['post_text']) . PHP_EOL;
            $output .= "Автор: " . htmlspecialchars($post['user_name']) . " " . htmlspecialchars($post['user_surname']) . PHP_EOL;
            $output .= "ID: " . htmlspecialchars($post['post_id']) . PHP_EOL;
            $output .= "-----------------------------" . PHP_EOL;
        }
        return $output;
    }

    public static function renderTemplate($template, $params= [])
    {
        // определяем путь к шаблону
        $templatePath = __DIR__ . "/../../public/views/{$template}.php";

        // проверяем, существует ли файл шаблона
        if (!file_exists($templatePath)) {
            die("Ошибка: шаблон {$template} не найден в {$templatePath}");
        }

        // извлекаем переменные из массива $params
        extract($params);

        // включаем буферизацию вывода
        /*Буферизация вывода в PHP используется для временного хранения (буферизации)
        контента перед его отправкой в браузер.
        Это позволяет манипулировать содержимым перед окончательным выводом.
         * */
        ob_start();

        // подключаем шаблон
        include $templatePath;

        // получаем содержимое буфера и очищаем его
        return ob_get_clean();
    }
}
