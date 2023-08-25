<?php

namespace App\Repository;

use App\Entity\PatientIdentities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PatientIdentities>
 *
 * @method PatientIdentities|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatientIdentities|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatientIdentities[]    findAll()
 * @method PatientIdentities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientIdentitiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PatientIdentities::class);
    }

//    /**
//     * @return PatientIdentities[] Returns an array of PatientIdentities objects
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

//    public function findOneBySomeField($value): ?PatientIdentities
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
