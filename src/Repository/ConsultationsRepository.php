<?php

namespace App\Repository;

use App\Entity\Consultations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Consultations>
 *
 * @method Consultations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consultations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consultations[]    findAll()
 * @method Consultations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsultationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Consultations::class);
    }

    public function findAllWithName()
    {
        return $this->createQueryBuilder('c')
            ->select('c', 'practitioner', 'patients_identities')
            ->leftJoin('c.practitioner', 'practitioner')
            ->leftJoin('c.patients_identities', 'patients_identities')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Consultations[] Returns an array of Consultations objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Consultations
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
