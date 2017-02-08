<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Astuce
 *
 * @ORM\Table(name="astuce")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AstuceRepository")
 * @Gedmo\Loggable
 */
class Astuce
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="auteur", type="string", length=255, nullable=true)
     */
    private $auteur;

    /**
     * @var string
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="source", type="string", length=255, nullable=true)
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="datedeb", type="string", length=10, nullable=true)
     */
    private $datedeb;

    /**
     * @var string
     *
     * @ORM\Column(name="datefin", type="string", length=10, nullable=true)
     */
    private $datefin;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(name="publie_par", type="string", length=255, nullable=true)
     */
    private $publiePar;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\Column(name="modifie_par", type="string", length=255)
     */
    private $modifiePar;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="publie_le", type="datetimetz", nullable=true)
     */
    private $publieLe;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="modifie_le", type="datetimetz", nullable=true)
     */
    private $modifieLe;

    /**
      * @var bool
      *
      * @Gedmo\Versioned
      * @ORM\Column(name="statut", type="boolean", nullable=true)
      */
     private $statut;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Astuce
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Astuce
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Astuce
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set datedeb
     *
     * @param string $datedeb
     *
     * @return Astuce
     */
    public function setDatedeb($datedeb)
    {
        $this->datedeb = $datedeb;

        return $this;
    }

    /**
     * Get datedeb
     *
     * @return string
     */
    public function getDatedeb()
    {
        return $this->datedeb;
    }

    /**
     * Set datefin
     *
     * @param string $datefin
     *
     * @return Astuce
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return string
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set publiePar
     *
     * @param string $publiePar
     *
     * @return Astuce
     */
    public function setPubliePar($publiePar)
    {
        $this->publiePar = $publiePar;

        return $this;
    }

    /**
     * Get publiePar
     *
     * @return string
     */
    public function getPubliePar()
    {
        return $this->publiePar;
    }

    /**
     * Set modifiePar
     *
     * @param string $modifiePar
     *
     * @return Astuce
     */
    public function setModifiePar($modifiePar)
    {
        $this->modifiePar = $modifiePar;

        return $this;
    }

    /**
     * Get modifiePar
     *
     * @return string
     */
    public function getModifiePar()
    {
        return $this->modifiePar;
    }

    /**
     * Set publieLe
     *
     * @param \DateTime $publieLe
     *
     * @return Astuce
     */
    public function setPublieLe($publieLe)
    {
        $this->publieLe = $publieLe;

        return $this;
    }

    /**
     * Get publieLe
     *
     * @return \DateTime
     */
    public function getPublieLe()
    {
        return $this->publieLe;
    }

    /**
     * Set modifieLe
     *
     * @param \DateTime $modifieLe
     *
     * @return Astuce
     */
    public function setModifieLe($modifieLe)
    {
        $this->modifieLe = $modifieLe;

        return $this;
    }

    /**
     * Get modifieLe
     *
     * @return \DateTime
     */
    public function getModifieLe()
    {
        return $this->modifieLe;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     *
     * @return Astuce
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return boolean
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Astuce
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set source
     *
     * @param string $source
     *
     * @return Astuce
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }
}
