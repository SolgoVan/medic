<?php

namespace App\Repository;

use App\Entity\EmergencyPeople;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmergencyPeople>
 *
 * @method EmergencyPeople|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmergencyPeople|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmergencyPeople[]    findAll()
 * @method EmergencyPeople[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmergencyPeopleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmergencyPeople::class);
    }

//    /**
//     * @return EmergencyPeople[] Returns an array of EmergencyPeople objects
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

//    public function findOneBySomeField($value): ?EmergencyPeople
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
