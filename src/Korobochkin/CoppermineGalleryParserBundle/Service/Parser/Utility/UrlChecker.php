<?php
namespace Korobochkin\CoppermineGalleryParserBundle\Service\Parser\Utility;

use Korobochkin\CoppermineGalleryParserBundle\Service\Parser\Urls;
use Stringy\Stringy;
use Symfony\Component\Validator\Exception\InvalidArgumentException;

class UrlChecker
{
    private $urlTypes = array(
        'gallery' => false,
        'category' => false,
        'album' => false,
    );

    private $urlType = NULL;

    public function analyzeUrl($url)
    {
        if($this->isAlbum($url)) {
            $this->setUrlType('album');
            return $this->urlType;
        }
        return NULL;
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

    private function isAlbum($url)
    {
        if ( ! empty( $url['path'] )) {
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
