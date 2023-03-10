<?php

declare(strict_types=1);

use App\Auth\JwtAuth;
use Slim\Factory\AppFactory;

$container = new \DI\Container();

$container->set(JwtAuth::class, function () use ($container) {
    $settings = $container->get('settings')['jwt'];
    return new JwtAuth($settings);
});

return AppFactory::create(new ResponseFactory(), $container);

