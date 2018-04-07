<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 04/04/2018
 * Time: 16:44
 */

namespace CupCake\LivraisonBundle\Controller;


use CupCake\LivraisonBundle\Entity\Livraison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LivraisonController extends Controller
{
    public function ajoutLivraisonAction(Request $request)
    {
        $livraison=new Livraison();
//        if($request->isMethod('POST')){
        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository('CommandeBundle:Commande')->findCommandeById($request->get('id_commande'));
            $livraison->setCommande($commande[0]);
            $livraison->setPrixLivraison($request->get('prix_livraison')*0.1);
            $dateL=new \DateTime($request->get('date_livraison'));
//            dump($request->get('date_livraison'));
            $livraison->setDateLivraison($dateL);
            $livraison->setEtatLivraison($request->get('etat_livraison'));
//            $modele->setPays($request->get('pays'));

            $em->persist($livraison);
            $em->flush();
//        }
        return $this->redirectToRoute('user_homepage');
    }

    public function modifierLivraisonAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $livraison=$em->getRepository('LivraisonBundle:Livraison')->find($request->get('id'));
        $livraison->setEtatLivraison($request->get('etat'));
        $em->persist($livraison);
        $em->flush();
        return $this->redirectToRoute('commande_dashboard');
    }
}