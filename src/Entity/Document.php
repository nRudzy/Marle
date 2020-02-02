<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Document
 *
 * @ORM\Table(name="document")
 * @ORM\Entity(repositoryClass="App\Repository\DocumentRepository")
 */
class Document
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_document", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_document;

    /**
     * @ORM\ManyToOne(targetEntity="ContientDoc", inversedBy="documents")
     * @ORM\JoinColumn(name="id_contientDocs", referencedColumnName="id_contientDocs")
     */
    private $id_contientDocs;

    /**
     * @var string
     *
     * @ORM\Column(name="nomDocument", type="string", length=255, nullable=true)
     */
    private $nomDocument;

    /**
     * @var string
     *
     * @ORM\Column(name="refDocument", type="string", length=255)
     */
    private $refDocument;

    /**
     * @var string
     *
     * @ORM\Column(name="typeDocument", type="string", length=255)
     */
    private $typeDocument;

    /**
     * @ORM\OneToMany(targetEntity="Docsat", mappedBy="id_document", cascade={"persist"})
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
    public function getIdDocument()
    {
        return $this->id_document;
    }

    /**
     * Set id_contientDocs.
     *
     * @param string $id_contientDocs
     *
     * @return Document
     */
    public function setIdContientDocs($id_contientDocs)
    {
        $this->id_contientDocs = $id_contientDocs;

        return $this;
    }

    /**
     * Get id_contientDocs.
     *
     * @return string
     */
    public function getIdContientDocs()
    {
        return $this->id_contientDocs;
    }

    /**
     * Set nomDocument.
     *
     * @param string $nomDocument
     *
     * @return Document
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
     * @return Document
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
     * @return Document
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
     * @return mixed
     */
    public function getDocsats()
    {
        return $this->docsats;
    }

    public function addDocsats(Docsat $docsats)
    {
        if (!$this->docsats->contains($docsats)) {
            $this->docsats[] = $docsats;
            $docsats->setIdDocument($this);
        }

        return $this;
    }

    public function removeDocsats(Docsat $docsats)
    {
        if ($this->docsats->contains($docsats)) {
            $this->docsats->removeElement($docsats);

            if ($docsats->getIdDocument() === $this) {
                $docsats->setIdDocument(null);
            }
        }

        return $this;
    }

}
