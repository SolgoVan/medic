<?php

namespace App\Repository;

use App\Entity\BloodGroups;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BloodGroups>
 *
 * @method BloodGroups|null find($id, $lockMode = null, $lockVersion = null)
 * @method BloodGroups|null findOneBy(array $criteria, array $orderBy = null)
 * @method BloodGroups[]    findAll()
 * @method BloodGroups[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BloodGroupsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BloodGroups::class);
    }

//    /**
//     * @return BloodGroups[] Returns an array of BloodGroups objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BloodGroups
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
