<?php

namespace App\Blog\views;

class Posts
{
    public function render(array $posts): void
    {
        ob_start(); // начинаем буферизацию вывода
        echo "<h1>Welcome to the posts page</h1>";

        if(empty($posts))
        {
            echo "<p>There are no posts</p>";
            return;
        }

        foreach ($posts as $post)
        {
            echo "<div class='post'>";
            echo "<h2>" . htmlspecialchars($post['title']) . "</h2>";
            echo "<p>" . nl2br(htmlspecialchars($post['text'])) . "</p>";
            echo "<p>" ."ID author: " . htmlspecialchars($post['id_user']) . "</p>";
            echo "</div>";
        }

        // получаем буферизированный контент
        $content = ob_get_clean();

        // подключаем основной шаблон и передаем контент страницы
        Layout::render($content);
    }

    public function renderPost($post): void
    {
        ob_start(); // начинаем буферизацию вывода


//        echo "<div class='post'>";
//        echo "<h2>" . htmlspecialchars($post['title']) . "</h2>";
//        echo "<p>" . nl2br(htmlspecialchars($post['text'])) . "</p>";
//        echo "<p>" ."ID author: " . htmlspecialchars($post['id_user']) . "</p>";
//        echo "</div>";

        echo $post;


        // получаем буферизированный контент
        $content = ob_get_clean();

        // подключаем основной шаблон и передаем контент страницы
        Layout::render($content);
    }

}
