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
 * @coversDefaultClass \App\Action\User\UserDeleterAction
 */
class UserDeleteActionTest extends TestCase
{
    use AppTestTrait;
    use DatabaseTestTrait;

    public function testDeleteUser(): void
    {
        $this->insertFixtures([UserFixture::class]);

        $request = $this->createJsonRequest('DELETE', '/api/users/1');

        $response = $this->app->handle($request);

        // Check response
        $this->assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());

        // Check database
        $this->assertTableRowCount(1, 'users');
        $this->assertTableRowNotExists('users', 1);
    }
}
