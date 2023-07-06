<?php

namespace App\Repository;

use App\Entity\PokemonType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PokemonType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PokemonType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PokemonType[]    findAll()
 * @method PokemonType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * 
 * 
 */
class EntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PokemonType::class);
    }

   /**
 * @param int $userId
 * @return mixed[]
 * @throws \Doctrine\DBAL\DBALException
 */
public function getStatsByType(int $userId)
{
    $conn = $this->getEntityManager()->getConnection();
    $sql = 'SELECT libelle AS type, nb FROM (
        (SELECT type_1 AS type, COUNT(type_1) AS nb FROM ref_pokemon_type WHERE type_1 IS NOT NULL AND id_dresseur = :userId GROUP BY type_1)
        UNION
        (SELECT type_2 AS type, COUNT(type_2) AS nb FROM ref_pokemon_type WHERE type_2 IS NOT NULL AND id_dresseur = :userId GROUP BY type_2)
    ) AS tab LEFT JOIN ref_elementary_type ON tab.type = ref_elementary_type.id WHERE nb > 0;';

    $stmt = $conn->prepare($sql);
    $stmt->bindValue('userId', $userId);
    $stmt->execute();

    return $stmt->fetchAll();
}

    /**
     * @param int $userId
     * @return PokemonType[]
     */
    public function findAllByUserId(int $userId): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.idDresseur = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }


    /**
     * @return PokemonType[] Returns an array of PokemonType objects
     */
    public function getNbEvo(int $userId){
        $t = $this->findBy(["evolution"=> true, "idDresseur" => $userId]);
        
        return sizeof($t);
    }

    

    // /**
    //  * @return PokemonType[] Returns an array of PokemonType objects
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
    public function findOneBySomeField($value): ?PokemonType
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