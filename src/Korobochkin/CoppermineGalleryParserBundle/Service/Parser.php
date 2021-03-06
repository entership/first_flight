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

    public function __construct(Client $client, Logger $logger)
    {
        $this->logger = $logger;
        $this->guzzle = $client;
    }

    public function run($url)
    {
        //$parsed_url = parse_url($url);

        // Ищем тип страницы по $url
        $urlChecker = new Parser\Utility\UrlChecker($url);
        $urlType = $urlChecker->analyzeUrl();

        // Запуск specificParser с $url и типом
    }
}
