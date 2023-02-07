<?php

declare(strict_types=1);

$app->get('/', 'App\Controller\Home:getHelp');
$app->get('/status', 'App\Controller\Home:getStatus');

$app->get('/user/add', 'App\Controller\User:addUser');

$app->get('/test/all', 'App\Controller\Test:all');

$app->get('/auth/register', 'App\Controller\Auth:register');
