<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 28/03/2018
 * Time: 23:49
 */

namespace CupCake\LivraisonBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="livraison")
 */
class Livraison
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(name="id_livraison",type="integer")
     */
    private $id_livraison;

    /**
     * @ORM\Column(name="date_livraison",type="date")
     */
    private $date_livraison;

    /**
     * @ORM\Column(name="prix_livraison",type="float")
     */
    private $prix_livraison;

    /**
     * @ORM\Column(name="etat_livraison",type="integer")
     */
    private $etat_livraison;

    public $etatLivraionString=array("La commande est en cours du traitement","La commande est en route","La Commande est livrée","La commande est Annulée");
    /**
     * @ORM\OneToOne(targetEntity="CupCake\CommandeBundle\Entity\Commande")
     * @ORM\JoinColumn(name="id_commande",referencedColumnName="id_commande")
     */
    private $commande;


    /**
     * Get idLivraison
     *
     * @return integer
     */
    public function getIdLivraison()
    {
        return $this->id_livraison;
    }

    /**
     * Set dateLivraison
     *
     * @param \DateTime $dateLivraison
     *
     * @return Livraison
     */
    public function setDateLivraison($dateLivraison)
    {
        $this->date_livraison = $dateLivraison;

        return $this;
    }

    /**
     * Get dateLivraison
     *
     * @return \DateTime
     */
    public function getDateLivraison()
    {
        return $this->date_livraison;
    }

    /**
     * Set prixLivraison
     *
     * @param float $prixLivraison
     *
     * @return Livraison
     */
    public function setPrixLivraison($prixLivraison)
    {
        $this->prix_livraison = $prixLivraison;

        return $this;
    }

    /**
     * Get prixLivraison
     *
     * @return float
     */
    public function getPrixLivraison()
    {
        return $this->prix_livraison;
    }


    /**
     * Set commande
     *
     * @param \CupCake\CommandeBundle\Entity\Commande $commande
     *
     * @return Livraison
     */
    public function setCommande(\CupCake\CommandeBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \CupCake\CommandeBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set etatLivraison
     *
     * @param integer $etatLivraison
     *
     * @return Livraison
     */
    public function setEtatLivraison($etatLivraison)
    {
        $this->etat_livraison = $etatLivraison;

        return $this;
    }

    /**
     * Get etatLivraison
     *
     * @return integer
     */
    public function getEtatLivraison()
    {
        return $this->etat_livraison;
    }
}
