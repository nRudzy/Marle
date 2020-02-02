<?php

namespace App\Repository;

use App\Entity\Reprographie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Reprographie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reprographie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reprographie[]    findAll()
 * @method Reprographie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReprographieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reprographie::class);
    }

    /**
     * @param $string
     * @return mixed
     */
    public function trouveSiReproDuMoisAnneeExiste($string)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "   SELECT MAX(r.numeroReprographie) FROM App:Reprographie r
	                     WHERE r.numeroReprographie LIKE :anneemois
	                     GROUP BY r.numeroReprographie
	                     ORDER BY r.numeroReprographie DESC    
	                 "
            );
        $query->setParameter('anneemois', $string.'%');
        return $query->getResult();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function trouverParIdTaxonomie($id)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "   SELECT r FROM App:Reprographie r
	                     WHERE r.id_taxonomie = :id
	                     ORDER BY r.deadline ASC
	                 "
            );
        $query->setParameter('id', $id);
        return $query->getResult();
    }

    /**
     * @param $nni
     * @return mixed
     */
    public function trouveToutEnTriantParDeadlineASCetPersonnelles($nni)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "   SELECT r FROM App:Reprographie r
                	     WHERE r.nni = :nni
	                     ORDER BY r.deadline ASC
	                 "
            );
        $query->setParameter('nni', $nni);
        return $query->getResult();
    }

    /**
     * @return mixed
     */
    public function trouveToutEnTriantParDeadlineASC()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "   SELECT r FROM App:Reprographie r
	                     ORDER BY r.deadline ASC
	                 "
            );
        return $query->getResult();
    }

    /**
     * @return mixed
     */
    public function trouverParIdTaxonomiePourPresta()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "   SELECT r FROM App:Reprographie r
                	     WHERE r.lieuTraitement = :Presta
                	     AND (  r.id_taxonomie = 4
                             OR r.id_taxonomie = 5
                             OR r.id_taxonomie = 6
                             OR r.id_taxonomie = 7 )
	                     ORDER BY r.deadline ASC
	                 "
            );
        $query->setParameter('Presta', 'Prestataire du site');
        return $query->getResult();
    }

    /**
     * @return mixed
     */
    public function trouverParIdTaxonomiePourDoc()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "   SELECT r FROM App:Reprographie r
                	     WHERE r.id_taxonomie = 2
                	     OR r.id_taxonomie = 3
                	     OR r.id_taxonomie = 9
	                     ORDER BY r.deadline ASC
	                 "
            );
        return $query->getResult();
    }

    /**
     * @return mixed
     */
    public function trouveLesIDOL()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "   SELECT r FROM App:Reprographie r
                	     WHERE r.id_taxonomie = 16
	                     ORDER BY r.deadline ASC
	                 "
            );
        return $query->getResult();
    }

    /**
     * @return mixed
     */
    public function trouveParAnnee($annee_supp) {
        $query = $this->getEntityManager()
            ->createQuery("
	            SELECT r FROM App:Reprographie r
                WHERE r.numeroReprographie LIKE :annee_supp
                ORDER BY r.dateDemande ASC"
            );
        $query->setParameter('annee_supp', $annee_supp.'%');
        return $query->getResult();
    }

    /**
     * @return mixed
     */
    public function trouveParMoisEtAnnee($mois,$annee) {
        $query = $this->getEntityManager()
            ->createQuery("
	            SELECT r FROM App:Reprographie r
                WHERE r.numeroReprographie LIKE :anneemois
                ORDER BY r.dateDemande ASC"
            );
        $query->setParameter('anneemois', '%'.$annee.'-'.$mois.'%');
        return $query->getResult();
    }

    /**
     * Fonction qui retourne les repro ayant une date de demande entre les dates en paramètre.
     * Le format des dates devra être : YYYY-mm-dd
     *
     * @param $dateDebut
     * @param $dateFin
     *
     * @return mixed
     */
    public function trouveEntreDeuxDatesPourDateDebut($dateDebut, $dateFin){
        $query = $this->getEntityManager()
            ->createQuery(
                "   SELECT r FROM App:Reprographie r
                	     WHERE r.dateDemande >= :dateDebut
                	     AND r.dateDemande <= :dateFin
	                     ORDER BY r.deadline ASC
	                 "
            );
        $query->setParameter('dateDebut', $dateDebut);
        $query->setParameter('dateFin', $dateFin);
        return $query->getResult();
    }

    /**
     * Fonction qui retourne les repro ayant une deadline entre les dates en paramètre.
     * Le format des dates devra être : YYYY-mm-dd
     *
     * @param $dateDebut
     * @param $dateFin
     *
     * @return mixed
     */
    public function trouveEntreDeuxDatesPourDeadline($dateDebut, $dateFin){
        $query = $this->getEntityManager()
            ->createQuery(
                "   SELECT r FROM App:Reprographie r
                	     WHERE r.deadline >= :dateDebut
                	     AND r.deadline <= :dateFin
	                     ORDER BY r.deadline ASC
	                 "
            );
        $query->setParameter('dateDebut', $dateDebut);
        $query->setParameter('dateFin', $dateFin);
        return $query->getResult();
    }
}
