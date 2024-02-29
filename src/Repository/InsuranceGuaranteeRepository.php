<?php

namespace App\Repository;

use App\Entity\InsuranceGuarantee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InsuranceGuarantee>
 *
 * @method InsuranceGuarantee|null find($id, $lockMode = null, $lockVersion = null)
 * @method InsuranceGuarantee|null findOneBy(array $criteria, array $orderBy = null)
 * @method InsuranceGuarantee[]    findAll()
 * @method InsuranceGuarantee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InsuranceGuaranteeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InsuranceGuarantee::class);
    }

//    /**
//     * @return InsuranceGuarantee[] Returns an array of InsuranceGuarantee objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InsuranceGuarantee
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
