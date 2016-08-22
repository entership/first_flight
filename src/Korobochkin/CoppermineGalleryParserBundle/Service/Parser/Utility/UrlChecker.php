<?php
namespace Korobochkin\CoppermineGalleryParserBundle\Service\Parser\Utility;

use Korobochkin\CoppermineGalleryParserBundle\Service\Parser\Urls;
use Stringy\Stringy;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Exception\InvalidArgumentException;

class UrlChecker
{
    private $url;
    private $parsedUrl;
    private $urlTypesResults;

    public function __construct($url){
        $this->setUrl($url);
        $this->resetUrlTypesResults();
    }

    public function analyzeUrl()
    {
        $this->urlTypesResults['album'] = $this->isAlbum();
    }

    public function getUrlType() {
        if($this->urlTypesResults['album']) {
            return 'album';
        }
    }

    public function setUrl($url)
    {
        $this->url = $url;
        $this->parseUrl();
        $this->resetUrlTypesResults();
    }

    private function parseUrl() {
        $this->parsedUrl = parse_url($this->url);

        if( !empty($this->parsedUrl['query']) && is_string( $this->parsedUrl['query'] ) ) {
            parse_str($this->parsedUrl['query'], $this->parsedUrl['query']);
        }
    }

    private function resetUrlTypesResults() {
        $this->urlTypesResults = array(
            'gallery' => false,
            'category' => false,
            'album' => false,
        );
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
        if(!empty($this->parsedUrl['path']) && is_string($this->parsedUrl['path'])) {

            // TODO: как правильно вызывать Stringy чтобы не создавать 100 экземпляров внутри кода?
            $stringy = new Stringy($this->parsedUrl['path']);
            $result = $stringy->endsWith(Urls::ALBUM, true);

            if($result === true) {

                $required_keys = Urls::album_query_keys();

                foreach($required_keys as $key_name) {
                    if( !isset( $this->parsedUrl['query'][$key_name] ) ) {
                        return false;
                    }
                }

                return true;
            }
        }

        return false;
    }
}
