<?php

namespace App\Repository;

use App\Entity\Citation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Citation>
 *
 * @method Citation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Citation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Citation[]    findAll()
 * @method Citation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CitationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Citation::class);
    }

    public function save(Citation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Citation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

}
