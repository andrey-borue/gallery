<?php

namespace Andrey\GalleryBundle\EntityManager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class AbstractManager
{
    /**
     * @var EntityRepository
     */
    protected $repository;
    /**
     * @var EntityManager
     */
    protected $entityManager;
    /**
     * @var string
     */
    protected $entityClassName;


    public function __construct(EntityManager $entityManager)
    {
        $this
            ->setEntityManager($entityManager)
            ->setRepository();
    }

    /**
     * @return static
     */
    public function setRepository()
    {
        if ($this->getEntityClassName()) {
            $this->repository = $this->entityManager->getRepository($this->getEntityClassName());
        }

        return $this;
    }

    /**
     * @param EntityManager $entityManager
     *
     * @return static
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    /**
     * FQCN — full name of manager class
     * @return string
     */
    abstract public function getEntityClassName();
}
