<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 27/03/2018
 * Time: 15:12
 */

namespace CupCake\CommandeBundle\Entity;


//use CupCake\PanierBundle\Entity\PanierRepositoryOld;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class CommandeRepository extends EntityRepository
{
        public function paniersValides()
        {
            $query=$this->getEntityManager()
                ->createQuery("SELECT panier.id_panier FROM CommandeBundle:Commande cd JOIN PanierBundle:Panier panier WITH panier = cd.panier");
            return $query->getDQL();
        }

        public function numCommande($patisserie)
        {
            $query=$this->getEntityManager()
                ->createQuery("SELECT count(cd.id_commande) FROM CommandeBundle:Commande cd WHERE cd.panier IN (SELECT pa.id_panier FROM PanierBundle:Panier pa WHERE pa.patisserie=:patisserie)")
                ->setParameter('patisserie',$patisserie);
            return $query->getSingleScalarResult();
        }

        public function listCommandes($patisserie)
        {
            $con = $this->getEntityManager()->getConnection();
            $result = $con->executeQuery("SELECT DISTINCT(cd.id_commande),cd.* FROM commande cd JOIN panier pa ON pa.id_panier=cd.id_panier WHERE pa.id_patisserie = :patisserie ",array('patisserie' =>$patisserie));
            $commandesList=$result->fetchAll();
            $commandes=array();
//            $i=0;
            for ($i=0;$i<count($commandesList);$i++)
            {
                $commande=new Commande();
                $commande->setIdCommande($commandesList[$i]['id_commande']);
                $commande->setNumCommande($commandesList[$i]['num_commande']);
                $panier = $this->_em->getRepository("PanierBundle:Panier")->findOneBy(['id_panier' => $commandesList[$i]['id_panier']]);
                $commande->setPanier($panier);
                $commande->setDateCommande($commandesList[$i]['date_commande']);
                $commande->setPrixTotale($commandesList[$i]['prix_totale']);
                $commandes[$i]=$commande;
            }
//            $rsm= new ResultSetMapping();
//            $rsm->addEntityResult('CommandeBundle:Commande','cd');
//            $rsm->addFieldResult('cd','id_commande','id_commande');
//            $rsm->addFieldResult('cd','panier','id_panier');
//            $rsm->addFieldResult('cd','num_commande','num_commande');
//            $rsm->addFieldResult('cd','date_commande','date_commande');
//            $rsm->addFieldResult('cd','prix_totale','prix_totale');
//            $query=$this->getEntityManager()
//                ->createNativeQuery("SELECT * FROM commande",$rsm);
//            return $query->getResult();
            return $commandes;
        }

        public function findCommandeById($id_commande)
        {
            $rsm= new ResultSetMapping();
            $rsm->addEntityResult('CommandeBundle:Commande','cd');
            $rsm->addFieldResult('cd','id_commande','id_commande');
//            $rsm->addFieldResult('cd','panier','id_panier');
            $rsm->addFieldResult('cd','num_commande','num_commande');
            $rsm->addFieldResult('cd','date_commande','date_commande');
            $rsm->addFieldResult('cd','prix_totale','prix_totale');
            $query=$this->getEntityManager()
                ->createNativeQuery("SELECT * FROM commande WHERE id_commande= :id",$rsm)
                ->setParameter('id',$id_commande);
            return $query->getResult();
        }
    public function listCommandesUtilisateur($utilisateur)
    {
        $con = $this->getEntityManager()->getConnection();
        $result = $con->executeQuery("SELECT DISTINCT(cd.id_commande),cd.* FROM commande cd JOIN panier pa ON pa.id_panier=cd.id_panier WHERE pa.id_utilisateur = :utilisateur",array('utilisateur' =>$utilisateur));
        $commandesList=$result->fetchAll();
        $commandes=array();
        for ($i=0;$i<count($commandesList);$i++)
        {
            $commande=new Commande();
            $commande->setIdCommande($commandesList[$i]['id_commande']);
            $commande->setNumCommande($commandesList[$i]['num_commande']);
            $panier = $this->_em->getRepository("PanierBundle:Panier")->findOneBy(['id_panier' => $commandesList[$i]['id_panier']]);
            $commande->setPanier($panier);
            $commande->setDateCommande($commandesList[$i]['date_commande']);
            $commande->setPrixTotale($commandesList[$i]['prix_totale']);
            $commandes[$i]=$commande;
        }
        return $commandes;
    }

    public function revenueTotale($patisserie)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT SUM(cd.prix_totale) FROM CommandeBundle:Commande cd WHERE cd.panier IN (SELECT pa.id_panier FROM PanierBundle:Panier pa WHERE pa.patisserie=:patisserie)")
            ->setParameter('patisserie',$patisserie);
        return $query->getSingleScalarResult();
    }

    public function revenueDesCommandeDate ($patisserie,$dateC)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT SUM(cd.prix_totale) FROM CommandeBundle:Commande cd WHERE cd.panier IN (SELECT pa.id_panier FROM PanierBundle:Panier pa WHERE pa.patisserie=:patisserie AND cd.date_commande =:dateC)")
            ->setParameter('patisserie',$patisserie)
            ->setParameter('dateC',$dateC);
        return $query->getSingleScalarResult();
    }
}