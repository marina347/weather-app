<?php

require __DIR__ . '/../vendor/autoload.php';

use Weather\App;

$app = new App();
$app->init($argv);
$app->run();
