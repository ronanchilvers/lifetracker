<?php
// Add routes here
// Variables available :
//   - $container
//   - $app

use App\Controller\IndexController;

$app->get(
    '/',
    IndexController::class . ':index'
)->setName('index');
$app->get(
    '/edit/{id}',
    IndexController::class . ':edit'
)->setName('edit');
$app->get(
    '/generate',
    IndexController::class . ':generate'
)->setName('generate');
