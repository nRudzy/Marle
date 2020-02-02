<?php

namespace App\Repository;

use App\Entity\ContientDoc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContientDoc|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContientDoc|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContientDoc[]    findAll()
 * @method ContientDoc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContientDocRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContientDoc::class);
    }

    // /**
    //  * @return ContientDoc[] Returns an array of ContientDoc objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContientDoc
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
