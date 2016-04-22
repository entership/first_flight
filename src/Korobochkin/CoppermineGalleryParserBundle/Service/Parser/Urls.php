<?php
namespace Korobochkin\CoppermineGalleryParserBundle\Service\Parser;

class Urls
{
    const GALLERY = '';

    const ALBUM = 'thumbnails.php';

    //const ALBUM_QUERY = array('album');

    const CATEGORY = 'index.php';

    //const CATEGORY_QUERY = ['cat'];

    public static function album_query_keys() {
        return array('album');
    }
}
