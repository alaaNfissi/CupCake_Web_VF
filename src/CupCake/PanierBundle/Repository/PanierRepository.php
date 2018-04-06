<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 25/03/2018
 * Time: 20:09
 */

namespace CupCake\PanierBundle\Repository;


use CupCake\UserBundle\Entity\Utilisateur;
use Doctrine\ORM\EntityRepository;

class PanierRepository extends EntityRepository
{
        public function panierNonCommander(Utilisateur $id_utilisateur)
        {
            $paniersCd=$this->getEntityManager()->getRepository('CommandeBundle:Commande')->paniersValides();
            $qb = $this->createQueryBuilder("pa");
            $qb->leftJoin('pa.utilisateur', 'u')
                ->where('u.id = :id_utilisateur')
                ->andWhere($qb->expr()->notIn('pa.id_panier', $paniersCd))
                ->setParameter('id_utilisateur', $id_utilisateur);
            return $qb->getQuery()->getResult();
        }

        public function listeProduitPanier($id_utilisateur)
        {

            $paniers=$this->panierNonCommander($id_utilisateur);
            if(count($paniers)!=0)
            {
                $qb = $this->createQueryBuilder("pa")
                    ->leftJoin('pa.produit','pr')
                    ->where('pa.id_panier = :id')
                    ->setParameter("id", $paniers[0]->getIdPanier());
                $paniers = $qb->getQuery()->getResult();
            }
            $produits = [];
            foreach ($paniers as $panier)
                $produits[] = $panier->getProduit();
            return $produits;
        }

        public function listeProduitPanierCommande($paniers)
        {
            if(count($paniers)!=0)
            {
                $qb = $this->createQueryBuilder("pa")
                    ->leftJoin('pa.produit','pr')
                    ->where('pa.id_panier = :id')
                    ->setParameter("id", $paniers[0]->getIdPanier());
                $paniers = $qb->getQuery()->getResult();
            }
            $produits = [];
            foreach ($paniers as $panier)
                $produits[] = $panier->getProduit();
            return $produits;
        }
}