<?php

use Slim\Views\TwigMiddleware;
use App\Middleware\BootMiddleware;
use Ronanchilvers\Sessions\Middleware\Psr15;
use Slim\Handlers\Strategies\RequestResponseArgs;
// Add middleware here
// Variables available :
//   - $container
//   - $app

// Use alternative route collector strategy
$routeCollector = $app->getRouteCollector();
$routeCollector->setDefaultInvocationStrategy(
    new RequestResponseArgs()
);

// Twig support
$app->add(TwigMiddleware::class);

// Session handling
$app->add(new Psr15(
    $container->get('session')
));

// Application boot
$app->add(new BootMiddleware($container));
