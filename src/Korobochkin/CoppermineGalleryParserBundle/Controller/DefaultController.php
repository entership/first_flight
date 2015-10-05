<?php

namespace Korobochkin\CoppermineGalleryParserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KorobochkinCoppermineGalleryParserBundle:Default:index.html.twig', array('name' => $name));
    }
}
