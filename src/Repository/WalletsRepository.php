<?php

namespace App\Repository;

use App\Entity\Wallets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Wallets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wallets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wallets[]    findAll()
 * @method Wallets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WalletsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wallets::class);
    }

    // /**
    //  * @return Wallets[] Returns an array of Wallets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wallets
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
