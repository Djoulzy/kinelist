<?php

namespace App\Repository;

use App\Entity\Antecedant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Antecedant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Antecedant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Antecedant[]    findAll()
 * @method Antecedant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AntecedantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Antecedant::class);
    }

    // /**
    //  * @return Antecedant[] Returns an array of Antecedant objects
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
    public function findOneBySomeField($value): ?Antecedant
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
