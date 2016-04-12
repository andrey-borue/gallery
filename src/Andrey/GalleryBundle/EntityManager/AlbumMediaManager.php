<?php

namespace Andrey\GalleryBundle\EntityManager;

use Andrey\GalleryBundle\Entity\Album;
use Andrey\GalleryBundle\Entity\AlbumMedia;
use Doctrine\ORM\Mapping as ORM;

/**
 * Album Media Manager
 * @author Andrey Borue <andrey@borue.ru>
 */
class AlbumMediaManager extends AbstractManager
{
    /**
     * @return string
     */
    public function getEntityClassName()
    {
//        return AlbumMedia::class;
        return 'Andrey\GalleryBundle\Entity\AlbumMedia';

    }

    /**
     * @param Album $album
     * @return \Doctrine\ORM\Query
     */
    public function getQueryForPaginator(Album $album)
    {
        $qb = $this->repository->createQueryBuilder('media');
        $qb
            ->where('media.album = :album')
            ->orderBy('media.position')
            ->setParameter('album', $album);

        $query = $qb->getQuery();

        return $query;
    }

}
