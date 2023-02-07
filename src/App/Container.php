<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;

$container = new \DI\Container();

return AppFactory::create(new ResponseFactory(), $container);

