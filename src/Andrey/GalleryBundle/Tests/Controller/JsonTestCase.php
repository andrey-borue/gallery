<?php

namespace Andrey\GalleryBundle\Tests\Controller;

use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Client;
use Flow\JSONPath\JSONPath;

/**
 *
 * @author Andrey Borue <andrey@borue.ru>
 */
class JsonTestCase extends WebTestCase
{

    /**
     * @var Client
     */
    private $client;
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     *
     */
    public function setUp()
    {
        $this->client = static::createClient([
            'debug' => false
        ]);
        $this->container = $this->client->getContainer();
    }

    /**
     * @return Client
     */
    protected function getClient()
    {
        return $this->client;
    }

    /**
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->container;
    }

    /**
     * Проверяет что в ответе пришел json
     * @return $this
     */
    protected function assertResponseIsJson()
    {
        json_decode($this->client->getResponse()->getContent());
        static::assertEquals(json_last_error(), 0);

        return $this;
    }

    /**
     * Проверяет, что в ответе пришел json с кодом 200
     * @return $this
     */
    protected function assertResponseIsJsonAndCodeIs200()
    {
        $this->assertResponseIsJson()->assertResponseCodeIs200();

        return $this;
    }

    /**
     * Проверяет количество элементов по заданному пути
     * @param $path
     * @param $count
     * @return $this
     */
    protected function assertJsonPathElementCount($path, $count)
    {
        static::assertEquals(count($this->grabDataFromResponseByJsonPath($path)), $count);

        return $this;
    }

    /**
     * Проверяет соответсвие первого элемента по указаному пути
     * @param $path
     * @param $expected
     * @return $this
     */
    protected function assertJsonPathElementEquals($path, $expected)
    {
        $this->getLogger()->debug(sprintf('assert %s => %s', $path, $expected));
        static::assertEquals(current($this->grabDataFromResponseByJsonPath($path)), $expected);

        return $this;
    }

    /**
     * Проверяет соответсвие первого элемента по указаному пути
     * Принимает на вход массив пар путь => элемент
     * @param array $rows
     * @return $this
     */
    protected function assertJsonPathsElementEquals(array $rows)
    {
        foreach ($rows as $path => $expected) {
            $this->assertJsonPathElementEquals($path, $expected);
        }

        return $this;
    }

    /**
     * @param $path
     * @return $this
     */
    protected function assertJsonPath($path)
    {
        $this->getLogger()->debug(sprintf('assert path %s', $path));
        static::assertTrue((bool)$this->grabDataFromResponseByJsonPath($path));

        return $this;
    }

    /**
     * @param array $paths
     * @return $this
     */
    protected function assertJsonPaths(array $paths)
    {
        foreach ($paths as $path) {
            $this->assertJsonPath($path);
        }

        return $this;
    }

    /**
     * @param $path
     * @return array
     */
    protected function grabDataFromResponseByJsonPath($path)
    {
        return (new JSONPath(json_decode($this->client->getResponse()->getContent())))->find($path)->data();
    }

    /**
     * @param $path
     * @return int
     */
    protected function getElementCountByJsonPath($path)
    {
        return count($this->grabDataFromResponseByJsonPath($path));
    }

    /**
     * @return $this
     */
    protected function assertResponseCodeIs200()
    {
        $this->getLogger()->debug('assert response code is 200');
        if ($this->client->getResponse()->getStatusCode() !== Response::HTTP_OK) {
            $this->getLogger()->error($this->client->getResponse()->getContent());
        }
        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        return $this;
    }

    /**
     * @return $this
     */
    protected function assertResponseCodeIs400()
    {
        $this->getLogger()->debug('assert response code is 400');
        if ($this->client->getResponse()->getStatusCode() !== Response::HTTP_BAD_REQUEST) {
            $this->getLogger()->error($this->client->getResponse()->getContent());
        }
        static::assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());

        return $this;
    }

    /**
     * @return Logger
     */
    protected function getLogger()
    {
        return $this->getContainer()->get('logger');
    }

    protected function wantTo($string)
    {
        $this->getLogger()->info('Собираюсь проверить ' . $string);
    }

    /**
     * @param $uri
     * @param array $parameters
     * @param array $files
     * @param array $server
     * @param null $content
     * @param bool|true $changeHistory
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    protected function doGetRequest(
        $uri,
        array $parameters = [],
        array $files = [],
        array $server = [],
        $content = null,
        $changeHistory = true
    ) {
        $this->getLogger()->debug(sprintf(
            'GET: %s?%s',
            $uri,
            urldecode(http_build_query($parameters))
        ));
        return $this->getClient()->request('GET', $uri, $parameters, $files, $server, $content, $changeHistory);
    }

    /**
     * @param $uri
     * @param array $parameters
     * @param array $files
     * @param array $server
     * @param null $content
     * @param bool|true $changeHistory
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    protected function doPostRequest(
        $uri,
        array $parameters = [],
        array $files = [],
        array $server = [],
        $content = null,
        $changeHistory = true
    ) {
        $contentForLog = $content;
        if (mb_strlen($contentForLog, 'UTF-8') > 300) {
            $contentForLog = mb_substr($contentForLog, 0, 300) . '...';
        }

        $this->getLogger()->debug(sprintf(
            'POST: %s?%s %s',
            $uri,
            urldecode(http_build_query($parameters)),
            $contentForLog
        ));
        return $this->getClient()->request('POST', $uri, $parameters, $files, $server, $content, $changeHistory);
    }

    /**
     * @param string $content
     * @return $this
     */
    protected function seeResponseEquals($content)
    {
        $this->getLogger()->debug(sprintf('Проверяю полное совпадение ответа'));

        self::assertEquals($this->grabResponse(), $content);

        return $this;
    }

    /**
     * @return string
     */
    protected function grabResponse()
    {
        return $this->getClient()->getResponse()->getContent();
    }

    /**
     * @param $message
     * @return $this
     */
    protected function comment($message)
    {
        $this->getLogger()->info($message);

        return $this;
    }
}
