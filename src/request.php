<?php
use Framework\Utils\Configuration\ArgvConfiguration;

$app = require __DIR__.'/bootstrap/app.php';

$argv = new ArgvConfiguration();

$result = $app->run($argv);

echo $result."\n";