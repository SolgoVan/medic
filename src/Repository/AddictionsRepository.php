<?php

namespace App\Repository;

use App\Entity\Addictions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Addictions>
 *
 * @method Addictions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Addictions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Addictions[]    findAll()
 * @method Addictions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddictionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Addictions::class);
    }

//    /**
//     * @return Addictions[] Returns an array of Addictions objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Addictions
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
