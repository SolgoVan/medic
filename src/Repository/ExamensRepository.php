<?php

namespace App\Repository;

use App\Entity\Examens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Examens>
 *
 * @method Examens|null find($id, $lockMode = null, $lockVersion = null)
 * @method Examens|null findOneBy(array $criteria, array $orderBy = null)
 * @method Examens[]    findAll()
 * @method Examens[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamensRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Examens::class);
    }

//    /**
//     * @return Examens[] Returns an array of Examens objects
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

//    public function findOneBySomeField($value): ?Examens
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
