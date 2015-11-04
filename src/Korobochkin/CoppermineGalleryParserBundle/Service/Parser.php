<?php
namespace Korobochkin\CoppermineGalleryParserBundle\Service;

use DOMElement;

//use Etki\SranyParserBundle\Service\Parser\Selectors;
//use Etki\SranyParserBundle\Service\Parser\Urls;
use GuzzleHttp\Client;
use Korobochkin\CoppermineGalleryParserBundle\Service\Parser\Selectors;
use Korobochkin\CoppermineGalleryParserBundle\Service\Parser\Urls;
use Monolog\Logger;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Validator\Constraints\Url;

class Parser
{

    private $logger;

    private $guzzle;

    public function  __construct(Client $client, Logger $logger)
    {
        $this->logger = $logger;
        $this->guzzle = $client;
    }

    public function run($url)
    {
        // TODO: Тут мы запускаем все из консоли, а что если надо будет из другого места?
        $url = parse_url($url);

        // Ищем тип страницы по $url
        // TODO: Как тут правильно вызывать UrlChecker (не думаю, что new ClassName прям тут это клево)?
        $urlChecker = new Parser\Utility\UrlChecker();
        $urlType = $urlChecker->analyzeUrl($url);

        // Запуск specificParser с $url и типом
    }
}
