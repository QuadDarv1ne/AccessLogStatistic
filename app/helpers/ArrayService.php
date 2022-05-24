<?php

namespace App\Helpers;

class ArrayService
{   
    /**
     * Проверка наличия строки в массиве
     * @param  string       $needle   искомое значение
     * @param  array        $haystack массив в котором ищем
     * @param  bool         $strict   соответствие типов
     * @return bool                   true - если найден, false - если нет
     */
    public static function inArray(string $needle , array $haystack, bool $strict = FALSE): bool{   
        $result = in_array($needle,$haystack,$strict);
        
        return (bool)$result;
    }
}