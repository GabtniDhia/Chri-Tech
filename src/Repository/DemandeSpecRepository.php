<?php

namespace App\Repository;

use App\Entity\DemandeSpec;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DemandeSpec|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandeSpec|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandeSpec[]    findAll()
 * @method DemandeSpec[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeSpecRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandeSpec::class);
    }

    // /**
    //  * @return DemandeSpec[] Returns an array of DemandeSpec objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DemandeSpec
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
