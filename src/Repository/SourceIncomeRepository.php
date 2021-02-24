<?php

namespace App\Repository;

use App\Entity\SourceIncome;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SourceIncome|null find($id, $lockMode = null, $lockVersion = null)
 * @method SourceIncome|null findOneBy(array $criteria, array $orderBy = null)
 * @method SourceIncome[]    findAll()
 * @method SourceIncome[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SourceIncomeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SourceIncome::class);
    }

    public function countSourcePlace($value)
    {
        return $this->createQueryBuilder('c')
        ->select('COUNT(c.id)')
        ->andWhere('c.name = :name')
        ->setParameter('name',$value)
        ->getQuery()
        ->getSingleScalarResult();
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
    //  * @return SourceIncome[] Returns an array of SourceIncome objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SourceIncome
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
