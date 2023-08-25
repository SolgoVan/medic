<?php

namespace App\Repository;

use App\Entity\Patients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Patients>
 *
 * @method Patients|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patients|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patients[]    findAll()
 * @method Patients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patients::class);
    }

    public function findAllWithPatientIdenties()
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.patients_identities', 'pi')
            ->leftJoin('p.emergency_person', 'ep')
            ->getQuery()
            ->getResult();
    }

    public function findAllWithAllDetail()
    {
        return $this->createQueryBuilder('p')
        ->leftJoin('p.patients_identities', 'pi')
        ->leftJoin('p.emergency_person', 'ep')
        ->leftJoin('p.measurement', 'm')
        ->leftJoin('p.blood_group', 'bg')
        ->leftJoin('p.addiction', 'a')
        ->leftJoin('p.pathology', 'pt')
        ->getQuery()
        ->getResult();
    }
//    /**
//     * @return Patients[] Returns an array of Patients objects
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

//    public function findOneBySomeField($value): ?Patients
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
