<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return static function (RouteBuilder $routes) {
    $routes->setRouteClass(DashedRoute::class);
    $routes->connect('/', ['controller' => 'Videos', 'action' => 'index']);

    $routes->scope('/', function (RouteBuilder $builder) {
        $builder->connect('/pages/*', 'Pages::display');
        $builder->fallbacks();
    });
    };