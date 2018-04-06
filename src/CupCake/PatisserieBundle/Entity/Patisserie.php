<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 23/03/2018
 * Time: 20:50
 */

namespace CupCake\PatisserieBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="patisserie")
 */
class Patisserie
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(name="id_patisserie",type="integer")
     */
    private $id_patisserie;

    /**
     * @ORM\Column(name="libelle_patisserie",type="string",length=255,unique=true)
     */
    private $libelle_patisserie;

    /**
     * @ORM\Column(name="adresse_patisserie",type="string",length=255)
     */
    private $adresse_patisserie;

    /**
     * @ORM\Column(name="date_creation",type="date")
     */
    private $date_creation;

    /**
     * @ORM\Column(name="specialite",type="string",length=255)
     */
    private $specialite;

    /**
     * @ORM\Column(name="compte_facebook",type="string",length=255)
     */
    private $compte_facebook;

    /**
     * @ORM\Column(name="compte_instagram",type="string",length=255)
     */
    private $compte_instagram;

    /**
     * @ORM\Column(name="description",type="string",length=255)
     */
    private $description;

    /**
     * @ORM\Column(name="image",type="string",length=255)
     */
    private $image;

    /**
     * @ORM\OneToOne(targetEntity="CupCake\UserBundle\Entity\Utilisateur")
     * @ORM\JoinColumn(name="id_utilisateur",referencedColumnName="id")
     */

    private $utilisateur;

    /**
     * @return mixed
     */
    public function getIdPatisserie()
    {
        return $this->id_patisserie;
    }

    /**
     * @param mixed $id_patisserie
     */
    public function setIdPatisserie($id_patisserie)
    {
        $this->id_patisserie = $id_patisserie;
    }

    /**
     * @return mixed
     */
    public function getLibellePatisserie()
    {
        return $this->libelle_patisserie;
    }

    /**
     * @param mixed $libelle_patisserie
     */
    public function setLibellePatisserie($libelle_patisserie)
    {
        $this->libelle_patisserie = $libelle_patisserie;
    }

    /**
     * @return mixed
     */
    public function getAdressePatisserie()
    {
        return $this->adresse_patisserie;
    }

    /**
     * @param mixed $adresse_patisserie
     */
    public function setAdressePatisserie($adresse_patisserie)
    {
        $this->adresse_patisserie = $adresse_patisserie;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * @param mixed $date_creation
     */
    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    /**
     * @return mixed
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * @param mixed $specialite
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;
    }

    /**
     * @return mixed
     */
    public function getCompteFacebook()
    {
        return $this->compte_facebook;
    }

    /**
     * @param mixed $compte_facebook
     */
    public function setCompteFacebook($compte_facebook)
    {
        $this->compte_facebook = $compte_facebook;
    }

    /**
     * @return mixed
     */
    public function getCompteInstagram()
    {
        return $this->compte_instagram;
    }

    /**
     * @param mixed $compte_instagram
     */
    public function setCompteInstagram($compte_instagram)
    {
        $this->compte_instagram = $compte_instagram;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }



    /**
     * Set utilisateur
     *
     * @param \CupCake\UserBundle\Entity\Utilisateur $utilisateur
     *
     * @return Patisserie
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
