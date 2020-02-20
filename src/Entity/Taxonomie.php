<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Taxonomie
 *
 * @ORM\Table(name="taxonomie")
 * @ORM\Entity(repositoryClass="App\Repository\TaxonomieRepository")
 */
class Taxonomie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_taxonomie", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_taxonomie;

    /**
     * @var string
     *
     * @ORM\Column(name="codeTaxonomie", type="string", length=10)
     */
    private $codeTaxonomie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reprographie", mappedBy="id_taxonomie", cascade={"remove"})
     */
    private $repros;

    public function __construct()
    {
        $this->repros = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getIdTaxonomie()
    {
        return $this->id_taxonomie;
    }

    /**
     * Set codeTaxonomie.
     *
     * @param string $codeTaxonomie
     *
     * @return Taxonomie
     */
    public function setCodeTaxonomie($codeTaxonomie)
    {
        $this->codeTaxonomie = $codeTaxonomie;

        return $this;
    }

    /**
     * Get codeTaxonomie.
     *
     * @return string
     */
    public function getCodeTaxonomie()
    {
        return $this->codeTaxonomie;
    }

    /**
     * Set libelle.
     *
     * @param string|null $libelle
     *
     * @return Taxonomie
     */
    public function setLibelle($libelle = null)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle.
     *
     * @return string|null
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    public function __toString(){
        // retourne les choix entitytype du service en string
        return (string) $this->libelle;
    }
}
