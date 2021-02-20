<?php

namespace App\Repository;

use App\Entity\FixedExpenses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FixedExpenses|null find($id, $lockMode = null, $lockVersion = null)
 * @method FixedExpenses|null findOneBy(array $criteria, array $orderBy = null)
 * @method FixedExpenses[]    findAll()
 * @method FixedExpenses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FixedExpensesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FixedExpenses::class);
    }

    public function countNameFixedExspenses($value)
    {
        return $this->createQueryBuilder('c')
        ->select('COUNT(c.id)')
        ->andWhere('c.name = :name')
        ->setParameter('name',$value)
        ->getQuery()
        ->getSingleScalarResult();
    }
    // /**
    //  * @return FixedExpenses[] Returns an array of FixedExpenses objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FixedExpenses
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
