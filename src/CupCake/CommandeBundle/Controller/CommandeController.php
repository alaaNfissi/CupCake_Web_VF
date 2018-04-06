<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 27/03/2018
 * Time: 15:11
 */

namespace CupCake\CommandeBundle\Controller;


use CupCake\CommandeBundle\Entity\Commande;
use CupCake\PatisserieBundle\Entity\Patisserie;
use CupCake\ProduitBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends Controller
{
        public function createCommandeAction(Request $request)
        {
            $Bcommande=$request->get('test');
            $commande=new Commande();
//            dump($request->get('panier'));
//            if($request->isMethod('POST'))
//            {
                $em=$this->getDoctrine()->getManager();
                $paniers=$em->getRepository('PanierBundle:Panier')->findOneBy(array('id_panier'=>$request->get('panier')));
                $commande->setPrixTotale($request->get('prixT'));
                $commande->setDateCommande(new \DateTime());
                $commande->setPanier($paniers);
                $commande->setNumCommande($em->getRepository('CommandeBundle:Commande')->numCommande($paniers->getPatisserie()) + 1);
                $em->persist($commande);
                $em->flush();
//            }

            return $this->redirectToRoute('user_homepage',array('param' => $Bcommande,'idC'=>$commande->getIdCommande()));
        }

        public function commandedashboardAction()
        {
            $livraisons=array();
            $commandes=array();
            $ttProduits=array();
            $em=$this->getDoctrine()->getManager();
            $patisserie=$em->getRepository('PatisserieBundle:Patisserie')->findOneBy(array('utilisateur'=>$this->getUser()));
            if($patisserie != null)
            {
                $commandesT=$em->getRepository('CommandeBundle:Commande')->listCommandes($patisserie->getIdPatisserie());
                $nbreCommandes=$em->getRepository('CommandeBundle:Commande')->numCommande($patisserie);
//            dump($commandes);

                for($i=0;$i<count($commandesT);$i++)
                {
                    $livraisonsT[$i]=$em->getRepository('LivraisonBundle:Livraison')->findOneBy(array('commande'=>$commandesT[$i]));
                    $paniers = $em->getRepository('PanierBundle:Panier')->findBy(array('id_panier' => $commandesT[$i]->getPanier()->getIdPanier()));
                    //$paniers[$i]=$panier;
                    $produits = $em->getRepository('PanierBundle:Panier')->listeProduitPanierCommande($paniers);
                    $ttProduitsT[$i] = $produits;
//                    if($livraisonsT[$i] !=null) {
//                        if ($livraisonsT[$i]->getEtatLivraison() != 3) {
                            array_push($livraisons,$livraisonsT[$i]);
                            array_push($commandes,$commandesT[$i]);
                            array_push($ttProduits,$ttProduitsT[$i]);
//                        }
//                    }
//                    dump($ttProduits[$i]);
                }
            }
            else
            {
                $commandes=array();
                $nbreCommandes=null;
                $ttProduits=array();
                $livraisons=array();
            }
            dump($livraisons);
            return $this->render('CommandeBundle:Commande:commandeDashboardTable.html.twig',array('commandes'=>$commandes,'patisserie'=>$patisserie,'nbreCommandes'=>$nbreCommandes,'ttProduits'=>$ttProduits,'livraisons'=>$livraisons));
        }

        public function annulerCommandeAction(Request $request)
        {
            $em=$this->getDoctrine()->getManager();
            $livraison=$em->getRepository('LivraisonBundle:Livraison')->find($request->get('id'));
            $livraison->setEtatLivraison($request->get('etat'));
            $em->persist($livraison);
            $em->flush();
//            $dateDiff=date_diff(new \DateTime(),$commande->getDateCommande());
            $test=-1;
//            if($dateDiff->format("%R%a")<2)
//            {
//                $em->remove($commande);
//                $em->flush();
//                $test=1;
//            }
            return $this->redirectToRoute('profile_details',array('testDelete'=>$test));
        }

}