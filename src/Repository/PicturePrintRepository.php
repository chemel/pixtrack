<?php

namespace App\Repository;

use App\Entity\PicturePrint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PicturePrint|null find($id, $lockMode = null, $lockVersion = null)
 * @method PicturePrint|null findOneBy(array $criteria, array $orderBy = null)
 * @method PicturePrint[]    findAll()
 * @method PicturePrint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PicturePrintRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PicturePrint::class);
    }

    // /**
    //  * @return PicturePrint[] Returns an array of PicturePrint objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PicturePrint
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
