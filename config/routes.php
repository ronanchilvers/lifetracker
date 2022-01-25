<?php
// Add routes here
// Variables available :
//   - $container
//   - $app

use Slim\Routing\RouteCollectorProxy;
use App\Controller\CharacterController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$app->get(
    '/',
    function (ServerRequestInterface $request, ResponseInterface $response) {
        return $response
            ->withStatus(302)
            ->withHeader('Location', '/characters')
            ;
    }
)->setName('home');

$app->group('/characters', function (RouteCollectorProxy $group) {

    $group->get(
        '',
        CharacterController::class . ':index'
    )->setName('characters.index');

    $group->get(
        '/generate',
        CharacterController::class . ':generate'
    )->setName('characters.generate');

    // $group->map(
    //     ['GET', 'POST'],
    //     '/new',
    //     CharacterController::class . ':new'
    // )->setName('characters.new');

    $group->map(
        ['GET', 'POST'],
        '/{id}',
        CharacterController::class . ':edit'
    )->setName('characters.edit');

});