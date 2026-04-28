<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\Folder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function countByFolder(Folder $folder): int
    {
        return $this->createQueryBuilder('t')
            ->select('COUNT(t.id)')
            ->andWhere('t.folder = :folder')
            ->setParameter('folder', $folder)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findByFilters(?string $status, ?string $priority): array
    {
        $qb = $this->createQueryBuilder('t')
            ->orderBy('t.id', 'DESC');

        if ($status) {
            $qb->andWhere('t.status = :status')
               ->setParameter('status', $status);
        }

        if ($priority) {
            $qb->leftJoin('t.priority', 'p')
               ->andWhere('p.level = :priority')
               ->setParameter('priority', $priority);
        }

        return $qb->getQuery()->getResult();
    }
}