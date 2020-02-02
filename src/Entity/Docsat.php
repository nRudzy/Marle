<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Docsat
 *
 * @ORM\Table(name="docsat")
 * @ORM\Entity(repositoryClass="App\Repository\DocsatRepository")
 */
class Docsat
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
     * @ORM\ManyToOne(targetEntity="Document", inversedBy="docsats", cascade={"persist"})
     * @ORM\JoinColumn(name="id_document", referencedColumnName="id_document")
     */
    private $id_document;

    /**
     * @ORM\ManyToOne(targetEntity="Satellite", inversedBy="docsats", cascade={"persist"})
     * @ORM\JoinColumn(name="id_satellite", referencedColumnName="id_satellite")
     */
    private $id_satellite;

    /**
     * @var string
     *
     * @ORM\Column(name="origine", type="string", length=50)
     */
    private $origine;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idDocument.
     *
     * @param mixed $id_document

     */
    public function setIdDocument($id_document)
    {
        $this->id_document = $id_document;
    }

    /**
     * Get idDocument.
     *
     * @return string
     */
    public function getIdDocument()
    {
        return $this->id_document;
    }

    /**
     * Set idSatellite.
     *
     * @param mixed $id_satellite

     */
    public function setIdSatellite($id_satellite)
    {
        $this->id_satellite = $id_satellite;
    }

    /**
     * Get idSatellite.
     *
     * @return string
     */
    public function getIdSatellite()
    {
        return $this->id_satellite;
    }

    /**
     * Set origine.
     *
     * @param string $origine

     */
    public function setOrigine($origine)
    {
        $this->origine = $origine;
    }

    /**
     * Get origine.
     *
     * @return string
     */
    public function getOrigine()
    {
        return $this->origine;
    }

}
