<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Reprographie
 *
 * @ORM\Table(name="reprographie")
 * @ORM\Entity(repositoryClass="App\Repository\ReprographieRepository")
 */
class Reprographie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reprographie", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("repro:read")
     */
    private $id_reprographie;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     * @Groups("repro:read")
     */
    private $titre;

    /**
     * @var int
     *
     * @ORM\Column(name="numeroReprographie", type="string", length=100, unique=true)
     * @Groups("repro:read")
     */
    private $numeroReprographie;

    /**
     * @var string
     *
     * @ORM\Column(name="typeDocument", type="string", length=255)
     * @Groups("repro:read")
     */
    private $typeDocument;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDemande", type="datetime")
     * @Groups("repro:read")
     */
    private $dateDemande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadline", type="datetime")
     * @Groups("repro:read")
     */
    private $deadline;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadline_old", type="datetime", nullable=true)
     * @Groups("repro:read")
     */
    private $deadlineOld;

    /**
     * @var string
     *
     * @ORM\Column(name="moment_journee", type="string", length=100, nullable=true)
     * @Groups("repro:read")
     */
    private $momentJournee;

    /**
     * @var bool
     *
     * @ORM\Column(name="est_urgence", type="boolean")
     * @Groups("repro:read")
     */
    private $estUrgence;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_reception", type="string", length=100)
     * @Groups("repro:read")
     */
    private $lieuReception;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_traitement", type="string", length=100, nullable=true)
     * @Groups("repro:read")
     */
    private $lieuTraitement;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_renvoie", type="string", length=100, nullable=true)
     * @Groups("repro:read")
     */
    private $lieuRenvoie;

    /**
     * @var string
     *
     * @ORM\Column(name="service_demandeur", type="string", length=10)
     * @Groups("repro:read")
     */
    private $serviceDemandeur;

    /**
     * @var string
     *
     * @ORM\Column(name="motif_annulation", type="text", nullable=true)
     * @Groups("repro:read")
     */
    private $motifAnnulation;

    /**
     * @ORM\ManyToOne(targetEntity="Taxonomie", inversedBy="repros")
     * @ORM\JoinColumn(name="id_taxonomie", referencedColumnName="id_taxonomie")
     * @Groups("repro:read")
     */
    private $id_taxonomie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="repros")
     * @ORM\JoinColumn(name="nni", referencedColumnName="nni")
     * @Groups("repro:read")
     */
    private $nni;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur")
     * @ORM\JoinColumn(name="nni_valideur_doc", referencedColumnName="nni")
     * @Groups("repro:read")
     */
    private $nni_valideur_doc;

    /**
     * @ORM\OneToMany(targetEntity="ContientDoc", mappedBy="id_reprographie" , fetch="EAGER")
     * @Groups("repro:read")
     */
    private $contientDocs;

    /**
     * @var string
     *
     * @ORM\Column(name="observations", type="text", nullable=true)
     * @Groups("repro:read")
     */
    private $observations;

    /**
     * @var string
     *
     * @ORM\Column(name="filigrane", type="string", nullable=true)
     * @Groups("repro:read")
     */
    private $filigrane;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_mise_en_place", type="datetime", nullable=true)
     * @Groups("repro:read")
     */
    private $dateMiseEnPlace;

    public function __construct()
    {
        $this->contientDocs = new ArrayCollection();
    }

    /**
     * Get id_reprographie.
     *
     * @return int
     */
    public function getIdReprographie()
    {
        return $this->id_reprographie;
    }

    /**
     * Set titre.
     *
     * @param string $titre
     *
     * @return Reprographie
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre.
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set numeroReprographie.
     *
     * @param int $numeroReprographie
     *
     * @return Reprographie
     */
    public function setNumeroReprographie($numeroReprographie)
    {
        $this->numeroReprographie = $numeroReprographie;

        return $this;
    }

    /**
     * Get numeroReprographie.
     *
     * @return int
     */
    public function getNumeroReprographie()
    {
        return $this->numeroReprographie;
    }

    /**
     * Set typeDocument.
     *
     * @param string $typeDocument
     *
     * @return Reprographie
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
     * Set dateDemande.
     *
     * @param \DateTime $dateDemande
     *
     * @return Reprographie
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    /**
     * Get dateDemande.
     *
     * @return \DateTime
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }

    /**
     * Set deadline.
     *
     * @param \DateTime $deadline
     *
     * @return Reprographie
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * Get deadline.
     *
     * @return \DateTime
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set deadlineOld.
     *
     * @param \DateTime $deadlineOld
     *
     * @return Reprographie
     */
    public function setDeadlineOld($deadlineOld)
    {
        $this->deadlineOld = $deadlineOld;

        return $this;
    }

    /**
     * Get deadlineOld.
     *
     * @return \DateTime
     */
    public function getDeadlineOld()
    {
        return $this->deadlineOld;
    }

    /**
     * Set momentJournee.
     *
     * @param string $momentJournee
     *
     * @return Reprographie
     */
    public function setMomentJournee($momentJournee)
    {
        $this->momentJournee = $momentJournee;

        return $this;
    }

    /**
     * Get momentJournee.
     *
     * @return string
     */
    public function getMomentJournee()
    {
        return $this->momentJournee;
    }

    /**
     * Set estUrgence.
     *
     * @param bool $estUrgence
     *
     * @return Reprographie
     */
    public function setEstUrgence($estUrgence)
    {
        $this->estUrgence = $estUrgence;

        return $this;
    }

    /**
     * Get estUrgence.
     *
     * @return bool
     */
    public function getEstUrgence()
    {
        return $this->estUrgence;
    }

    /**
     * Set lieuReception.
     *
     * @param string $lieuReception
     *
     * @return Reprographie
     */
    public function setLieuReception($lieuReception)
    {
        $this->lieuReception = $lieuReception;

        return $this;
    }

    /**
     * Get lieuReception.
     *
     * @return string
     */
    public function getLieuReception()
    {
        return $this->lieuReception;
    }

    /**
     * Set id_taxonomie.
     *
     * @param string $id_taxonomie
     *
     * @return Reprographie
     */
    public function setIdTaxonomie($id_taxonomie)
    {
        $this->id_taxonomie = $id_taxonomie;

        return $this;
    }

    /**
     * Get id_taxonomie.
     *
     * @return string
     */
    public function getIdTaxonomie()
    {
        return $this->id_taxonomie;
    }

    /**
     * Set nni.
     *
     * @param string $nni
     *
     * @return Reprographie
     */
    public function setNni($nni)
    {
        $this->nni = $nni;

        return $this;
    }

    /**
     * Get nni.
     *
     * @return string
     */
    public function getNni()
    {
        return $this->nni;
    }

    /**
     * Set nni_valideur_doc.
     *
     * @param string $nni_valideur_doc
     *
     * @return Reprographie
     */
    public function setNniValideurDoc($nni_valideur_doc)
    {
        $this->nni_valideur_doc = $nni_valideur_doc;

        return $this;
    }

    /**
     * Get nni_valideur_doc.
     *
     * @return string
     */
    public function getNniValideurDoc()
    {
        return $this->nni_valideur_doc;
    }

    /**
     * Get lieuTraitement.
     *
     * @return string
     */
    public function getLieuTraitement()
    {
        return $this->lieuTraitement;
    }

    /**
     * Set lieuTraitement.
     *
     * @param string $lieuTraitement
     *
     * @return Reprographie
     */
    public function setLieuTraitement($lieuTraitement)
    {
        $this->lieuTraitement = $lieuTraitement;

        return $this;
    }

    /**
     * Get lieuRenvoie.
     *
     * @return string
     */
    public function getLieuRenvoie()
    {
        return $this->lieuRenvoie;
    }

    /**
     * Set lieuRenvoie.
     *
     * @param string $lieuRenvoie
     *
     * @return Reprographie
     */
    public function setLieuRenvoie($lieuRenvoie)
    {
        $this->lieuRenvoie = $lieuRenvoie;

        return $this;
    }

    /**
     * Get motifAnnulation.
     *
     * @return string
     */
    public function getMotifAnnulation()
    {
        return $this->motifAnnulation;
    }

    /**
     * Set motifAnnulation.
     *
     * @param string $motifAnnulation
     *
     * @return Reprographie
     */
    public function setMotifAnnulation($motifAnnulation)
    {
        $this->motifAnnulation = $motifAnnulation;

        return $this;
    }

    /**
     * Get serviceDemandeur.
     *
     * @return string
     */
    public function getServiceDemandeur()
    {
        return $this->serviceDemandeur;
    }

    /**
     * Set serviceDemandeur.
     *
     * @param string $serviceDemandeur
     *
     * @return Reprographie
     */
    public function setServiceDemandeur($serviceDemandeur)
    {
        $this->serviceDemandeur = $serviceDemandeur;

        return $this;
    }

    /**
     * Get observations.
     *
     * @return string
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Set observations.
     *
     * @param string $observations
     *
     * @return Reprographie
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get filigrane.
     *
     * @return string
     */
    public function getFiligrane()
    {
        return $this->filigrane;
    }

    /**
     * Set observations.
     *
     * @param string $filigrane
     *
     * @return Reprographie
     */
    public function setFiligrane($filigrane)
    {
        $this->filigrane = $filigrane;

        return $this;
    }

    /**
     * Set dateMiseEnPlace.
     *
     * @param \DateTime $dateMiseEnPlace
     *
     * @return Reprographie
     */
    public function setDateMiseEnPlace($dateMiseEnPlace)
    {
        $this->dateMiseEnPlace = $dateMiseEnPlace;

        return $this;
    }

    /**
     * Get dateMiseEnPlace.
     *
     * @return \DateTime
     */
    public function getDateMiseEnPlace()
    {
        return $this->dateMiseEnPlace;
    }

    /**
     * @return mixed
     */
    public function getContientDocs()
    {
        return $this->contientDocs;
    }

    public function addContientDocs(ContientDoc $contientDocs)
    {
        if (!$this->contientDocs->contains($contientDocs)) {
            $this->contientDocs[] = $contientDocs;
            $contientDocs->setIdReprographie($this);
        }

        return $this;
    }

    public function removeContientDocs(ContientDoc $contientDocs)
    {
        if ($this->contientDocs->contains($contientDocs)) {
            $this->contientDocs->removeElement($contientDocs);

            if ($contientDocs->getIdReprographie() === $this) {
                $contientDocs->setIdReprographie(null);
            }
        }

        return $this;
    }



}
