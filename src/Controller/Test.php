<?php

declare(strict_types=1);

namespace App\Controller;

use App\CustomResponse as Response;
use DI\Container;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Test
{

    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function auth(Request $request, Response $response): Response
    {
        $message = [
            'auth' => "Success!",
            'timestamp' => time()
        ];

        return $response->withJson($message);
    }


}
