<?php

namespace App\Repository;

use App\Entity\ResidenceStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResidenceStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResidenceStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResidenceStation[]    findAll()
 * @method ResidenceStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResidenceStationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResidenceStation::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ResidenceStation $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ResidenceStation $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return ResidenceStation[] Returns an array of ResidenceStation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResidenceStation
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
