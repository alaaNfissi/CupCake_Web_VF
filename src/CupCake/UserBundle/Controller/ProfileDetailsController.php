<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 06/04/2018
 * Time: 16:58
 */

namespace CupCake\UserBundle\Controller;


use CupCake\CommandeBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileDetailsController extends Controller
{
    public function profiledetailsAction()
    {
        $ttProduits=array();
        $livraisons=array();
        $em=$this->getDoctrine()->getManager();
        $commandes=$em->getRepository(Commande::class)->listCommandesUtilisateur($this->getUser()->getId());
        if($commandes != null) {
            for ($i = 0; $i < count($commandes); $i++) {
                $paniers = $em->getRepository('PanierBundle:Panier')->findBy(array('id_panier' => $commandes[$i]->getPanier()->getIdPanier()));
                $produits = $em->getRepository('PanierBundle:Panier')->listeProduitPanierCommande($paniers);
                $livraisons[$i] = $em->getRepository('LivraisonBundle:Livraison')->findOneBy(array('commande' => $commandes[$i]));
                $ttProduits[$i] = $produits;
            }
        }
        dump($commandes);
        return $this->render('UserBundle:Profile:ProfileDetails.html.twig',array('commandes'=>$commandes,'ttProduits'=>$ttProduits,'livraisons'=>$livraisons));
    }
}