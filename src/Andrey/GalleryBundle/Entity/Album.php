<?php
namespace Andrey\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Album Model
 * @author Andrey Borue <andrey@borue.ru>
 */
class Album
{
    /**
     * Album ID
     * @var int
     */
    private $id;

    /**
     * Albun name
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $position;

    /**
     * Media collection
     * @var AlbumMedia[]|ArrayCollection
     */
    private $medias;

    public function __construct()
    {
        $this->medias = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return AlbumMedia[]|ArrayCollection
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * @param AlbumMedia[]|ArrayCollection $medias
     * @return $this
     */
    public function setMedias($medias)
    {
        $this->medias = new ArrayCollection();
        foreach ($medias as $media) {
            $this->addMedia($media);
        }

        return $this;
    }

    /**
     * @param AlbumMedia $media
     */
    public function addMedia(AlbumMedia $media)
    {
        $this->medias->add($media);
        $media->setAlbum($this);
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Album
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}
