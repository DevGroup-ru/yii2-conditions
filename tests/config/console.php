<?php

use DevGroup\Conditions\ConditionsModule;
use yii\console\controllers\MigrateController;
use yii\console\controllers\ServeController;
use yii\helpers\ArrayHelper;

$consoleConfig = [
    'id' => 'tests-console',
    'basePath' => dirname(dirname(__DIR__)),
    'controllerMap' => [
        'migrate' => [
            'class' => MigrateController::class,
            'migrationPath' => '@DevGroup/Conditions/migrations',
        ],
        'serve' => [
            'class' => ServeController::class,
            'docroot' => '@DevGroup/Conditions/Tests/web',
        ],
    ],

];
$commonFilename = 'common.php';
$localName = 'console-local.php';

if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . $localName)) {
    $localConfig = require(__DIR__ . DIRECTORY_SEPARATOR . $localName);
    $consoleConfig = ArrayHelper::merge($consoleConfig, $localConfig);
}

if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . $commonFilename)) {
    $consoleConfig = ArrayHelper::merge(require(__DIR__ . DIRECTORY_SEPARATOR . $commonFilename), $consoleConfig);
}

return $consoleConfig;
