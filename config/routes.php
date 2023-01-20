<?php

// Define app routes

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    // Redirect to Swagger documentation
    $app->get('/', \App\Action\Home\HomeAction::class)->setName('home');

    // API
    $app->group(
        '/api',
        function (RouteCollectorProxy $app) {
            $app->get('/users', \App\Action\User\UserFinderAction::class);
            $app->post('/users', \App\Action\User\UserCreatorAction::class);
            $app->get('/users/{user_id}', \App\Action\User\UserReaderAction::class);
            $app->put('/users/{user_id}', \App\Action\User\UserUpdaterAction::class);
            $app->delete('/users/{user_id}', \App\Action\User\UserDeleterAction::class);
        }
    );
};
