<?php
namespace Korobochkin\CoppermineGalleryParserBundle\Service;

use DOMElement;
//use Etki\SranyParserBundle\Service\Parser\Selectors;
//use Etki\SranyParserBundle\Service\Parser\Urls;
use GuzzleHttp\Client;
use Monolog\Logger;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class AlbumParser
 * @package Korobochkin\CoppermineGalleryParserBundle\Service
 */
class Parser {

    private $logger;

    private $guzzle;

    private $urlComponents;

    public function  __construct(Client $client, Logger $logger) {
        $this->logger = $logger;
        $this->guzzle = $client;
    }

    public function parse($url) {
        $this->urlComponents = parse_url($url);
        //if()
    }

    public function checkPath() {
        if($this->urlComponents) {

        }
    }
}
