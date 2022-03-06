<?php

namespace App\Repository;

use App\Entity\Messages;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Messages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Messages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Messages[]    findAll()
 * @method Messages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Messages::class);
    }

    public function getids(User $user){
        $id = $user->getId();
        $query=$this->getEntityManager()->createQuery("
            SELECT m FROM App\Entity\Messages m WHERE m.sender=:me OR m.recipient=:me GROUP BY m.sender,m.recipient ORDER BY m.created_at DESC
        ")
            ->setParameter(':me',$id);
            return $query->getResult();
    }

    public function getmsgs(User $user, int $num){
        $id = $user->getId();
        $qb=$this->createQueryBuilder('m')
            ->select('m')
            ->from(Messages::class , 'm')
            ->where('m.sender=:id AND m.recipient=:me')
            ->update(Messages::class , 'm')
            ->set('m.is_read' , 1)
            ->setParameter(':me',$id)
            ->setParameter(':id',$num);
            $query = $qb->getQuery()->execute();

        $qb2 = $this ->createQueryBuilder('m')
            ->where('m.sender=:id AND m.recipient=:me OR  m.sender=:me AND m.recipient=:id')
            ->orderBy('m.created_at' , 'ASC')
            ->setParameter(':me',$id)
            ->setParameter(':id',$num);
        return $qb2->getQuery()->getResult();
    }

    public function notif(User $user){
        $id = $user->getId();
        $query=$this->getEntityManager()->createQuery("
            SELECT m FROM App\Entity\Messages m WHERE m.recipient=:me AND m.is_read=0
        ")
            ->setParameter(':me',$id);
        return $query->getResult();
    }
    // /**
    //  * @return Messages[] Returns an array of Messages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Messages
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
