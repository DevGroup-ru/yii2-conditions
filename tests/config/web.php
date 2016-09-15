<?php

use DevGroup\Conditions\ConditionsModule;
use yii\console\controllers\MigrateController;
use yii\console\controllers\ServeController;
use yii\helpers\ArrayHelper;

$webConfig = [
    'id' => 'tests-web',
    'basePath' => dirname(dirname(__DIR__)),
    'layout' => false,
    'components' => [
        'urlManager' => [
            'showScriptName' => true,
            'enablePrettyUrl' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],
    ],
];

$commonFilename = 'common.php';
$localName = 'web-local.php';

if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . $localName)) {
    $webConfig = ArrayHelper::merge($webConfig, require(__DIR__ . DIRECTORY_SEPARATOR . $localName));
}

if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . $commonFilename)) {
    $webConfig = ArrayHelper::merge(require(__DIR__ . DIRECTORY_SEPARATOR . $commonFilename), $webConfig);
}

return $webConfig;
