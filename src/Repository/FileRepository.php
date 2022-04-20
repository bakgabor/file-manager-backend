<?php

namespace App\Repository;

use App\Entity\Files\File;
use Doctrine\ORM\EntityRepository;

/**
 * @method File|null find($id, $lockMode = null, $lockVersion = null)
 * @method File|null findOneBy(array $criteria, array $orderBy = null)
 * @method File[]    findAll()
 * @method File[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FileRepository  extends EntityRepository
{

    public function getList($page, $interval)
    {
        $fields = array('d.id', 'd.title', 'd.description',
            'd.keywords',  'd.originalName',  'd.mimeType',
            'd.insertedAtTime', 'd.updatedAtTime', 'd.path' );

        $query = $this->createQueryBuilder('d')
            ->select($fields)
            ->setFirstResult($page)
            ->setMaxResults($interval);

        return $query->getQuery()
            ->getArrayResult();
    }

    public function getRowCount()
    {
        return $this->createQueryBuilder('d')
            ->select('count(d.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function search($words) {
        $QueryBuilder = $this->createQueryBuilder('f')
            ->select('f');

        foreach ($words as $key => $word){
            $QueryBuilder->orWhere('f.keywords LIKE :param'.$key)->setParameter('param'.$key, '%'.$word.'%');
        }

        return $QueryBuilder->getQuery()->getArrayResult();
    }

}
