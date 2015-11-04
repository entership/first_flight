<?php
namespace Korobochkin\CoppermineGalleryParserBundle\Service\Parser\Utility;

class UrlChecker
{
    private $urlTypes = array(
        'gallery',
        'category',
        'album',
    );

    public function analyzeUrl($url)
    {
        return true;
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
        return false;
    }
}
