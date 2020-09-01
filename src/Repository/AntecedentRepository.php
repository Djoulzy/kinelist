<?php

namespace App\Repository;

use App\Entity\Antecedent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Antecedent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Antecedent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Antecedent[]    findAll()
 * @method Antecedent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AntecedentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Antecedent::class);
    }

    // /**
    //  * @return Antecedent[] Returns an array of Antecedent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Antecedent
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
