<?php

declare(strict_types=1);

use src\App\Middleware\BearerAuthMiddleware;

// Unprotected Routes
$app->get('/', 'App\Controller\Home:getHelp');
$app->get('/status', 'App\Controller\Home:getStatus');
$app->post('/auth/register', 'App\Controller\Auth:register');
$app->post('/auth/signin', 'App\Controller\Auth:signin');

// Protected Routes
$app->get('/user/add', 'App\Controller\User:addUser');
$app->get('/user/all', 'App\Controller\User:all');
$app->get('/user/public', 'App\Controller\User:public');

//$app->post('/test/auth', 'App\Controller\Test:auth');
$app->post('/test/auth', 'App\Controller\Test:auth')->add(BearerAuthMiddleware::class);


$app->post('/import/account', 'App\Controller\Alveo::import_account');
$app->post('/import/trades', 'App\Controller\Alveo::import_trades');

// KEEP THIS COMMENTED OUT UNLESS CREATING A SERVER KEY
$app->get('/auth/serverkey', 'App\Controller\Auth:createServerKey');


