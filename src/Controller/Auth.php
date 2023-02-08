<?php

declare(strict_types=1);

namespace App\Controller;

use App\CustomResponse as Response;
use DI\Container;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Users;

final class Auth
{
    private Container $container;
    private $model;
    private $log;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $db = $this->container->get('db');
        $this->model = new Users($db);
    }

    public function register(Request $request, Response $response): Response
    {
        $params = (array)$request->getParsedBody();
        $db = $this->container->get('db');

        $username = $params['username'];
        $email = $params['email'];
        $password = $params['password'];

        // Hash the password
        $password = password_hash($password, PASSWORD_BCRYPT);

        // Create a new user
        $result = $this->model->create([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);

        if ($result['status'] === 'Error') {
            return $response->withJson($result);
        }

        $status = [
            'status' => 'Success',
            'message' => 'User successfully registered',
            'timestamp' => time(),
        ];

        return $response->withJson($status);
    }

    public function signin(Request $request, Response $response): Response
    {
        $params = (array)$request->getParsedBody();
        $this->container->get('db');

        $status = [
            'status' => [
                'username' => $params['username'],
            ],
            'timestamp' => time(),
        ];

        return $response->withJson($status);
    }
}
