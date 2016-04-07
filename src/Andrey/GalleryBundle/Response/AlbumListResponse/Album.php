<?php

namespace Andrey\GalleryBundle\Response\AlbumListResponse;

use JMS\Serializer\Annotation as S;

/**
 * @author Andrey Borue <andrey@borue.ru>
 * @S\ExclusionPolicy("ALL")
 */
class Album
{
    /**
     * ID
     * @var integer
     * @S\Type("integer")
     * @S\Expose()
     */
    private $id;

    /**
     * Name
     * @var integer
     * @S\Type("string")
     * @S\Expose()
     */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
