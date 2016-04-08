<?php

namespace Andrey\GalleryBundle\Controller;

use Andrey\GalleryBundle\EntityManager\AlbumManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * @author Andrey Borue <andrey@borue.ru>
 * @package Andrey\GalleryBundle\Controller
 */
class ListController extends Controller
{
    /**
     * @var AlbumManager
     */
    private $albumManager;

    public function __construct(AlbumManager $albumManager)
    {
        $this->albumManager = $albumManager;
    }

    /**
     *
     * @ApiDoc(
     *     resource=false,
     *     description="Return albums list ",
     *     statusCodes={
     *         200="if success",
     *         500="Critical error, see prod.log",
     *     },
     *    output = {"class" = "Andrey\GalleryBundle\Entity\Album"},
     *    Xtags={"has test" = "LimeGreen"},
     *    section="Gallery",
     * )
     *
     * @Rest\QueryParam(
     *      name="medias", strict=true, nullable=true, requirements="[0-9]{1,2}", description="medias per page", default="10",
     * )
     *
     * @Rest\View()
     *
     * @param ParamFetcherInterface $paramFetcher
     * @return \Andrey\GalleryBundle\Entity\Album
     *
     * @throws \Exception
     */
    public function indexAction(ParamFetcherInterface $paramFetcher)
    {
        return $this->albumManager->getAlbumsPreview($paramFetcher->get('medias'));
    }
}
