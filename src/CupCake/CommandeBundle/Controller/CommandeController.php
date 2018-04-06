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
            $em=$this->getDoctrine()->getManager();
            $patisserie=$em->getRepository('PatisserieBundle:Patisserie')->findOneBy(array('utilisateur'=>$this->getUser()));
            if($patisserie != null)
            {
                $commandes=$em->getRepository('CommandeBundle:Commande')->listCommandes($patisserie->getIdPatisserie());
                $nbreCommandes=$em->getRepository('CommandeBundle:Commande')->numCommande($patisserie);
//            dump($commandes);

                for($i=0;$i<count($commandes);$i++)
                {
                    $paniers=$em->getRepository('PanierBundle:Panier')->findBy(array('id_panier'=>$commandes[$i]->getPanier()->getIdPanier()));
                    //$paniers[$i]=$panier;
                    $produits=$em->getRepository('PanierBundle:Panier')->listeProduitPanierCommande($paniers);
                    $livraisons[$i]=$em->getRepository('LivraisonBundle:Livraison')->findOneBy(array('commande'=>$commandes[$i]));
                    $ttProduits[$i]=$produits;
                }
            }
            else
            {
                $commandes=array();
                $nbreCommandes=null;
                $ttProduits=array();
                $livraisons=array();
            }
//            dump($livraisons);
            return $this->render('CommandeBundle:Commande:commandeDashboardTable.html.twig',array('commandes'=>$commandes,'patisserie'=>$patisserie,'nbreCommandes'=>$nbreCommandes,'ttProduits'=>$ttProduits,'livraisons'=>$livraisons));
        }

}