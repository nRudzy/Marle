<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ContientDoc
 *
 * @ORM\Table(name="contient_doc")
 * @ORM\Entity(repositoryClass="App\Repository\ContientDocRepository")
 */
class ContientDoc
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_contientDocs", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("repro:read")
     */
    private $id_contientDocs;

    /**
     * @ORM\OneToMany(targetEntity="Document", mappedBy="id_contientDocs", cascade={"persist"})
     * @Groups("repro:read")
     */
    private $documents;

    /**
     * @ORM\ManyToOne(targetEntity="Reprographie", inversedBy="contientDocs")
     * @ORM\JoinColumn(name="id_reprographie", referencedColumnName="id_reprographie")
     */
    private $id_reprographie;

    /**
     * @var string
     *
     * @ORM\Column(name="nomDocument", type="string", length=255, nullable=true)
     * @Groups("repro:read")
     */
    private $nomDocument;

    /**
     * @var string
     *
     * @ORM\Column(name="refDocument", type="string", length=255)
     * @Groups("repro:read")
     */
    private $refDocument;

    /**
     * @var string
     *
     * @ORM\Column(name="indice", type="string", length=10)
     * @Groups("repro:read")
     */
    private $indice;

    /**
     * @var string
     *
     * @ORM\Column(name="typeDocument", type="string", length=255)
     * @Groups("repro:read")
     */
    private $typeDocument;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tampon", type="string", length=100, nullable=true)
     * @Groups("repro:read")
     */
    private $tampon;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_exemplaire_a3", type="integer")
     * @Groups("repro:read")
     */
    private $nbExemplaireA3;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_exemplaire_a4", type="integer")
     * @Groups("repro:read")
     */
    private $nbExemplaireA4;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_exemplaire_a5", type="integer")
     * @Groups("repro:read")
     */
    private $nbExemplaireA5;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_exemplaire_a0", type="integer")
     * @Groups("repro:read")
     */
    private $nbExemplaireA0;

    /**
     * @var string
     *
     * @ORM\Column(name="recto_verso", type="string", length=50)
     * @Groups("repro:read")
     */
    private $rectoVerso;

    /**
     * @var string
     *
     * @ORM\Column(name="support", type="string", length=50)
     * @Groups("repro:read")
     */
    private $support;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nb_trous", type="string", nullable=true)
     * @Groups("repro:read")
     */
    private $nbTrous;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reliement", type="string", length=50, nullable=true)
     * @Groups("repro:read")
     */
    private $reliement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="agrafes", type="string", nullable=true)
     * @Groups("repro:read")
     */
    private $agrafes;

    /**
     * @var bool
     *
     * @ORM\Column(name="pliure", type="boolean")
     * @Groups("repro:read")
     */
    private $pliure;

    /**
     * @var bool
     *
     * @ORM\Column(name="massicotage", type="boolean")
     * @Groups("repro:read")
     */
    private $massicotage;

    /**
     * @var bool
     *
     * @ORM\Column(name="plastification", type="boolean")
     * @Groups("repro:read")
     */
    private $plastification;

    /**
     * @var bool
     *
     * @ORM\Column(name="couleur", type="boolean")
     * @Groups("repro:read")
     */
    private $couleur;



    /**************************************************************************/


    public function __construct()
    {
        $this->documents = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }


    public function addDocuments(Document $document, $nomDocument, $refDocument, $typeDocument)
    {
        $document->setIdContientDocs($this);
        $document->setNomDocument($nomDocument);
        $document->setRefDocument($refDocument);
        $document->setTypeDocument($typeDocument);

        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setIdContientDocs($this);
        }

        return $this;
    }

    public function removeDocuments(Document $documents)
    {
        if ($this->documents->contains($documents)) {
            $this->documents->removeElement($documents);
            // set the owning side to null (unless already changed)
            if ($documents->getIdContientDocs() === $this) {
                $documents->setIdContientDocs(null);
            }
        }

        return $this;
    }


    /**
     * Set nomDocument.
     *
     * @param string $nomDocument
     *
     * @return ContientDoc
     */
    public function setNomDocument($nomDocument)
    {
        $this->nomDocument = $nomDocument;

        return $this;
    }

    /**
     * Get nomDocument.
     *
     * @return string
     */
    public function getNomDocument()
    {
        return $this->nomDocument;
    }

    /**
     * Get refDocument.
     *
     * @return string
     */
    public function getRefDocument()
    {
        return $this->refDocument;
    }

    /**
     * Set refDocument.
     *
     * @param string
     *
     * @return ContientDoc
     */
    public function setRefDocument($refDocument)
    {
        $this->refDocument = $refDocument;

        return $this;
    }



    /**
     * Set typeDocument.
     *
     * @param string $typeDocument
     *
     * @return ContientDoc
     */
    public function setTypeDocument($typeDocument)
    {
        $this->typeDocument = $typeDocument;

        return $this;
    }

    /**
     * Get typeDocument.
     *
     * @return string
     */
    public function getTypeDocument()
    {
        return $this->typeDocument;
    }

    /**
     * @return string
     */
    public function getIndice()
    {
        return $this->indice;
    }

    /**
     * @param string $indice
     *
     * @return contientDoc
     */
    public function setIndice($indice)
    {
        $this->indice = $indice;

        return $this;
    }



    /**
     * Get id.
     *
     * @return int
     */
    public function getIdContientDocs()
    {
        return $this->id_contientDocs;
    }

    /**
     * Set id_reprographie.
     *
     * @param string $id_reprographie
     *
     * @return ContientDoc
     */
    public function setIdReprographie($id_reprographie)
    {
        $this->id_reprographie = $id_reprographie;

        return $this;
    }

    /**
     * Get id_reprographie.
     *
     * @return string
     */
    public function getIdReprographie()
    {
        return $this->id_reprographie;
    }

    /**
     * Set tampon.
     *
     * @param string|null $tampon
     *
     * @return ContientDoc
     */
    public function setTampon($tampon = null)
    {
        $this->tampon = $tampon;

        return $this;
    }

    /**
     * Get tampon.
     *
     * @return string|null
     */
    public function getTampon()
    {
        return $this->tampon;
    }

    /**************************************/
    /**
     * Set nbExemplaireA3.
     *
     * @param int $nbExemplaireA3
     *
     * @return ContientDoc
     */
    public function setNbExemplaireA3($nbExemplaireA3)
    {
        $this->nbExemplaireA3 = $nbExemplaireA3;

        return $this;
    }

    /**
     * Get nbExemplaireA3.
     *
     * @return int
     */
    public function getNbExemplaireA3()
    {
        return $this->nbExemplaireA3;
    }

    /**
     * Set nbExemplaireA4.
     *
     * @param int $nbExemplaireA4
     *
     * @return ContientDoc
     */
    public function setNbExemplaireA4($nbExemplaireA4)
    {
        $this->nbExemplaireA4 = $nbExemplaireA4;

        return $this;
    }

    /**
     * Get nbExemplaireA4.
     *
     * @return int
     */
    public function getNbExemplaireA4()
    {
        return $this->nbExemplaireA4;
    }

    /**
     * Set nbExemplaireA5.
     *
     * @param int $nbExemplaireA5
     *
     * @return ContientDoc
     */
    public function setNbExemplaireA5($nbExemplaireA5)
    {
        $this->nbExemplaireA5 = $nbExemplaireA5;

        return $this;
    }

    /**
     * Get nbExemplaireA5.
     *
     * @return int
     */
    public function getNbExemplaireA5()
    {
        return $this->nbExemplaireA5;
    }

    /**
     * Set nbExemplaireA0.
     *
     * @param int $nbExemplaireA0
     *
     * @return ContientDoc
     */
    public function setNbExemplaireA0($nbExemplaireA0)
    {
        $this->nbExemplaireA0 = $nbExemplaireA0;

        return $this;
    }

    /**
     * Get nbExemplaireA0.
     *
     * @return int
     */
    public function getNbExemplaireA0()
    {
        return $this->nbExemplaireA0;
    }

    /**************************************/

    /**
     * Set rectoVerso.
     *
     * @param string $rectoVerso
     *
     * @return ContientDoc
     */
    public function setRectoVerso($rectoVerso)
    {
        $this->rectoVerso = $rectoVerso;

        return $this;
    }

    /**
     * Get rectoVerso.
     *
     * @return string
     */
    public function getRectoVerso()
    {
        return $this->rectoVerso;
    }

    /**
     * Set support.
     *
     * @param string $support
     *
     * @return ContientDoc
     */
    public function setSupport($support)
    {
        $this->support = $support;

        return $this;
    }

    /**
     * Get support.
     *
     * @return string
     */
    public function getSupport()
    {
        return $this->support;
    }

    /**
     * Set nbTrous.
     *
     * @param int|null $nbTrous
     *
     * @return ContientDoc
     */
    public function setNbTrous($nbTrous = null)
    {
        $this->nbTrous = $nbTrous;

        return $this;
    }

    /**
     * Get nbTrous.
     *
     * @return int|null
     */
    public function getNbTrous()
    {
        return $this->nbTrous;
    }

    /**
     * Set reliement.
     *
     * @param string|null $reliement
     *
     * @return ContientDoc
     */
    public function setReliement($reliement = null)
    {
        $this->reliement = $reliement;

        return $this;
    }

    /**
     * Get reliement.
     *
     * @return string|null
     */
    public function getReliement()
    {
        return $this->reliement;
    }

    /**
     * Set agrafes.
     *
     * @param int|null $agrafes
     *
     * @return ContientDoc
     */
    public function setAgrafes($agrafes = null)
    {
        $this->agrafes = $agrafes;

        return $this;
    }

    /**
     * Get agrafes.
     *
     * @return int|null
     */
    public function getAgrafes()
    {
        return $this->agrafes;
    }

    /**
     * Set pliure.
     *
     * @param bool $pliure
     *
     * @return ContientDoc
     */
    public function setPliure($pliure)
    {
        $this->pliure = $pliure;

        return $this;
    }

    /**
     * Get pliure.
     *
     * @return bool
     */
    public function getPliure()
    {
        return $this->pliure;
    }

    /**
     * Set massicotage.
     *
     * @param bool $massicotage
     *
     * @return ContientDoc
     */
    public function setMassicotage($massicotage)
    {
        $this->massicotage = $massicotage;

        return $this;
    }

    /**
     * Get massicotage.
     *
     * @return bool
     */
    public function getMassicotage()
    {
        return $this->massicotage;
    }

    /**
     * Set plastification.
     *
     * @param bool $plastification
     *
     * @return ContientDoc
     */
    public function setPlastification($plastification)
    {
        $this->plastification = $plastification;

        return $this;
    }

    /**
     * Get plastification.
     *
     * @return bool
     */
    public function getPlastification()
    {
        return $this->plastification;
    }

    /**
     * Set couleur.
     *
     * @param bool $couleur
     *
     * @return ContientDoc
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur.
     *
     * @return bool
     */
    public function getCouleur()
    {
        return $this->couleur;
    }
    /**********************************************************************************/
}