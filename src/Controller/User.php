<?php

declare(strict_types=1);

namespace App\Controller;

use App\CustomResponse as Response;
use DI\Container;
use Psr\Http\Message\ServerRequestInterface as Request;

final class User
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getHelp(Request $request, Response $response): Response
    {
    }

    public function all(Request $request, Response $response): Response
    {
        return $response;
    }

    public function public(Request $request, Response $response): Response
    {
        return $response;
    }
}
