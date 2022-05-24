<?php

namespace App\Controllers;

use App\Kernel\Controller;
use App\Helpers\StatisticsCollector;
use App\Models\AccessLogFile;

class MainController extends Controller
{
    /**
     * @var AccessLogFile Объект, содержащий свойства и методы по работе с файлом access.log
     */
    private AccessLogFile $_accessLogFile;
    /**
     * @var StatisticsCollector Сборщик статистики
     */
    private StatisticsCollector $_statisticsCollector;

    public function __construct()
    {
        parent::__construct();

        $this->_accessLogFile = new AccessLogFile();
        $this->_statisticsCollector = new StatisticsCollector();
    }

    public  function index(){

        if( array_key_exists('argv',$_SERVER) && array_key_exists(1,$_SERVER['argv'])){
            $accessLogFilePath = $_SERVER['argv'][1];
        }else{
            return $this->_response->json(['Error' => 'Invalid file path']);
        }   


        if($this->_accessLogFile->isFileExists($accessLogFilePath)){
            $this->_accessLogFile->openFile($accessLogFilePath);
        }else{
            return $this->_response->json(['Error' => 'File not found']);
        }

        if(!$this->_accessLogFile->isFileOpen()){
            return $this->_response->json(['Error' => 'File did not open']);
        }

        while ( $this->_accessLogFile->canBeRead() ) {
        	$currentLogEntry = $this->_accessLogFile->readNextLine()->logLineToArray();
           
            if(count($currentLogEntry) > 0){
                $this->_statisticsCollector
                    ->addView()
                    ->addUrl($currentLogEntry['path'])
                    ->addCrawler($currentLogEntry['agent'])
                    ->addStatusCode($currentLogEntry['status']);

                if( (int)$currentLogEntry['status'] < 300 || (int)$currentLogEntry['status'] >= 400 ){
                    $this->_statisticsCollector->addTraffic($currentLogEntry['bytes']);
                }
            }
        }
        
        $statistics = $this->_statisticsCollector->statistics();

        return $this->_response->json($statistics);
    }
}