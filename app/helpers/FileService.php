<?php

namespace App\Helpers;

class FileService
{   
    /**
     * Проверяет существование указанного файла или каталога
     * @param  string $filename Полное имя файла
     * @return bool             Возвращает true, если файл или каталог существует, иначе false
     */
    public static function isFileExists(string $filename): bool{
        return (bool)file_exists($filename);
    }

    /**
     * Открывает новый файл
     * @param string $filename  Полное имя файла
     * @param string $mode      Тип доступа
     * @return resource|null    Указатель на открытый файл
     */
    public static function openFile(string $filename, string $mode){
        $fileDescriptor = fopen($filename,$mode);
        return $fileDescriptor === false ? null : $fileDescriptor;
    }


    /**
     * Чтение строки из файла
     * @param resource|null $fileDescriptor  Указатель на открытый файл
     * @return string                   Прочитанная строка в случае успеха
     */
    public static function readLine($fileDescriptor): ?string{
        
        if (feof($fileDescriptor)){
            return null;
        }

        $char = '';
        $line = '';

        while (!feof($fileDescriptor) && $char != "\n") {
            $char = fread($fileDescriptor, 1);
            $line .= $char;
        }

        return rtrim($line, "\n");
    }


    /**
     * Закрытие файла
     * @param resource|null $fileDescriptor Указатель на открытый файл
     * @return void
     */
    public static function closeFile($fileDescriptor): void{
        if (is_resource($fileDescriptor)){
            fclose($fileDescriptor);
        }
    }

    /**
     * Проверят достигнут ли конец файла
     * @param resource|null $fileDescriptor Указатель на открытый файл
     * @return bool                     true - если конец файла или нет файла вовсе
     */
    public static function isReachedEOF($fileDescriptor): bool{

        $result = is_resource($fileDescriptor) ? feof($fileDescriptor) : true;

        return (bool)$result;
    }
}