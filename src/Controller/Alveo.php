<?php

declare(strict_types=1);

namespace App\Controller;

use App\CustomResponse as Response;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Alveo;

final class Alveo
{
    private Container $container;
    private Alveo $alveo;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $db = $this->container->get('db');
        $this->alveo = new Alveo($db);
    }

    public function import(Request $request, Response $response): Response
    {

    }
}