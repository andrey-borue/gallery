<?php

namespace Andrey\GalleryBundle\Controller;

use Andrey\GalleryBundle\EntityManager\AlbumManager;
use Andrey\GalleryBundle\Response\AlbumListResponse\AlbumListResponse;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Knp\Component\Pager\Paginator;

class ListController extends FOSRestController
{
    /**
     * @var AlbumManager
     */
    private $albumManager;
    /**
     * @var Paginator
     */
    private $paginator;

    public function __construct(
        AlbumManager $albumManager,
        Paginator $paginator
    ) {
        $this->albumManager = $albumManager;
        $this->paginator = $paginator;
    }


    /**
     *
     * @Rest\QueryParam(
     *      name="page", strict=true, nullable=true, requirements="[0-9]{1,2}", description="page number", default="1",
     * )
     *
     * @Rest\QueryParam(
     *      name="range", strict=true, nullable=true, requirements="[0-9]{1,2}", description="albums per page", default="10",
     * )
     *
     * @Rest\View()
     *
     * @param ParamFetcherInterface $paramFetcher
     * @return AlbumListResponse
     *
     * @throws \Exception
     */
    public function indexAction(ParamFetcherInterface $paramFetcher)
    {
        $range = $paramFetcher->get('range');
        $page = $paramFetcher->get('page');

        $query = $this->albumManager->getPaginatorQuery();

//        var_dump($this->paginator);
//        echo 2; exit;
        $pagination = $this->paginator->paginate(
            $query, /* query NOT result */
            $page,
            $range
        );

//        exit;
        var_dump($pagination); exit;


        $response = new AlbumListResponse();
        $response->createAlbum()
            ->setId(1)
            ->setName('name ' . $paramFetcher->get('limit'));

        return $response;
    }
}
