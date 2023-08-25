<?php

namespace App\Repository;

use App\Entity\StartService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StartService>
 *
 * @method StartService|null find($id, $lockMode = null, $lockVersion = null)
 * @method StartService|null findOneBy(array $criteria, array $orderBy = null)
 * @method StartService[]    findAll()
 * @method StartService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StartServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StartService::class);
    }

//    /**
//     * @return StartService[] Returns an array of StartService objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StartService
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
