<?php
namespace Korobochkin\CoppermineGalleryParserBundle\Service\Parser\Utility;

use Korobochkin\CoppermineGalleryParserBundle\Service\Parser\Urls;
use Stringy\Stringy;
use Symfony\Component\Validator\Exception\InvalidArgumentException;

class UrlChecker
{
    private $url = null;

    private $parsedUrl = null;

    private $urlTypesResults = null;

    public function __construct($url){
        $this->setUrl($url);
        $this->resetUrlTypesResults();
    }

    public function analyzeUrl()
    {
        if($this->isAlbum()) {
            $this->setUrlType('album');
            return $this->urlType;
        }
        return NULL;
    }

    public function setUrl($url)
    {
        $this->$url = $url;
        $this->parseUrl();
        $this->resetUrlTypesResults();
    }

    private function parseUrl() {
        $this->parsedUrl = parse_url($this->url);
    }

    private function resetUrlTypesResults() {
        $this->urlTypesResults = array(
            'gallery' => false,
            'category' => false,
            'album' => false,
        );
    }

    private function setUrlType($type) {
        if( isset( $this->urlTypes[$type] ) ) {
            $this->urlTypes[$type] = true;
            $this->urlType = $type;
        }
        else {
            // TODO: какую именно ошибку тут выдавать?
            throw new InvalidArgumentException();
        }
    }

    private function isGallery($url)
    {
        return false;
    }

    private function isCategory($url)
    {
        return false;
    }

    private function isAlbum()
    {
        if ( ! empty( $this->parsedUrl['path'] )) {
            // TODO: как правильно вызывать Stringy чтобы не создавать 100 экземпляров внутри кода?
            $stringy = new Stringy();
            $result  = $stringy->endsWith(Urls::ALBUM);
            if ($result === true) {
                return true;
            }
        }

        return false;
    }
}
