<?php

namespace App\Helpers;

class StringService
{   
    /**
     * Возвращает подстроку
     * @param  string   $string Входная строка.
     * @param  int      $start  возвращаемая подстрока начинается с позиции start
     * @param  int|null $length возвращаемая строка будет не длиннее length, если length отрицательный, то будет отброшено указанное этим аргументом число символов с конца строки
     * @return string           Возвращает подстроку строки string
     */
    public static function substr(string $string , int $start, int $length = null): ?string{   
        
        $result = is_null($length) ? substr($string, $start) : substr($string, $start, $length);

        return $result === false ? null : $result;
    }

    /**
     * Возвращает позицию последнего вхождения подстроки в строке
     * @param  string   $string  Входная строка.
     * @param  string   $needle  Искомая подстрока
     * @param  int|null $offset  Если равно или больше ноля, то поиск будет идти слева направо и, при этом, будут пропущены первые offset байт строки. Если меньше ноля, то поиск будет идти справа налево. При этом будут отброшены offset байт с конца
     * @return int               Возвращает номер позиции последнего вхождения needle относительно начала строки
     */
    public static function strrpos (string $string , string $needle, int $offset = null): ?int{   
        
        $result = is_null($offset) ? strrpos($string, $needle) : strrpos($string, $needle, $offset);

        return $result === false ? null : $result;
    }
}