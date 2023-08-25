<?php

namespace App\Repository;

use App\Entity\Pathologies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pathologies>
 *
 * @method Pathologies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pathologies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pathologies[]    findAll()
 * @method Pathologies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PathologiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pathologies::class);
    }

//    /**
//     * @return Pathologies[] Returns an array of Pathologies objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Pathologies
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
