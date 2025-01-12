<?php

declare(strict_types=1);

use App\App;
use App\Container;
use App\Controllers\AuthorController;
use App\Router;

require_once __DIR__.'/../vendor/autoload.php';

define('VIEW_PATH', __DIR__.'/../views');

$container = new Container();
$router = new Router($container);

$router
    ->get('/', [AuthorController::class, 'index']);

(new App(
    $container,
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']]
))->boot()->run();
