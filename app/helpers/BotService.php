<?php

namespace App\Helpers;

class BotService
{   
    /**
     * Список ключей ботов
     * @var array
     */
    private static array $_bots = [
        'Google' => [
            'Googlebot', 'Googlebot-Image', 'Mediapartners-Google', 'AdsBot-Google', 'APIs-Google',
            'AdsBot-Google-Mobile', 'AdsBot-Google-Mobile', 'Googlebot-News', 'Googlebot-Video',
            'AdsBot-Google-Mobile-Apps',
        ],
        'Yandex' => [
            'YandexBot', 'YandexAccessibilityBot', 'YandexMobileBot', 'YandexDirectDyn', 'YandexScreenshotBot',
            'YandexImages', 'YandexVideo', 'YandexVideoParser', 'YandexMedia', 'YandexBlogs', 'YandexFavicons',
            'YandexWebmaster', 'YandexPagechecker', 'YandexImageResizer', 'YandexAdNet', 'YandexDirect',
            'YaDirectFetcher', 'YandexCalendar', 'YandexSitelinks', 'YandexMetrika', 'YandexNews',
            'YandexNewslinks', 'YandexCatalog', 'YandexAntivirus', 'YandexMarket', 'YandexVertis',
            'YandexForDomain', 'YandexSpravBot', 'YandexSearchShop', 'YandexMedianaBot', 'YandexOntoDB',
            'YandexOntoDBAPI', 'YandexTurbo', 'YandexVerticals',
        ],
        'Bing' => [
            'bingbot',
        ],
        'Baidu' => [
            'Baiduspider',
        ],
        'Other' => [
            'Mail.RU_Bot', 'Accoona', 'ia_archiver', 'Ask Jeeves', 'OmniExplorer_Bot', 'W3C_Validator',
            'WebAlta', 'YahooFeedSeeker', 'Yahoo!', 'Ezooms', 'Tourlentabot', 'MJ12bot', 'AhrefsBot',
            'SearchBot', 'SiteStatus', 'Nigma.ru', 'Statsbot', 'SISTRIX', 'AcoonBot', 'findlinks',
            'proximic', 'OpenindexSpider', 'statdom.ru', 'Exabot', 'Spider', 'SeznamBot', 'oBot', 'C-T bot',
            'Updownerbot', 'Snoopy', 'heritrix', 'Yeti', 'DomainVader', 'DCPbot', 'PaperLiBot', 'StackRambler',
            'msnbot', 'msnbot-media', 'msnbot-news',
        ],
    ];

    /**
     * Получаем наименование поискового Бота
     * @param  string $user_agent user_agent
     * @return string             Наименование бота
     */
    public static function botName(string $user_agent): ?string{   
        
        if($user_agent === ''){
            return null;
        }

        foreach (self::$_bots as $botName => $botKeys) {
            foreach ($botKeys as $botKey) {
                if (StringService::strrpos($user_agent, $botKey) !== null) {
                    return $botName;
                }
            }
        }

        return null;
    }
}