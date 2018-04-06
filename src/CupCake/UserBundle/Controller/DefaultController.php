<?php

namespace CupCake\UserBundle\Controller;

use CupCake\CommandeBundle\Controller\CommandeController;
use CupCake\CommandeBundle\Entity\Commande;
use CupCake\LivraisonBundle\Entity\Livraison;
use CupCake\PanierBundle\Controller\PanierController;
use CupCake\PanierBundle\Entity\Panier;
use CupCake\PatisserieBundle\Entity\Patisserie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function homeAction(Request $request)
    {
        $param=$request->get('param');

        $idC=$request->get('idC');

        $em=$this->getDoctrine()->getManager();
        if ($idC!=null)
        {
            $LCommande=$em->getRepository('CommandeBundle:Commande')->findCommandeById($idC);
        }
        else
        {
            $commande=new Commande();
            $LCommande=array($commande);
        }
        $patisseries=$em->getRepository('PatisserieBundle:Patisserie')->findAll();
//        $produits=$em->getRepository('ProduitBundle:Produit')->findAll();
        $produits=$em->getRepository('PanierBundle:Panier')->listeProduitPanier($this->getUser());
        $paniers=null;
        $paniers=$em->getRepository('PanierBundle:Panier')->panierNonCommander($this->getUser());
        if(count($paniers)!=0)
        {
            $panier=$paniers[0];
        }
        else
        {
            $panier=new Panier();
        }
//        $livraison=new Livraison();
        $this->get('twig')->addGlobal('produits', $produits);
        return $this->render('UserBundle:Default:home.html.twig',array('patisseries'=> $patisseries,'panier'=> $panier,'Bcommande'=>$param,'LCommande'=>$LCommande[0]));
    }

    public function  dashboardAction()
    {

        $em=$this->getDoctrine()->getManager();
        $patisserie=$em->getRepository('PatisserieBundle:Patisserie')->findOneBy(array('utilisateur'=>$this->getUser()));
        $nbreCommandes=$em->getRepository('CommandeBundle:Commande')->numCommande($patisserie);
        return $this->render('UserBundle:Default:dashboard.html.twig',array('patisserie'=>$patisserie,'nbreCommandes'=>$nbreCommandes));
    }
}
