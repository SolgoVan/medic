<?php

namespace App\Repository;

use App\Entity\JobGrades;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JobGrades>
 *
 * @method JobGrades|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobGrades|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobGrades[]    findAll()
 * @method JobGrades[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobGradesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobGrades::class);
    }

//    /**
//     * @return JobGrades[] Returns an array of JobGrades objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JobGrades
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
