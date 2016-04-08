<?php

namespace Andrey\GalleryBundle\EntityManager;

use Andrey\GalleryBundle\Entity\Album;
use Doctrine\ORM\Mapping as ORM;

/**
 * Album
 */
class AlbumManager extends AbstractManager
{
    /**
     * @return string
     */
    public function getEntityClassName()
    {
        return Album::class;
    }

    public function getPaginatorQuery()
    {

        $qb = $this->repository->createQueryBuilder('album');

        $query = $qb->getQuery();

        return $query;
    }

}
