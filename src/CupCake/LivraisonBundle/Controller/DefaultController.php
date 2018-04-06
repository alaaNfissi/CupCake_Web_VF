<?php

namespace CupCake\LivraisonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LivraisonBundle:Default:index.html.twig');
    }
}
