<?php

namespace App\Test\TestCase\Action\User;

use App\Test\Fixture\UserFixture;
use App\Test\Traits\AppTestTrait;
use Cake\Chronos\Chronos;
use Fig\Http\Message\StatusCodeInterface;
use PHPUnit\Framework\TestCase;
use Selective\TestTrait\Traits\DatabaseTestTrait;

/**
 * Test.
 *
 * @coversDefaultClass \App\Action\User\UserUpdaterAction
 */
class UserUpdaterActionTest extends TestCase
{
    use AppTestTrait;
    use DatabaseTestTrait;

    public function testUpdateUser(): void
    {
        Chronos::setTestNow('2021-02-01 00:00:00');

        $this->insertFixtures([UserFixture::class]);

        $request = $this->createJsonRequest(
            'PUT',
            '/api/users/1',
            [
                'number' => '19999',
                'name' => 'New name',
                'street' => 'New street',
                'city' => 'New city',
                'country' => 'DE',
                'postal_code' => '77777',
                'email' => 'new@example.com',
            ]
        );

        $response = $this->app->handle($request);

        // Check response
        $this->assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
        $this->assertJsonContentType($response);

        // Check logger
        $this->assertTrue($this->getLogger()->hasInfoThatContains('User updated successfully'));

        // Check database
        $expected = [
            'id' => '1',
            'number' => '19999',
            'name' => 'New name',
            'street' => 'New street',
            'postal_code' => '77777',
            'city' => 'New city',
            'country' => 'DE',
            'email' => 'new@example.com',
        ];

        $this->assertTableRow($expected, 'users', 1);
    }

    public function testCreateUserValidation(): void
    {
        $this->insertFixtures([UserFixture::class]);

        $request = $this->createJsonRequest(
            'PUT',
            '/api/users/1',
            [
                'number' => '',
                'name' => '',
                'street' => '',
                'city' => '',
                'country' => '',
                'postal_code' => '',
                'email' => 'mail.example.com',
            ]
        );

        $response = $this->app->handle($request);

        // Check response
        $this->assertSame(StatusCodeInterface::STATUS_UNPROCESSABLE_ENTITY, $response->getStatusCode());
        $this->assertJsonContentType($response);

        $expected = [
            'error' => [
                'message' => 'Please check your input',
                'details' => [
                    [
                        'message' => 'This value should not be blank.',
                        'field' => '[number]',
                    ],
                    [
                        'message' => 'This value should be positive.',
                        'field' => '[number]',
                    ],
                    [
                        'message' => 'This value should not be blank.',
                        'field' => '[name]',
                    ],
                    [
                        'message' => 'This value should not be blank.',
                        'field' => '[street]',
                    ],
                    [
                        'message' => 'This value should not be blank.',
                        'field' => '[postal_code]',
                    ],
                    [
                        'message' => 'This value should not be blank.',
                        'field' => '[city]',
                    ],
                    [
                        'message' => 'This value should not be blank.',
                        'field' => '[country]',
                    ],
                    [
                        'message' => 'This value should have exactly 2 characters.',
                        'field' => '[country]',
                    ],
                    [
                        'message' => 'This value is not a valid email address.',
                        'field' => '[email]',
                    ],
                ],
            ],
        ];

        $this->assertJsonData($expected, $response);
    }
}
