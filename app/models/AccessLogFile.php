<?php

namespace App\Models;

use App\Kernel\Model;
use App\Helpers;

class AccessLogFile extends Model
{
    /**
     * @var resource|null Указатель на текущий файл
     */
    private $_logFileDescriptor = null;
    private ?string $_currentLogLine = '';
    
    /**
     * Открытваем файл $fileName
     * @param  string $fileName Полное имя файла
     * @return bool             Результат откртыия true - успешно, false - ошибка
     */
    public function isFileExists(string $fileName): bool{
        $fileIsExists = Helpers\FileService::isFileExists($fileName);
        return (bool)$fileIsExists;
    }

    /**
     * Открытваем файл $fileName
     * @param  string $fileName Полное имя файла
     * @return void
     */
    public function openFile(string $fileName): void{
        $this->_logFileDescriptor = Helpers\FileService::openFile($fileName, "r");
    }

    /**
     * Проверка, открыт ли файл
     * @return bool Если true - открыт, иначе нет.
     */
    public function isFileOpen(): bool{
        return $this->_logFileDescriptor === null ? false : true;
    }

    /**
     * Доступно ли чтение файла с логами
     * @return boolean  Результат проверки true - доступен, false - достигнут конец
     */
    public function canBeRead(): bool{
        return Helpers\FileService::isReachedEOF($this->_logFileDescriptor) ? false : true;
    }

    /**
     * Чтение строки файла. Указатель передвигатеся на следующую строку.
     * @return AccessLogFile     Тукущее состояние объекта AccessLogFile
     */
    public function readNextLine(): AccessLogFile{
        $this->_currentLogLine = Helpers\FileService::readLine($this->_logFileDescriptor);
        return $this;
    }

    /**
     * Getter текущей записи лога в текстовом формате
     * @return string     Тукущая запись файла логов
     */
    public function logLineToText(): ?string{
        return $this->_currentLogLine !== '' ? $this->_currentLogLine : null;
    }

    /**
     * Getter текущей записи лога в виде ассоциативного массива
     * @return array     Тукущая запись файла логов
     */
    public function logLineToArray(): array{
        $result = [];

        if($this->_currentLogLine !== ''){

            $pattern = '/(\S+) (\S+) (\S+) \[(.+?)\] \"(\S+) (.*?) (\S+)\" (\S+) (\S+) \"(.*?)\" \"(.*?)\"/';
            
            $logLineParameters = Helpers\RegExpService::splitByPattern($pattern, $this->_currentLogLine);

            if( count($logLineParameters) === 12 ){
                $result['ip']       = $logLineParameters[1];
                $result['identity'] = $logLineParameters[2];
                $result['user']     = $logLineParameters[3];
                $result['date']     = $logLineParameters[4];
                $result['method']   = $logLineParameters[5];
                $result['path']     = $logLineParameters[6];
                $result['protocol'] = $logLineParameters[7];
                $result['status']   = $logLineParameters[8];
                $result['bytes']    = $logLineParameters[9];
                $result['referer']  = $logLineParameters[10];
                $result['agent']    = $logLineParameters[11];
            }
        }

        return $result;
    }



    /**
     * Закрывает соединение с файлом
     */
    public function __destruct(){
        Helpers\FileService::closeFile($this->_logFileDescriptor);
    }
}