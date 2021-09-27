<?php

use Astaroth\Foundation\Application;

$app = new Application();
$app->run(dirname(__DIR__));

//if prod set
// $app->run(type: Application::PRODUCTION);
