<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 25/03/2018
 * Time: 12:37
 */

namespace CupCake\PanierBundle\Entity;


use CupCake\ProduitBundle\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CupCake\PanierBundle\Repository\PanierRepository")
 * @ORM\Table(name="panier")
 */
class Panier
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id_panier",type="integer")
     */
    private $id_panier;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="CupCake\ProduitBundle\Entity\Produit")
     * @ORM\JoinColumn(name="id_produit",referencedColumnName="id_produit")
     */
    private $produit;



    /**
     * @ORM\ManyToOne(targetEntity="CupCake\PatisserieBundle\Entity\Patisserie")
     * @ORM\JoinColumn(name="id_patisserie",referencedColumnName="id_patisserie")
     */
    private $patisserie;

    /**
     * @ORM\ManyToOne(targetEntity="CupCake\UserBundle\Entity\Utilisateur")
     * @ORM\JoinColumn(name="id_utilisateur",referencedColumnName="id")
     */

    private $utilisateur;

    /**
     * @ORM\Column(name="quantite_produit_panier",type="integer")
     */
    private $quantite_produit_panier;


    /**
     * @return mixed
     */
    public function getIdPanier()
    {
        return $this->id_panier;
    }

    /**
     * @param mixed $id_panier
     */
    public function setIdPanier($id_panier)
    {
        $this->id_panier = $id_panier;
    }





    /**
     * @return mixed
     */
    public function getQuantiteProduitPanier()
    {
        return $this->quantite_produit_panier;
    }

    /**
     * @param mixed $quantite_produit_panier
     */
    public function setQuantiteProduitPanier($quantite_produit_panier)
    {
        $this->quantite_produit_panier = $quantite_produit_panier;
    }



    /**
     * Set produit
     *
     * @param \CupCake\ProduitBundle\Entity\Produit $produit
     *
     * @return Panier
     */
    public function setProduit(\CupCake\ProduitBundle\Entity\Produit $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \CupCake\ProduitBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set patisserie
     *
     * @param \CupCake\PatisserieBundle\Entity\Patisserie $patisserie
     *
     * @return Panier
     */
    public function setPatisserie(\CupCake\PatisserieBundle\Entity\Patisserie $patisserie = null)
    {
        $this->patisserie = $patisserie;

        return $this;
    }

    /**
     * Get patisserie
     *
     * @return \CupCake\PatisserieBundle\Entity\Patisserie
     */
    public function getPatisserie()
    {
        return $this->patisserie;
    }

    /**
     * Set utilisateur
     *
     * @param \CupCake\UserBundle\Entity\Utilisateur $utilisateur
     *
     * @return Panier
     */
    public function setUtilisateur(\CupCake\UserBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \CupCake\UserBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
