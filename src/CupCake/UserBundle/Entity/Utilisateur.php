<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 20/03/2018
 * Time: 19:41
 */

namespace CupCake\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="utilisateur")
 */
class Utilisateur extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="bigint")
     */
    protected $id;

    /**
     * @ORM\Column(name="num_tel",type="integer")
     */
    private $num_tel;
    /**
     * @ORM\Column(name="nom",type="string",length=255)
     */
    private $nom;
    /**
     * @ORM\Column(name="prenom",type="string",length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(name="date_naissance",type="date")
     */
    private $date_naissance;
    /**
     * @ORM\Column(name="adresse",type="string",length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(name="sexe",type="string",length=255)
     */
    private $sexe;

    /**
     * @ORM\Column(name="image",type="string",length=255)
     */
    private $image;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNumTel()
    {
        return $this->num_tel;
    }

    /**
     * @param mixed $num_tel
     */
    public function setNumTel($num_tel)
    {
        $this->num_tel = $num_tel;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    /**
     * @param mixed $date_naissance
     */
    public function setDateNaissance($date_naissance)
    {
        $this->date_naissance = $date_naissance;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
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

}