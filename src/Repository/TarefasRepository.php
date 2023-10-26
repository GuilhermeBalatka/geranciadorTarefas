<?php

namespace App\Repository;

use App\Entity\Tarefas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tarefas>
 *
 * @method Tarefas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tarefas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tarefas[]    findAll()
 * @method Tarefas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarefasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tarefas::class);
    }

//    /**
//     * @return Tarefas[] Returns an array of Tarefas objects
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

//    public function findOneBySomeField($value): ?Tarefas
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
