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
        if(!$this->checkPath()) {
            $this->logger->error('Unknown URL received.');
            return;
        }

        if(empty($this->urlComponents['host']) || empty($this->urlComponents['schema'])) {
            $this->logger->info('Can\'t resolve Host or Schema.');
            return;
        }

        $this->logger->info(
            'Resolve Host and Schema.',
            ['host' => $this->urlComponents['host'], 'schema' => $this->urlComponents['schema']]
        );

        // TODO: Не опасно ли передавать сюда пользовательский ввод? Может нужно сделать экраницазацию?
        $this->logger->info(
            'Try to fetch entered URL.',
            ['url' => $url]
        );

        $response = $this->guzzle->get($url);

        /*
         * TODO: А разве Кравлер не нужно ставить отдельным компонентом?
         * В документации написано надо ставить, но судя по всему он уже есть в текущей Симфонии
         */
        $crawler = new Crawler((string) $response->getBody());

        // А может мы должны просто попробовать запросить page=2, page=3... и если получаем 404, то все,
        // все страницы получили. Вместо того, чтобы выдерать из DOM ссылки.


    }

    /**
     * Check if entered URL end with album path.
     * Based on http://stackoverflow.com/questions/619610/whats-the-most-efficient-test-of-whether-a-php-string-ends-with-another-string
     *
     * @return bool
     */
    public function checkPath() {
        // We have a path
        if(!empty($this->urlComponents['path'])) {
            $pathLenght = strlen($this->urlComponents['path']);
            $albumLenght = strlen(Parser\Urls::ALBUM);

            // If entered path smaller than album's URL
            if($albumLenght > $pathLenght) {
                return false;
            }

            // Check if the end of the path match to album URL
            // TODO: case sensitive or not?
            return !(bool)substr_compare(
                $this->urlComponents['path'],
                Parser\Urls::ALBUM,
                $pathLenght - $albumLenght,
                $albumLenght
            );
        }
        return false;
    }
}
