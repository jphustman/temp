<?php

namespace App\Test\TestCase\Action\User;

use App\Test\Fixture\UserFixture;
use App\Test\Traits\AppTestTrait;
use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\TestCase;
use Selective\TestTrait\Traits\DatabaseTestTrait;

/**
 * Test.
 *
 * @coversDefaultClass \App\Action\User\UserReaderAction
 */
class UserReaderActionTest extends TestCase
{
    use AppTestTrait;
    use DatabaseTestTrait;

    public function testValidId(): void
    {
        $this->insertFixtures([UserFixture::class]);

        $request = $this->createRequest('GET', '/api/users/1');
        $response = $this->app->handle($request);

        $this->assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
        $this->assertJsonContentType($response);
        $this->assertJsonData(
            [
                'id' => 1,
                'number' => '10000',
                'name' => 'Coho Winery',
                'street' => '192 Market Square',
                'postal_code' => '31772',
                'city' => 'Atlanta',
                'country' => 'US',
                'email' => 'info@example.net',
            ],
            $response
        );
    }

    public function testInvalidId(): void
    {
        $request = $this->createRequest('GET', '/api/users/99');
        $response = $this->app->handle($request);

        $this->assertSame(StatusCodeInterface::STATUS_BAD_REQUEST, $response->getStatusCode());
    }
}
