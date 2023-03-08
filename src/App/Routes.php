<?php

declare(strict_types=1);

$app->get('/', 'App\Controller\Home:getHelp');
$app->get('/status', 'App\Controller\Home:getStatus');

$app->get('/user/add', 'App\Controller\User:addUser');
$app->get('/user/all', 'App\Controller\User:all');
$app->get('/user/public', 'App\Controller\User:public');

$app->get('/test/all', 'App\Controller\Test:all');

$app->post('/auth/register', 'App\Controller\Auth:register');
$app->post('/auth/signin', 'App\Controller\Auth:signin');

$app->get('/report/import', 'App\Controller\Alveo:import');
