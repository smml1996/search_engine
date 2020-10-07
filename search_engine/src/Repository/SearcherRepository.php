<?php

namespace App\Repository;

use App\Entity\Searcher;
use App\Entity\Webpage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Searcher|null find($id, $lockMode = null, $lockVersion = null)
 * @method Searcher|null findOneBy(array $criteria, array $orderBy = null)
 * @method Searcher[]    findAll()
 * @method Searcher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SearcherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Searcher::class);
    }

    public function getSearchResults($words, $limit){

        $conn = $this->getEntityManager()->getConnection();
        $temp_query = '';

        foreach($words as $word){
            if($temp_query == ''){
                $temp_query= $temp_query." words.word LIKE '".$word."%' ";
            }else{
                $temp_query= $temp_query." OR words.word LIKE '".$word."%' ";
            }
        }


        $final_query = 'select * from searcher inner join words on words.id = searcher.word_id INNER join webpage on searcher.webpage_id = webpage.id where ';
        $final_query = $final_query . $temp_query .  '  order by  searcher.occurences, webpage.pagerank DESC limit ' . $limit . ';';
        $stmt = $conn->prepare($final_query);
        $stmt->execute();

        return $stmt;
    }




    // /**
    //  * @return Searcher[] Returns an array of Searcher objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Searcher
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
