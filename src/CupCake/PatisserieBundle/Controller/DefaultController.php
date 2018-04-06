<?php

namespace CupCake\PatisserieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PatisserieBundle:Default:index.html.twig');
    }
}
