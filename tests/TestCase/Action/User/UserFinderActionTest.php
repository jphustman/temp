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
 * @coversDefaultClass \App\Action\User\UserFinderAction
 */
class UserFinderActionTest extends TestCase
{
    use AppTestTrait;
    use DatabaseTestTrait;

    public function testListUsers(): void
    {
        $this->insertFixtures([UserFixture::class]);

        $request = $this->createRequest('GET', '/api/users');
        $response = $this->app->handle($request);

        $this->assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
        $this->assertJsonData(
            [
                'users' => [
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
                    [
                        'id' => 2,
                        'number' => '10001',
                        'name' => 'Contoso AG',
                        'street' => '4928 Tori Lane',
                        'postal_code' => '84116',
                        'city' => 'Salt Lake City',
                        'country' => 'US',
                        'email' => 'info@contoso.com',
                    ],
                ],
            ],
            $response
        );
    }
}
