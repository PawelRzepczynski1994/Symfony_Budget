<?php

namespace App\Repository;

use App\Entity\PlaceExpenses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlaceExpenses|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaceExpenses|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaceExpenses[]    findAll()
 * @method PlaceExpenses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceExpensesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaceExpenses::class);
    }

    public function countNamePlace($value)
    {
         return $this->createQueryBuilder('c')
        ->select('COUNT(c.id)')
        ->andWhere('c.name = :name')
        ->setParameter('name',$value)
        ->getQuery()
        ->getSingleScalarResult();
    }
    
    public function findbyUserId($userId)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.id_user = :userId')
            ->setParameter('userId',$userId)
            ->getQuery()
            ->getResult();
    }

    public function save($object): void
    {
        $this->_em->persist($object);
        $this->_em->flush();
    }

    public function remove($object): void
    {
        $this->_em->remove($object);
        $this->_em->flush();
    }

    public function update(): void
    {
        $this->_em->flush();
    }
    // /**
    //  * @return PlaceExpenses[] Returns an array of PlaceExpenses objects
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
    public function findOneBySomeField($value): ?PlaceExpenses
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
