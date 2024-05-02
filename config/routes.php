<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Http\Middleware\CsrfProtectionMiddleware;

return static function (RouteBuilder $routes) {
    $routes->setRouteClass(DashedRoute::class);
    $routes->connect('/', ['controller' => 'Events', 'action' => 'index']);

    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httponly' => false,
    ]));

    $routes->applyMiddleware('csrf');

    $routes->scope('/', function (RouteBuilder $builder) {
        $builder->connect('/pages/*', 'Pages::display');
        $builder->fallbacks();
    });
};
