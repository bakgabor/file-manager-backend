<?php

namespace App\Repository;

use App\Entity\Files\SimpleFile;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SimpleFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method SimpleFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method SimpleFile[]    findAll()
 * @method SimpleFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SimpleFileRepository extends EntityRepository
{

    public function getList($page, $interval)
    {
        $fields = array(
            'f.id', 'f.originalName',  'f.mimeType',
            'f.insertedAtTime', 'f.updatedAtTime', 'f.path'
        );

        $query = $this->createQueryBuilder('f')
            ->select($fields)
            ->setFirstResult($page)
            ->setMaxResults($interval);

        return $query->getQuery()
            ->getArrayResult();
    }

    public function search($words) {
        $QueryBuilder = $this->createQueryBuilder('f')
            ->select('f');

        foreach ($words as $key => $word){
            $QueryBuilder->orWhere('f.keywords LIKE :param'.$key)->setParameter('param'.$key, '%'.$word.'%');
        }

        return $QueryBuilder->getQuery()->getArrayResult();
    }

    public function getRowCount()
    {
        return $this->createQueryBuilder('d')
            ->select('count(d.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

}
