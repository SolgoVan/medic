<?php

namespace App\Repository;

use App\Entity\EndService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EndService>
 *
 * @method EndService|null find($id, $lockMode = null, $lockVersion = null)
 * @method EndService|null findOneBy(array $criteria, array $orderBy = null)
 * @method EndService[]    findAll()
 * @method EndService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EndServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EndService::class);
    }

//    /**
//     * @return EndService[] Returns an array of EndService objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EndService
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
