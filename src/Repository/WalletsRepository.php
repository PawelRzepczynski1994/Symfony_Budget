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
    
    public function findbyUserId($userId)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.id_user = :userId')
            ->setParameter('userId',$userId)
            ->getQuery()
            ->getResult();
    }
    public function countNumberWallets($name)
    {
        return $this->createQueryBuilder('w')
        ->select('COUNT(w.id)')
        ->andWhere('w.name = :name')
        ->setParameter('name',$name)
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
