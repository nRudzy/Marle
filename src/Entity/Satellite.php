<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Satellite
 *
 * @ORM\Table(name="satellite")
 * @ORM\Entity(repositoryClass="App\Repository\SatelliteRepository")
 */
class Satellite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_satellite", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("repro:read")
     */
    private $id_satellite;

    /**
     * @var string
     *
     * @ORM\Column(name="codeSatellite", type="string", length=10, unique=true)
     * @Groups("repro:read")
     */
    private $codeSatellite;

    /**
     * @ORM\OneToMany(targetEntity="Docsat", mappedBy="id_satellite", cascade={"remove"})
     * @Groups("repro:read")
     */
    private $docsats;

    public function __construct()
    {
        $this->docsats = new ArrayCollection();
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getIdSatellite()
    {
        return $this->id_satellite;
    }

    /**
     * Set codeSatellite.
     *
     * @param string $codeSatellite
     *
     * @return Satellite
     */
    public function setCodeSatellite($codeSatellite)
    {
        $this->codeSatellite = $codeSatellite;

        return $this;
    }

    /**
     * Get codeSatellite.
     *
     * @return string
     */
    public function getCodeSatellite()
    {
        return $this->codeSatellite;
    }


    public function getDocsats()
    {
        return $this->docsats;
    }

    public function addDocsats(Docsat $docsats)
    {
        if (!$this->docsats->contains($docsats)) {
            $this->docsats[] = $docsats;
            $docsats->setIdSatellite($this);
        }

        return $this;
    }

    public function removeDocsats(Docsat $docsats)
    {
        if ($this->docsats->contains($docsats)) {
            $this->docsats->removeElement($docsats);

            if ($docsats->getIdSatellite() === $this) {
                $docsats->setIdSatellite(null);
            }
        }

        return $this;
    }
}
