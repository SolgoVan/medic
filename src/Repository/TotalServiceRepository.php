<?php

namespace App\Repository;

use App\Entity\TotalService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TotalService>
 *
 * @method TotalService|null find($id, $lockMode = null, $lockVersion = null)
 * @method TotalService|null findOneBy(array $criteria, array $orderBy = null)
 * @method TotalService[]    findAll()
 * @method TotalService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TotalServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TotalService::class);
    }

    public function getTotalSumPerUser()
    {
        $result = $this->createQueryBuilder('ts')
            ->select('u.firstname', 'u.lastname', 'SUM(ts.total) AS totalSum', 'j.label AS jobLabel', 'j.salary AS jobSalary', 'j.billing_percentage AS percent', 'SUM(b.amount) AS amount')
            ->join('ts.user', 'u')
            ->leftJoin('u.job_grades', 'j')
            ->leftJoin('u.bills', 'b')
            ->groupBy('u.id')
            ->getQuery()
            ->getResult();

            foreach ($result as &$userData) {
                $totalSeconds = $userData['totalSum'];
                $hours = floor($totalSeconds / 3600);
                $minutes = floor(($totalSeconds % 3600) / 60);
                $seconds = $totalSeconds % 60;
                $userData['totalFormatted'] = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
            }

        return $result;
    }

//    /**
//     * @return TotalService[] Returns an array of TotalService objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TotalService
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
