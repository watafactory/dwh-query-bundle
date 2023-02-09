<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Tests\Integration\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Wata\DwhQueryBundle\Tests\Integration\App\TestKernel;

class DwhApiControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

    public static function setUpBeforeClass(): void
    {
        $fs = new Filesystem();
        $fs->remove(sys_get_temp_dir() . '/DwhQueryBundle/');
    }

    protected function tearDown(): void
    {
        static::ensureKernelShutdown();
    }

    public function testIfQueryIsExecuted(): void
    {
        // GIVEN
        $query = '{"query":"{test{id,name}}"}';
        $client = static::createClient();

        // WHEN
        $client->request(
            'POST',
            '/dwh',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $query
        );

        // THEN
        $response = $client->getResponse();
        $data = json_decode($response->getContent(), true);

        $this->assertCount(3, $data['data']['test']);
        $this->assertEquals(1, $data['data']['test'][0]['id']);
        $this->assertEquals('name1', $data['data']['test'][0]['name']);
    }

}
