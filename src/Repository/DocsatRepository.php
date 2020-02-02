<?php

namespace App\Repository;

use App\Entity\Docsat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Docsat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Docsat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Docsat[]    findAll()
 * @method Docsat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocsatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Docsat::class);
    }

    /**
     * @param $id_document
     * @param $id_satellite
     * @return mixed
     */
    public function trouverDocsatsDecochees($id_document, $id_satellite)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "   SELECT d FROM AppBundle:Docsat d
	                     WHERE d.id_satellite != :id_satellite
	                     AND d.id_document = :id_document
	                     ORDER BY d.id_satellite ASC
	                 "
            );
        $query->setParameter('id_satellite', $id_satellite);
        $query->setParameter('id_document', $id_document);
        return $query->getResult();
    }
}
