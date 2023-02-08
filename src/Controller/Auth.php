<?php

declare(strict_types=1);

namespace App\Controller;

use App\CustomResponse as Response;
use DI\Container;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Auth
{
    private Container $container;
    private $model;
    private $log;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->db
        $this->model = new UsersModel($db);
    }

    public function register(Request $request, Response $response): Response
    {

        return $response->withJson($message);
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
