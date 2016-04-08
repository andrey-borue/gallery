<?php

namespace Andrey\GalleryBundle\EntityManager;

use Andrey\GalleryBundle\Entity\Album;
use Doctrine\ORM\Mapping as ORM;

/**
 * Album Manager
 * @author Andrey Borue <andrey@borue.ru>
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

    /**
     * @param $id
     * @return Album|object
     */
    public function findById($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param int $mediasPerAlbum
     * @return array
     */
    public function getAlbumsPreview($mediasPerAlbum)
    {
        // Of course I can map the result to objects, I don't like to transfer arrays
        // But for performance array is normal
        // Or I can rewrite API on golang for better performance =)
        $q = $this->entityManager->createQuery('
                  select partial album.{id,name}, partial media.{id, position, url}
                  from Andrey\GalleryBundle\Entity\Album album
                  JOIN album.medias media
                  WHERE media.position < :mediaPerAlbum
                  ORDER BY album.id, media.position
              ')->setParameter('mediaPerAlbum', $mediasPerAlbum);

        return $q->getResult();
    }

}
