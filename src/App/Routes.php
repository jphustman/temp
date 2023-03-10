<?php

declare(strict_types=1);

use src\App\Middleware\UnprotectedMiddleware;

$app->get('/', 'App\Controller\Home:getHelp');
$app->get('/status', 'App\Controller\Home:getStatus');

$app->get('/user/add', 'App\Controller\User:addUser');
$app->get('/user/all', 'App\Controller\User:all');
$app->get('/user/public', 'App\Controller\User:public');

$app->get('/test/all', 'App\Controller\Test:all');

$app->post('/auth/register', 'App\Controller\Auth:register')->add($unprotectedMiddleware);
$app->post('/auth/signin', 'App\Controller\Auth:signin')->add($unprotectedMiddleware);

// old
//$app->post('/report/import', 'App\Controller\Alveo:import');

$app->post('/import/account', 'App\Controller\Alveo::import_account');
$app->post('/import/trades', 'App\Controller\Alveo::import_trades');

// KEEP THIS COMMENTED OUT UNLESS CREATING A SERVER KEY
$app->get('/auth/serverkey', 'App\Controller\Auth:createServerKey')->add(new UnprotectedMiddleware());


