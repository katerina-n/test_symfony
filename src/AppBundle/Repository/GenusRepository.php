<?php
namespace AppBundle\Repository ;
use Doctrine\ORM\EntityRepository ;
class GenusRepository extends EntityRepository
{
    /*
   *@return Genus[]
   */
    public function findAllPublishedOrderedBySize ()
    {
        return $this ->createQueryBuilder( 'genus' )
            ->orderBy('genus.number', 'DESC')
            ->getQuery()
            ->execute();
    }
}