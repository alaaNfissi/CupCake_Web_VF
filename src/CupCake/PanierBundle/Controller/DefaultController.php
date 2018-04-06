<?php

namespace CupCake\PanierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PanierBundle:Default:index.html.twig');
    }
}
