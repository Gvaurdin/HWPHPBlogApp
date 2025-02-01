<?php

namespace App\Blog\cookies;

class VisitCounter
{
    private static string $cookieName = 'visitCount';
    private static string $sessionKey = 'visitCountUpdated';

    public static function getVisitCount(): int
    {
        return isset($_COOKIE[self::$cookieName]) ? intval($_COOKIE[self::$cookieName]) : 0;
    }

    public static function updateVisitCount(string $login): void
    {
        // проверяем, обновлялась ли кука в этой сессии
        if (!isset($_SESSION[self::$sessionKey])) {
            // если куки нет, создаем ее с новым значением
            if (!isset($_COOKIE[self::$cookieName . $login])) {
                $count = 1;
            } else {
                $count = intval($_COOKIE[self::$cookieName . $login]) + 1; // увеличиваем счетчик, если кука уже существует
            }

            // Устанавливаем или обновляем кук с новым значением
            setcookie(self::$cookieName . $login, $count, time() + (365 * 24 * 60 * 60), "/");
            $_SESSION[self::$sessionKey] = true; // Отмечаем, что кука обновлена
        }
    }
}