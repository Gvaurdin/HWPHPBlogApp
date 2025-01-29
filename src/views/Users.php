<?php

namespace App\Blog\views;

class Users
{
    public function render(array $users): void
    {
        ob_start(); // начинаем буферизацию вывода
        echo "<h1>Welcome to the users page</h1>";

        if(empty($users))
        {
            echo "<p>There are no users</p>";
            return;
        }

        foreach ($users as $user)
        {
            echo "<div class='post'>";
            echo "<h2>" . htmlspecialchars($user['name']) . "</h2>";
            echo "<p>" . nl2br(htmlspecialchars($user['surname'])) . "</p>";
            echo "</div>";
        }

        // получаем буферизированный контент
        $content = ob_get_clean();

        // подключаем основной шаблон и передаем контент страницы
        Layout::render($content);
    }
}
