<?php

namespace Andrey\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AndreyGalleryBundle:Default:index.html.twig');
    }
}
