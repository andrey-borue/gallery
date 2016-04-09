<?php

namespace Andrey\GalleryBundle\Controller;

use Andrey\GalleryBundle\EntityManager\AlbumMediaManager;
use Andrey\GalleryBundle\EntityManager\AlbumManager;
use Andrey\GalleryBundle\Response\MediaListResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Knp\Component\Pager\Paginator;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @author Andrey Borue <andrey@borue.ru>
 * @package Andrey\GalleryBundle\Controller
 */
class AlbumController extends Controller
{
    /**
     * @var AlbumMediaManager
     */
    private $albumMediaManager;
    /**
     * @var AlbumManager
     */
    private $albumManager;
    /**
     * @var Paginator
     */
    private $paginator;

    public function __construct(
        AlbumMediaManager $albumMediaManager,
        AlbumManager $albumManager,
        Paginator $paginator
    ) {
        $this->albumMediaManager = $albumMediaManager;
        $this->paginator = $paginator;
        $this->albumManager = $albumManager;
    }


    /**
     *
     * @ApiDoc(
     *     resource=false,
     *     description="Return media list for album",
     *     statusCodes={
     *         200="if success",
     *         500="Critical error, see prod.log",
     *     },
     *    output = {"class" = "Andrey\GalleryBundle\Response\MediaListResponse"},
     *    section="Gallery",
     * )
     *
     * @Rest\QueryParam(
     *      name="medias", strict=true, nullable=true, requirements="[0-9]{1,2}", description="medias per page", default="10",
     * )
     *
     *
     * @Rest\QueryParam(
     *      name="page", strict=true, nullable=true, requirements="[0-9]{1,2}", description="page number", default="0",
     * )
     *
     *
     * @Rest\QueryParam(
     *      name="id", strict=true, nullable=false, requirements="[0-9]{1,3}", description="album id"
     * )
     *
     * @Rest\View()
     *
     * @param ParamFetcherInterface $paramFetcher
     * @return MediaListResponse
     *
     * @throws \Exception
     */
    public function indexAction(ParamFetcherInterface $paramFetcher)
    {
        $album = $this->albumManager->findById($paramFetcher->get('id'));

        if (!$album) {
            throw new NotFoundHttpException('album not found');
        }

        /** @var \Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination $pagination */
        $pagination = $this->paginator->paginate(
            $this->albumMediaManager->getQueryForPaginator($album),
            $paramFetcher->get('page'),
            $paramFetcher->get('medias')
        );

        return (new MediaListResponse())
            ->setMedias($pagination->getItems())
            ->setPageCount($pagination->getPageCount())
            ->setCurrentPage($pagination->getCurrentPageNumber());
    }
}
