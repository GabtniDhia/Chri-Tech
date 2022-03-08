<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\SearchData;
use App\Entity\Categorie;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }


    public function guess(Int $id){
        $query=$this->getEntityManager()->createQuery("
            SELECT p FROM APP\Entity\Produit p WHERE p.id <> :id
        ")
            ->setParameter(':id', $id);
        return $query->getResult();
    }
    /**
     * @return produit[];
     */

    public function findSearch (SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('p')
            ->select('categorie', 'p')
            ->join('p.categorie', 'categorie');

        if (!empty($search->q)) {
            $query = $query
                ->andWhere('p.NomProd LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }
        if (!empty($search->min)) {
            $query = $query
                ->andWhere('p.PrixUnitHTProd >= :min')
                ->setParameter('min', $search->min);
        }
        if (!empty($search->max)) {
            $query = $query
                ->andWhere('p.PrixUnitHtProd<= :max')
                ->setParameter('max', $search->max);
        }
        if (!empty($search->promo)) {
            $query = $query
                ->andWhere('p.promo =1');
        }
        if (!empty($search->categorie)) {
            $query = $query
                ->andWhere('categorie.id IN (:categories)')
                ->setParameter('categories', $search->categorie);
        }

        return $query->getQuery()->getResult();
    }






    // /**
    //  * @return Produit[] Returns an array of Produit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
