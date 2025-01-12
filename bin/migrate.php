<?php

declare(strict_types=1);

use App\App;
use App\Container;
use App\Services\XMLServices\XMLMigrateService;

require_once __DIR__.'/../vendor/autoload.php';

define('XML_PATH', __DIR__.'/../datasource');

$container = new Container();
(new App($container))->boot();

$container->get(XMLMigrateService::class)->migrate(XML_PATH);
