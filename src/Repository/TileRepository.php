<?php

namespace App\Repository;

use App\Entity\Tile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tile>
 */
class TileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tile::class);
    }
public function findByViewDistance(int $playerQ, int $playerR, int $perception): array
{
    return $this->createQueryBuilder('t')
        ->where('t.coordQ BETWEEN :minQ AND :maxQ')
        ->andWhere('t.coordR BETWEEN :minR AND :maxR')
        ->setParameter('minQ', $playerQ - $perception)
        ->setParameter('maxQ', $playerQ + $perception)
        ->setParameter('minR', $playerR - $perception)
        ->setParameter('maxR', $playerR + $perception)
        ->getQuery()
        ->getResult();
}
    //    /**
    //     * @return Tile[] Returns an array of Tile objects
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

    //    public function findOneBySomeField($value): ?Tile
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
