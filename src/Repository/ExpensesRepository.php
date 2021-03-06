<?php

namespace App\Repository;

use App\Entity\Expenses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Expenses|null find($id, $lockMode = null, $lockVersion = null)
 * @method Expenses|null findOneBy(array $criteria, array $orderBy = null)
 * @method Expenses[]    findAll()
 * @method Expenses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpensesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Expenses::class);
    }

    public function ViewInformation($user_id,$value): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT `description`,`amount`,DATE_FORMAT(`date`,'%Y-%m-%d') AS `formatted_date` FROM `expenses` 
                WHERE `user_id` = :user_id
                AND `category_id` = :category_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id,'category_id' => $value]);
        return $stmt->fetchAllAssociative();

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
    //  * @return Expenses[] Returns an array of Expenses objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Expenses
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
