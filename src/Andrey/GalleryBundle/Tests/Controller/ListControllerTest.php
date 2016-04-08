<?php
/**
 * @run ./bin/phpunit -c . src/Andrey/GalleryBundle/Tests/Controller/ListControllerTest.php
 */

namespace Andrey\GalleryBundle\Tests\Controller;

use Andrey\GalleryBundle\Controller\ListController;
use Symfony\Component\Debug\Debug;

/**
 * It's just example
 *
 * Test class for ListController
 *
 * @package Andrey\GalleryBundle\Tests\Controller
 * @author Andrey Borue <andrey@borue.ru>
 */
class ListControllerTest extends JsonTestCase
{
    /**
     * Simple functional test
     */
    public function testIndex()
    {
        Debug::enable(~E_DEPRECATED, false);

        $this->doGetRequest('/api/gallery/list', ['medias' => 2]);
        $this->assertResponseIsJson();
        $this->assertJsonPaths([
            '$.*.id',
            '$.*.name',
        ]);
    }

    /**
     * Example with Mock objects
     */
    public function testIndexMock()
    {

        $paramFetcherMock = $this->getMock(
            'FOS\RestBundle\Request\ParamFetcher',
            ['get'],
            [],
            '',
            false
        );

        $paramFetcherMock->expects(static::once())->method('get')->will(self::returnValue('test'));

        $albumManagerMock = $this->getMock(
            'Andrey\GalleryBundle\EntityManager\AlbumManager',
            ['getAlbumsPreview'],
            [],
            '',
            false
        );

        $albumManagerMock->expects(static::once())->method('getAlbumsPreview')->will(self::returnValue('test'));

        $listController = new ListController($albumManagerMock);

        $result = $listController->indexAction($paramFetcherMock);

        self::assertEquals('test', $result);
    }
}
