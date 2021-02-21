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

    public function ViewFixedExpenses($value): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT fe.*,c.name as cname,pe.name as pename,w.name as wname
                FROM `fixed_expenses` fe
                INNER JOIN `category` c
                INNER JOIN `place_expenses` pe
                INNER JOIN `wallets` w
                WHERE fe.`id_user` = :id_user AND
                c.id = fe.id_category AND 
                pe.id = fe.id_place_expenses AND
                w.id = fe.id_wallet';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id_user' => $value]);
        return $stmt->fetchAllAssociative();
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
