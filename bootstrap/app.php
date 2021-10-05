<?php

declare(strict_types=1);

use Astaroth\Foundation\Application;

$app = new Application();
$app->run(dirname(__DIR__));

//if prod set
// $app->run(type: Application::PRODUCTION);
