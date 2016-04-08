<?php

namespace Andrey\GalleryBundle\Response;

use Andrey\GalleryBundle\Entity\AlbumMedia;

/**
 * Response for /api/media/list method
 * @author Andrey Borue <andrey@borue.ru>
 */
class MediaListResponse
{
    /**
     * @var AlbumMedia[]
     */
    private $medias = [];
    /**
     * @var integer
     */
    private $currentPage;
    /**
     * @var integer
     */
    private $pageCount;
    /**
     * @var integer
     */
    private $pageSize;

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     * @return $this
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;

        return $this;
    }

    /**
     * @return int
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }

    /**
     * @param int $pageCount
     * @return $this
     */
    public function setPageCount($pageCount)
    {
        $this->pageCount = $pageCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     * @return $this
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    /**
     * @return AlbumMedia
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * @param AlbumMedia[] $medias
     * @return $this
     */
    public function setMedias($medias)
    {
        $this->medias = $medias;

        return $this;
    }

    public function addMedia(AlbumMedia $media)
    {
        $this->medias[] = $media;
    }


}
