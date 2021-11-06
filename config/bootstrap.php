<?php

use Ajaxray\Magic\Magic;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new Magic();
(require __DIR__ . '/container.php')($container);

// Create App instance
$app = $container->get(App::class);

// Register routes
(require __DIR__ . '/routes.php')($app);

// Register middleware
(require __DIR__ . '/middleware.php')($app);

return $app;