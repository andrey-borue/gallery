<?php

namespace Andrey\GalleryBundle\Response\AlbumListResponse;

use JMS\Serializer\Annotation as S;

/**
 * @author Andrey Borue <andrey@borue.ru>
 * @S\ExclusionPolicy("ALL")
 */
class AlbumListResponse
{

    /**
     * @var Album[]
     * @S\Type("array<Andrey\GalleryBundle\Response\AlbumListResponse\Album>")
     * @S\Expose()
     */
    private $albums = [];

    /**
     * @return Album[]
     */
    public function getAlbums()
    {
        return $this->albums;
    }

    /**
     * @return Album
     */
    public function createAlbum()
    {
        return $this->albums[] = new Album;
    }



}
