<?php

namespace App\Repository;

use App\Entity\FilterLivre;
use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    public function SearchQuery(FilterLivre $search)
    {

        $query = $this->createQueryBuilder('l')
            ->leftJoin('l.categorie', 'cat')
            ->leftJoin('l.auteur', 'aut')
        ;

        if ($search->getName()) {
            $query = $query
                ->andWhere('l.name LIKE :livreName')
                ->setParameter('livreName', '%' . $search->getName() . '%')
            ;
        }
        if ($search->getDate()) {
            $query = $query
                ->andWhere('l.date LIKE :livreDate')
                ->setParameter('livreDate', $search->getDate() . '%')
            ;
        }
        if ($search->getCategorie()) {
            foreach ($search->getCategorie() as $categ) {
                $val = 'livreCategorie'.$categ->getId();
                $query = $query
                    ->orWhere('cat.name = :livreCategorie'.$categ->getId())
                    ->setParameter($val, $categ->getName());
            }
        }
        if ($search->getAuteur()) {
            $query = $query
                ->andWhere('aut.name = :livreAuteur')
                ->setParameter('livreAuteur', $search->getAuteur()->getName())
            ;
        }

        $query = $query->getQuery();
        return $query->getResult();
    }

    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
