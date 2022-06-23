<?php

namespace App\Repository;

use App\Entity\Car;
use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    // /**
    //  * @return Customer[] Returns an array of Customer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Customer
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


     // SELECT name, birth_date, is_young_driver FROM customer Order by is_young_driver DESC, name ASC; 
    /**
    * @return Customer[]
    */
   public function findAllAsc()
   {

        return $this->createQueryBuilder('c')
        ->select('c.name, c.birthDate, c.isYoungDriver')
        ->orderBy('c.birthDate', 'ASC')
        ->addOrderBy('c.isYoungDriver','ASC')
        ->getQuery()
        ->getArrayResult();
   }

    /**
    * @return Customer[]
    */
    public function findAllDesc()
    {
        return $this->createQueryBuilder('c')
        ->select('c.name, c.birthDate, c.isYoungDriver')
        ->orderBy('c.birthDate','DESC')
        ->addOrderBy('c.isYoungDriver','ASC')
        ->getQuery()
        ->getArrayResult();
    }

    
       /**
    * @return Car[]
    */
    public function Carform()
    {
        return $this->createQueryBuilder('h')
        ->select('h.make, h.model, h.travelledDistance')
        ->where('h.make = BMW')
        ->OrderBy('h.model','ASC')
        ->addOrderBy('h.isYoungDriver','DESC')
        ->getQuery()
        ->getArrayResult();
    }
    
}
