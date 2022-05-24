<?php

namespace App\Helpers;

class RegExpService
{   
    /**
     * Разбивает строку на массив по шаблону
     * @param  string $pattern  Шаблон поиска
     * @param  string $subject  Входная строка
     * @return array            Рузультат поиска шаблона в строке
     */
    public static function splitByPattern(string $pattern , string $subject): array{

        $patternIsMatchesSubject = preg_match ($pattern, $subject, $matches);

        return $patternIsMatchesSubject === 1 ? $matches : [];
    }
}