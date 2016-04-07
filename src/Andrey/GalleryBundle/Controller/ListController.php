<?php

namespace Andrey\GalleryBundle\Controller;

use Andrey\GalleryBundle\Response\AlbumListResponse\AlbumListResponse;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;

class ListController extends FOSRestController
{


    /**
     *
     * @Rest\QueryParam(
     *      name="limit", strict=true, nullable=true, requirements="[0-9]{1,2}", description="gallery per page", default="10"
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


        $response = new AlbumListResponse();
        $response->createAlbum()
            ->setId(1)
            ->setName('name ' . $paramFetcher->get('limit'));

        return $response;
    }
}
