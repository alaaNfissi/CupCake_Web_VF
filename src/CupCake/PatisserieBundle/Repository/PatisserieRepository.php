<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 08/04/2018
 * Time: 20:41
 */

namespace CupCake\PatisserieBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PatisserieRepository extends EntityRepository
{
    public function findLibelleDQL($libelle)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT p FROM PatisserieBundle:Patisserie p WHERE p.libelle_patisserie LIKE :libelle")
            ->setParameter('libelle',$libelle);
        return $query->getResult();
    }
}