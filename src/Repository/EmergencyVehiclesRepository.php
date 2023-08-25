<?php

namespace App\Repository;

use App\Entity\EmergencyVehicles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmergencyVehicles>
 *
 * @method EmergencyVehicles|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmergencyVehicles|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmergencyVehicles[]    findAll()
 * @method EmergencyVehicles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmergencyVehiclesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmergencyVehicles::class);
    }

//    /**
//     * @return EmergencyVehicles[] Returns an array of EmergencyVehicles objects
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

//    public function findOneBySomeField($value): ?EmergencyVehicles
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
