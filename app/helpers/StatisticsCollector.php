<?php

namespace App\Helpers;

class StatisticsCollector
{   
    /**
     * Статистика
     * @var array
     */
    private array $_statistic = [
        'views' => 0,
        'urls' => 0,
        'traffic' => 0,
        'crawlers' => [
            'Google' => 0,
            'Bing' => 0,
            'Baidu' => 0,
            'Yandex' => 0,
        ],
        'statusCodes' => [],
    ];

    /**
     * Коллекция уникальных url из лога запросов
     * @var array
     */
    private array $_uniqueUrls = [];


    /**
     * добавляем новые просмотры
     */
    public function addView(): StatisticsCollector{
        $this->_statistic['views']++;
        return $this;
    }

    /**
     * Сбор количества уникальных urls
     * @param string $url  Строка url
     */
    public function addUrl(string $url): StatisticsCollector{
        
        if( !ArrayService::inArray($url,$this->_uniqueUrls) ){
            $this->_uniqueUrls[] = $url;
            $this->_statistic['urls'] = count($this->_uniqueUrls);
        }

        return $this;
    }

    /**
     * Накопление траффика
     * @param int $traffic  Количество переданных бит трафика
     */
    public function addTraffic(int $traffic): StatisticsCollector{
        $this->_statistic['traffic'] += $traffic;

        return $this;
    }

    /**
     * Добавляем поисковые боты к статистике
     * @param string $agent  User agent
     */
    public function addCrawler(string $agent): StatisticsCollector{
        
        $botName = BotService::botName($agent);

        if( $botName !== null && isset($this->_statistic['crawlers'][$botName])) {
            $this->_statistic['crawlers'][$botName]++;
        }

        return $this;
    }

    /**
     * Добавляем коды статусов запросов
     * @param string $statusCode  Код статуса
     */
    public function addStatusCode(string $statusCode): StatisticsCollector{
        if( $statusCode !== ''){
            if( isset($this->_statistic['statusCodes'][$statusCode]) ){
                $this->_statistic['statusCodes'][$statusCode]++;
            }else{
                $this->_statistic['statusCodes'][$statusCode] = 1;
            }
        }

        return $this;
    }

    /**
     * Getter статистики
     * @return array накопленная статистика
     */
    public function statistics(): array{
        return $this->_statistic;
    }
}